<?php

namespace App\Http\Controllers;

use App\Models\AdvancePayment;
use App\Models\AssignPayment;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimatePayments;
use App\Models\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PHPUnit\TextUI\XmlConfiguration\Group;

class ReportsController extends Controller
{

    public function firstreport($reportBy, $keyword = null)
    {

        if($reportBy == 'source')
        {
            $customers = Customer::where('source', $keyword)
                                ->with('estimates')
                                ->get();
        }elseif($reportBy == 'completedEstimate')
        {
            $customers = Customer::with(['estimates' => fn($q) =>
            $q->where('project_owner', $keyword)
            ->where('estimate_status', 'complete')])->get();
        }elseif($reportBy == 'pandingEstimate')
        {
            $customers = Customer::with(['estimates' => fn($q) =>
    $q->where('project_owner', $keyword)
      ->where('estimate_status', 'pending')])->get();
        }elseif($reportBy == 'completedWorkOrders')
        {
            $customers = Customer::with(['estimates' => fn($q) =>
            $q->where('project_owner', $keyword)
            ->where('estimate_status', 'paid')])->get();
        }elseif($reportBy == 'acceptedEstimate')
        {
           $customers =  Customer::with(['estimates' => fn($q) =>
            $q->where('project_owner', $keyword)
            ->whereNotNull('estimate_total',)])->get();
        }elseif($reportBy == 'salesByEstimate')
        {
            $customers =  Customer::with(['estimates' => fn($q) =>
            $q->where('project_owner', $keyword)
            ->whereNotNull('estimate_total',)])->get();
        }elseif($reportBy == 'newEstimateByOwner')
        {
            $customers =  Customer::with(['estimates' => fn($q) =>
            $q->where('project_owner', $keyword)
            ->where('estimate_assigned','0')])->get();
        }

        return view('report_details', compact('customers'));
    }
    public function index($range = null, $date = null, $keyword = null)
    {
        $userDetails = session('user_details');
        if ($keyword != null) {
            // Filter customers based on the search keyword
            $customers = Customer::where('source', 'like', '%' . $keyword . '%')->with('estimates')->get();

        } else {
            $customers = Customer::with('estimates')->get();
        }
        if ($range != null && $date != null) {
            $startDate = null;
            $endDate = null;

            // Determine start and end dates based on selected range
            switch ($range) {
                case 'day':
                    $startDate = Carbon::parse($date)->startOfDay();
                    $endDate = Carbon::parse($date)->endOfDay();
                    break;
                case 'week':
                    $startDate = Carbon::parse($date)->startOfWeek();
                    $endDate = Carbon::parse($date)->endOfWeek();
                    break;
                case 'month':
                    $startDate = Carbon::parse($date)->startOfMonth();
                    $endDate = Carbon::parse($date)->endOfMonth();
                    break;
                default:
                    // Handle invalid range, maybe redirect to default range
                    break;
            }

            foreach ($customers as $customer) {
                $customerEstimates = Estimate::where('customer_id', $customer->customer_id)->whereBetween('created_at', [$startDate, $endDate])->get();
                $customer->estimates = $customerEstimates;
            }
        } else {
            if ($keyword != null) {
                // Filter customers based on the search keyword
                $customers = Customer::where('name', 'like', '%' . $keyword . '%')->with('estimates')->get();
            } else {
                $customers = Customer::with('estimates')->get();
            }
        }

        $sources = [];
        $completedEstimators = [];
        $pendingEstimators = [];
        $completedWorkOrders = [];
        $acceptedEstimates = [];
        $salesbyEsimator = [];
        $newEstimatesByOwner = [];

        $sevenDaysAgo = Carbon::now()->subDays(7);

        foreach ($customers as $customer) {
            $sourceName = $customer->source;

            if (!isset($sources[$sourceName]['total_customers'])) {
                $sources[$sourceName]['total_customers'] = 0;
            }

            if (!isset($sources[$sourceName]['estimate_total'])) {
                $sources[$sourceName]['estimate_total'] = 0;
            }

            $sources[$sourceName]['total_customers'] += 1; // Increment total customers for the source
            $sources[$sourceName]['estimate_total'] += $customer->estimates->sum('estimate_total');

            // Check if estimate_status is completed before adding to completedEstimators
            foreach ($customer->estimates as $estimate) {
                if ($estimate->estimate_status === 'complete') {
                    $ownerName = $estimate->project_owner;

                    if (!isset($completedEstimators[$ownerName]['total_estimates'])) {
                        $completedEstimators[$ownerName]['total_estimates'] = 0;
                    }

                    if (!isset($completedEstimators[$ownerName]['estimate_total'])) {
                        $completedEstimators[$ownerName]['estimate_total'] = 0;
                    }

                    $completedEstimators[$ownerName]['total_estimates'] += 1;
                    $completedEstimators[$ownerName]['estimate_total'] += $estimate->estimate_total;
                }
            }
            foreach ($customer->estimates as $estimate) {
                if ($estimate->estimate_status === 'pending') {
                    $ownerName = $estimate->project_owner;

                    if (!isset($pendingEstimators[$ownerName]['total_estimates'])) {
                        $pendingEstimators[$ownerName]['total_estimates'] = 0;
                    }

                    if (!isset($pendingEstimators[$ownerName]['estimate_total'])) {
                        $pendingEstimators[$ownerName]['estimate_total'] = 0;
                    }

                    $pendingEstimators[$ownerName]['total_estimates'] += 1;
                    $pendingEstimators[$ownerName]['estimate_total'] += $estimate->estimate_total;
                }

                if ($estimate->work_completed === 1) {
                    $ownerName = $estimate->project_owner;

                    if (!isset($completedWorkOrders[$ownerName]['total_work_orders'])) {
                        $completedWorkOrders[$ownerName]['total_work_orders'] = 0;
                    }

                    if (!isset($completedWorkOrders[$ownerName]['work_order_total'])) {
                        $completedWorkOrders[$ownerName]['work_order_total'] = 0;
                    }

                    $completedWorkOrders[$ownerName]['total_work_orders'] += 1;
                    $completedWorkOrders[$ownerName]['work_order_total'] += $estimate->estimate_total;
                }

                if ($estimate->estimate_total != null) {
                    $ownerName = $estimate->project_owner;

                    if (!isset($acceptedEstimates[$ownerName]['total_estimates'])) {
                        $acceptedEstimates[$ownerName]['total_estimates'] = 0;
                    }

                    if (!isset($acceptedEstimates[$ownerName]['estimate_total'])) {
                        $acceptedEstimates[$ownerName]['estimate_total'] = 0;
                    }

                    $acceptedEstimates[$ownerName]['total_estimates'] += 1;
                    $acceptedEstimates[$ownerName]['estimate_total'] += $estimate->estimate_total;
                }

                if ($estimate) {
                    $ownerName = $estimate->project_owner;

                    if (!isset($salesbyEsimator[$ownerName]['total_estimates'])) {
                        $salesbyEsimator[$ownerName]['total_estimates'] = 0;
                    }

                    if (!isset($salesbyEsimator[$ownerName]['estimate_total'])) {
                        $salesbyEsimator[$ownerName]['estimate_total'] = 0;
                    }

                    $salesbyEsimator[$ownerName]['total_estimates'] += 1;
                    $salesbyEsimator[$ownerName]['estimate_total'] += $estimate->estimate_total;

                    // New logic for new estimates in the last 7 days
                    if (Carbon::parse($estimate->created_at)->greaterThanOrEqualTo($sevenDaysAgo)) {
                        $ownerName = $estimate->project_owner;

                        if (!isset($newEstimatesByOwner[$ownerName]['total_estimates'])) {
                            $newEstimatesByOwner[$ownerName]['total_estimates'] = 0;
                        }

                        if (!isset($newEstimatesByOwner[$ownerName]['estimate_total'])) {
                            $newEstimatesByOwner[$ownerName]['estimate_total'] = 0;
                        }

                        $newEstimatesByOwner[$ownerName]['total_estimates'] += 1;
                        $newEstimatesByOwner[$ownerName]['estimate_total'] += $estimate->estimate_total;
                    }
                }
            }
        }

        // return response()->json(['sources' => $sources, 'completed_estimators' => $completedEstimators]);
        return view('reports', [
            'date' => $date,
            'range' => $range,
            'keyword' => $keyword,
            'sources' => $sources,
            'completed_estimators' => $completedEstimators,
            'pending_estimators' => $pendingEstimators,
            'completed_work_orders' => $completedWorkOrders,
            'accepted_estimates' => $acceptedEstimates,
            'sales_by_estimator' => $salesbyEsimator,
            'new_estimates_by_owner' => $newEstimatesByOwner,
        ]);
    }

    public function saleAnalysis(Request $request)
    {   
        // 1. Total Sales and Revenue Analysis
        $totalSales = Estimate::whereNotNull('estimate_total')->count();
        $totalRevenue = Estimate::whereNotNull('estimate_total')->sum('estimate_total');
        
        // Daily sales
        $dailySales = Estimate::whereNotNull('estimate_total')
            ->whereDate('created_at', Carbon::today())
            ->sum('estimate_total');

        // Weekly sales
        $weeklySales = Estimate::whereNotNull('estimate_total')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->sum('estimate_total');

        // Monthly sales
        $monthlySales = Estimate::whereNotNull('estimate_total')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('estimate_total');

        // Yearly sales
        $yearlySales = Estimate::whereNotNull('estimate_total')
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('estimate_total');
        

        // 2. Paid vs Unpaid Invoices
        $paidInvoices = AssignPayment::where('invoice_status', 'paid')->get();
        $unpaidInvoices = AssignPayment::where('invoice_status', 'unpaid')->get();
        
        $totalInvoices = $paidInvoices->count() + $unpaidInvoices->count();
        $paidInvoicesPercent = $totalInvoices > 0 ? round(($paidInvoices->count() / $totalInvoices) * 100) : 0;
        $unpaidInvoicesPercent = $totalInvoices > 0 ? round(($unpaidInvoices->count() / $totalInvoices) * 100) : 0;
        
        $paidInvoicesTotal = $paidInvoices->sum('invoice_total');
        $unpaidInvoicesTotal = $unpaidInvoices->sum('invoice_total');

        // 3. Top 10 Highest Value Estimates
        $topEstimates = Estimate::whereNotNull('estimate_total')
            ->orderBy('estimate_total', 'desc')
            ->take(10)
            ->with('customer')
            ->get();

        // 4. Revenue by Project Type
        $projectTypes = Estimate::get()
            ->groupBy('project_type');

        $revenueByProjectType = [];
        $totalProjectRevenue = 0;

        foreach ($projectTypes as $type => $estimates) {
            $revenueByProjectType[$type] = $estimates->sum('estimate_total');
            $totalProjectRevenue += $revenueByProjectType[$type];
        }

        $revenueByProjectTypePercent = [];
        foreach ($revenueByProjectType as $type => $revenue) {
            $revenueByProjectTypePercent[$type] = $totalProjectRevenue > 0 ? round(($revenue / $totalProjectRevenue) * 100) : 0;
        }

        // 5. Revenue by Building Type
        $buildingTypes = Estimate::get()
            ->groupBy('building_type');

        $revenueByBuildingType = [];
        $totalBuildingRevenue = 0;

        foreach ($buildingTypes as $type => $estimates) {
            $revenueByBuildingType[$type] = $estimates->sum('estimate_total');
            $totalBuildingRevenue += $revenueByBuildingType[$type];
        }

        $revenueByBuildingTypePercent = [];
        foreach ($revenueByBuildingType as $type => $revenue) {
            $revenueByBuildingTypePercent[$type] = $totalBuildingRevenue > 0 ? round(($revenue / $totalBuildingRevenue) * 100) : 0;
        }


        // 5. Advance Payment Analysis
        // $advancePayments = AdvancePayment::all();
        // $totalAdvanceAmount = $advancePayments->sum('advance_payment');
        // $totalEstimateAmount = $advancePayments->sum('estimate_total');
        
        // $advancePaidPercent = $totalEstimateAmount > 0 ? round(($totalAdvanceAmount / $totalEstimateAmount) * 100) : 0;
        // $remainingPercent = 100 - $advancePaidPercent;

        return view('saleAnalytics', [
            'totalSales' => $totalSales,
            'dailySales' => $dailySales,
            'weeklySales' => $weeklySales,
            'monthlySales' => $monthlySales,
            'yearlySales' => $yearlySales,
            'totalRevenue' => $totalRevenue,
            'revenueByBuildingType' => $revenueByBuildingType,
            'revenueByBuildingTypePercent' => $revenueByBuildingTypePercent,
            'paidInvoicesPercent' => $paidInvoicesPercent,
            'unpaidInvoicesPercent' => $unpaidInvoicesPercent,
            'paidInvoicesTotal' => $paidInvoicesTotal,
            'unpaidInvoicesTotal' => $unpaidInvoicesTotal,
            'topEstimates' => $topEstimates,
            'revenueByProjectType' => $revenueByProjectType,
            'revenueByProjectTypePercent' => $revenueByProjectTypePercent,
            // 'advancePaidPercent' => $advancePaidPercent,
            // 'remainingPercent' => $remainingPercent,
            // 'totalAdvanceAmount' => $totalAdvanceAmount,
            // 'totalEstimateAmount' => $totalEstimateAmount
        ]);
    }


}
