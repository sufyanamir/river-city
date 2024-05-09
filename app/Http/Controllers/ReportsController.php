<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportsController extends Controller
{
    public function index($range = null, $date = null, $keyword = null)
    {
        $userDetails = session('user_details');
        if ($keyword != null) {
            // Filter customers based on the search keyword
            $customers = Customer::where('name', 'like', '%' . $keyword . '%')->with('estimates')->get();
        }else{
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
            }else{
                $customers = Customer::with('estimates')->get();
            }
        }

        $sources = [];
        $completedEstimators = [];
        $pendingEstimators = [];
        $completedWorkOrders = [];
        $acceptedEstimates = [];
        $salesbyEsimator = [];

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
        ]);
    }
}
