<?php

namespace App\Http\Controllers;

use App\Models\CompanyBranches;
use App\Models\Customer;
use App\Models\Estimate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BranchReportsController extends Controller
{
    protected $userDetails;

    public function __construct()
    {
        $this->userDetails = Session::get('user_details');
    }

    /**
     * Display branch reports index with yearly overview
     */
    public function index(Request $request)
    {
        $userDetails = session('user_details');
        
        if ($userDetails['user_role'] !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $branches = CompanyBranches::all();
        $currentYear = $request->get('year', date('Y'));
        
        // Calculate yearly summary for each branch
        $branchSummary = [];
        foreach ($branches as $branch) {
            $yearlyTarget = $branch->yearly_target ?: 0;
            $actualRevenue = $this->calculateBranchRevenue($branch->branch_name, $currentYear);
            
            $branchSummary[] = [
                'branch' => $branch,
                'yearly_target' => $yearlyTarget,
                'actual_revenue' => $actualRevenue,
                'achievement_percent' => $yearlyTarget > 0 ? round(($actualRevenue / $yearlyTarget) * 100, 1) : 0,
                'variance' => $actualRevenue - $yearlyTarget,
                'variance_percent' => $yearlyTarget > 0 ? round((($actualRevenue - $yearlyTarget) / $yearlyTarget) * 100, 1) : 0
            ];
        }

        return view('branch_reports.index', [
            'branches' => $branchSummary,
            'current_year' => $currentYear,
            'user_details' => $userDetails
        ]);
    }

    /**
     * Display weekly branch report
     */
    public function weeklyReport($branchName = null, $year = null)
    {
        $userDetails = session('user_details');
        
        if ($userDetails['user_role'] !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $year = $year ?: date('Y');
        $branches = CompanyBranches::all();
        
        // If specific branch is selected
        if ($branchName) {
            $selectedBranch = CompanyBranches::where('branch_name', $branchName)->first();
            if (!$selectedBranch) {
                return redirect()->back()->with('error', 'Branch not found');
            }
            $branches = collect([$selectedBranch]);
        }

        $weeklyData = [];
        foreach ($branches as $branch) {
            $weeklyData[$branch->branch_name] = $this->generateWeeklyData($branch, $year);
        }

        return view('branch_reports.weekly', [
            'branches' => $branches,
            'weekly_data' => $weeklyData,
            'selected_branch' => $branchName,
            'year' => $year,
            'user_details' => $userDetails
        ]);
    }

    /**
     * Display monthly branch report
     */
    public function monthlyReport($branchName = null, $year = null)
    {
        $userDetails = session('user_details');
        
        if ($userDetails['user_role'] !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized access');
        }

        $year = $year ?: date('Y');
        $branches = CompanyBranches::all();
        
        // If specific branch is selected
        if ($branchName) {
            $selectedBranch = CompanyBranches::where('branch_name', $branchName)->first();
            if (!$selectedBranch) {
                return redirect()->back()->with('error', 'Branch not found');
            }
            $branches = collect([$selectedBranch]);
        }

        $monthlyData = [];
        foreach ($branches as $branch) {
            $monthlyData[$branch->branch_name] = $this->generateMonthlyData($branch, $year);
        }

        return view('branch_reports.monthly', [
            'branches' => $branches,
            'monthly_data' => $monthlyData,
            'selected_branch' => $branchName,
            'year' => $year,
            'user_details' => $userDetails
        ]);
    }

    /**
     * Generate weekly data for a branch
     */
    private function generateWeeklyData($branch, $year)
    {
        $yearlyTarget = $branch->yearly_target ?: 0;
        
        // Calculate the number of weeks in the year
        $firstDayOfYear = Carbon::createFromDate($year, 1, 1)->startOfDay();
        $lastDayOfYear = Carbon::createFromDate($year, 12, 31)->endOfDay();
        $weeksInYear = (int) ceil($lastDayOfYear->diffInDays($firstDayOfYear) / 7);
        
        // Calculate weekly target
        $weeklyTarget = $yearlyTarget / $weeksInYear;
        
        $weeklyData = [];
        $cumulativeTarget = 0;
        $cumulativeActual = 0;
        
        // Generate data for each week
        for ($week = 1; $week <= $weeksInYear; $week++) {
            // Calculate the start and end dates for this week
            $startDate = $firstDayOfYear->copy()->addWeeks($week - 1)->startOfWeek();
            $endDate = $startDate->copy()->endOfWeek();
            
            // Clamp the range strictly within the selected year
            $clampedStart = $startDate->copy();
            if ($clampedStart->lt($firstDayOfYear)) {
                $clampedStart = $firstDayOfYear->copy();
            }
            $clampedEnd = $endDate->copy();
            if ($clampedEnd->gt($lastDayOfYear)) {
                $clampedEnd = $lastDayOfYear->copy();
            }
            if ($clampedStart->year > (int) $year) {
                break;
            }
            
            // Calculate actual revenue for this week
            $actualRevenue = $this->calculateBranchRevenueForPeriod(
                $branch->branch_name,
                $clampedStart->format('Y-m-d'),
                $clampedEnd->format('Y-m-d')
            );
            
            $cumulativeTarget += $weeklyTarget;
            $cumulativeActual += $actualRevenue;
            
            $variance = $actualRevenue - $weeklyTarget;
            $variancePercent = $weeklyTarget > 0 ? round(($variance / $weeklyTarget) * 100, 1) : 0;
            $achievementPercent = $weeklyTarget > 0 ? round(($actualRevenue / $weeklyTarget) * 100, 1) : 0;
            
            $weeklyData[] = [
                'week_number' => $week,
                'week_ending' => $clampedEnd->format('M d, Y'),
                'week_start' => $clampedStart->format('d M'),
                'week_end' => $clampedEnd->format('d M'),
                'planned' => round($weeklyTarget, 2),
                'actual' => $actualRevenue,
                'variance' => $variance,
                'variance_percent' => $variancePercent,
                'achievement_percent' => $achievementPercent,
                'cumulative_planned' => round($cumulativeTarget, 2),
                'cumulative_actual' => $cumulativeActual,
                'cumulative_variance' => $cumulativeActual - $cumulativeTarget,
                'cumulative_variance_percent' => $cumulativeTarget > 0 ? round((($cumulativeActual - $cumulativeTarget) / $cumulativeTarget) * 100, 1) : 0
            ];
        }
        
        return $weeklyData;
    }

    /**
     * Generate monthly data for a branch
     */
    private function generateMonthlyData($branch, $year)
    {
        $yearlyTarget = $branch->yearly_target ?: 0;
        
        // Calculate monthly targets based on the number of days in each month
        $monthlyData = [];
        $cumulativeTarget = 0;
        $cumulativeActual = 0;
        
        // Get total days in the year to calculate daily target
        $daysInYear = Carbon::create($year, 12, 31)->dayOfYear;
        $dailyTarget = $yearlyTarget / $daysInYear;
        
        for ($month = 1; $month <= 12; $month++) {
            $startDate = Carbon::create($year, $month, 1);
            $endDate = $startDate->copy()->endOfMonth();
            
            // Calculate days in this month
            $daysInMonth = $endDate->day;
            
            // Calculate target for this month based on days
            $monthlyTarget = $dailyTarget * $daysInMonth;
            
            // Calculate actual revenue for this month
            $actualRevenue = $this->calculateBranchRevenueForPeriod(
                $branch->branch_name,
                $startDate->format('Y-m-d'),
                $endDate->format('Y-m-d')
            );
            
            $cumulativeTarget += $monthlyTarget;
            $cumulativeActual += $actualRevenue;
            
            $variance = $actualRevenue - $monthlyTarget;
            $variancePercent = $monthlyTarget > 0 ? round(($variance / $monthlyTarget) * 100, 1) : 0;
            $achievementPercent = $monthlyTarget > 0 ? round(($actualRevenue / $monthlyTarget) * 100, 1) : 0;
            
            $monthlyData[] = [
                'month_number' => $month,
                'month_name' => $startDate->format('M Y'),
                'month_short' => $startDate->format('M'),
                'planned' => round($monthlyTarget, 2),
                'actual' => $actualRevenue,
                'variance' => $variance,
                'variance_percent' => $variancePercent,
                'achievement_percent' => $achievementPercent,
                'cumulative_planned' => round($cumulativeTarget, 2),
                'cumulative_actual' => $cumulativeActual,
                'cumulative_variance' => $cumulativeActual - $cumulativeTarget,
                'cumulative_variance_percent' => $cumulativeTarget > 0 ? round((($cumulativeActual - $cumulativeTarget) / $cumulativeTarget) * 100, 1) : 0
            ];
        }
        
        return $monthlyData;
    }

    /**
     * Calculate total branch revenue for a year
     * Uses customer's branch relationship to track revenue
     */
    private function calculateBranchRevenue($branchName, $year)
    {
        // Get all customers associated with this branch (by name)
        $customerIds = Customer::where('branch', $branchName)->pluck('customer_id')->toArray();
        
        // Calculate revenue from estimates for these customers
        $revenue = Estimate::whereIn('customer_id', $customerIds)
            ->whereYear('created_at', $year)
            ->where('estimate_status', 'complete')
            ->sum('estimate_total');
            
        return $revenue ?: 0;
    }

    /**
     * Calculate branch revenue for a specific period
     */
    private function calculateBranchRevenueForPeriod($branchName, $startDate, $endDate)
    {
        // Get all customers associated with this branch (by name)
        $customerIds = Customer::where('branch', $branchName)->pluck('customer_id')->toArray();
        
        // Calculate revenue from estimates for these customers within the date range
        $revenue = Estimate::whereIn('customer_id', $customerIds)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('estimate_status', 'complete')
            ->sum('estimate_total');
            
        return $revenue ?: 0;
    }

    /**
     * Get branch performance data as JSON for API calls
     */
    public function getBranchPerformanceData(Request $request)
    {
        $branchId = $request->get('branch_id');
        $year = $request->get('year', date('Y'));
        $period = $request->get('period', 'weekly'); // weekly or monthly
        
        $branch = CompanyBranches::find($branchId);
        if (!$branch) {
            return response()->json(['error' => 'Branch not found'], 404);
        }
        
        if ($period === 'weekly') {
            $data = $this->generateWeeklyData($branch, $year);
        } else {
            $data = $this->generateMonthlyData($branch, $year);
        }
        
        return response()->json([
            'branch' => $branch,
            'data' => $data,
            'period' => $period,
            'year' => $year
        ]);
    }
}
