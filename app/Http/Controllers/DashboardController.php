<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateSchedule;
use App\Models\ScheduleEstimate;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userDetails = session('user_details');
        if (session('user_details')['user_role'] == 'admin') {
            $customers = Customer::get();
            $staff = User::where('user_role', '<>', 'admin')->get();
            $confirmedOrders = Estimate::get();
            $schedules = EstimateSchedule::get();
            foreach ($schedules as $schedule) {
                $estimate = Estimate::where('estimate_id', $schedule->estimate_id)->first();
                $estimates[] = $estimate;
            }


            return view('dashboard', [
                'customers' => $customers,
                'staff' => $staff,
                'confirm_orders' => $confirmedOrders,
                'schedules' => [
                    $schedules,
                    $estimates,
                ],
            ]);
        } elseif (session('user_details')['user_role'] == 'crew') {
            $scheduleEstimatesWithEstimates = [];

        $scheduleEstimates = ScheduleEstimate::where('work_assign_id', $userDetails['id'])->get();

        foreach ($scheduleEstimates as $scheduleEstimate) {
            $estimate = Estimate::where('estimate_id', $scheduleEstimate->estimate_id)->first();

            if ($estimate) {
                // Associate ScheduleEstimate with Estimate
                $scheduleEstimatesWithEstimates[] = [
                    'schedule_estimate' => $scheduleEstimate,
                    'estimate' => $estimate,
                ];
            }
        }

        // Count total jobs
        $totalJobsCount = count($scheduleEstimates);

        // Count today jobs (assuming you have a 'start_date' property in ScheduleEstimate)
        $todayJobsCount = $scheduleEstimates->where('start_date', now()->format('Y-m-d'))->count();

        // Count pending jobs
        $pendingJobsCount = $scheduleEstimates->where('status', 'Pending')->count();

        // Count complete jobs
        $completeJobsCount = $scheduleEstimates->where('status', 'Complete')->count();

        return view('dashboard', [
            'schedule_estimates_with_estimates' => $scheduleEstimatesWithEstimates,
            'todayJobsCount' => $todayJobsCount,
            'pendingJobsCount' => $pendingJobsCount,
            'completeJobsCount' => $completeJobsCount,
            'totalJobsCount' => $totalJobsCount,
        ]);
        }
    }
}
