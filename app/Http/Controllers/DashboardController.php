<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateSchedule;
use App\Models\EstimateToDos;
use App\Models\ScheduleEstimate;
use App\Models\User;
use App\Models\UserToDo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($user = null)
    {
        if ($user != null) {
            $userDetails = User::where('id', $user)->first();
        }else{
            $userDetails = session('user_details');
        }

        if (session('user_details')['user_role'] == 'crew' || $userDetails['user_role'] == 'crew') {

            $scheduleEstimatesWithEstimates = [];

            $scheduleEstimates = ScheduleEstimate::where('work_assign_id', $userDetails['id'])->orderBy('schedule_estimate_id', 'DESC')->get();

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

            $userToDos = UserToDo::where('added_user_id', $userDetails['id'])->orderBy('to_do_id', 'DESC')->get();
            $estimateToDos = EstimateToDos::where('to_do_assigned_to', $userDetails['id'])->orderBy('to_do_id', 'DESC')->get();
            $admins = User::get();
            return view('dashboard', [
                'schedule_estimates_with_estimates' => $scheduleEstimatesWithEstimates,
                'todayJobsCount' => $todayJobsCount,
                'pendingJobsCount' => $pendingJobsCount,
                'completeJobsCount' => $completeJobsCount,
                'totalJobsCount' => $totalJobsCount,
                'Todos' => $userToDos,
                'estimateToDos' => $estimateToDos,
                'user_details' => $userDetails,
                'admins' => $admins,
            ]);
        } else {
            if ($user != null) {
                $userDetails = User::where('id', $user)->first();
                $customers = Customer::where('added_user_id', $user)->get();
                $staff = User::where('added_user_id', $user)->where('user_role', '<>', 'admin')->get();
                $confirmedOrders = Estimate::where('added_user_id', $user)->where('estimate_status', '<>', 'cancel')->get();
                $totalRevenue = Estimate::where('added_user_id', $user)->where('estimate_status', '<>', 'cancel')->sum('estimate_total');
                $schedules = EstimateSchedule::where('added_user_id', $user)->orderBy('estimate_schedule_id', 'DESC')->get();

                // Initialize $estimates as an empty array
                $estimates = [];

                foreach ($schedules as $schedule) {
                    $estimate = Estimate::where('added_user_id', $user)->where('estimate_id', $schedule->estimate_id)->first();
                    $estimates[] = $estimate;
                }

                $userToDos = UserToDo::where('added_user_id', $user)->orderBy('to_do_id', 'DESC')->get();
                $estimateToDos = EstimateToDos::where('to_do_assigned_to', $user)->orderBy('to_do_id', 'DESC')->get();
                $completeEstimates = Estimate::where('added_user_id', $user)->where('estimate_status', 'complete')->count();
                $pendingEstimates = Estimate::where('added_user_id', $user)->where('estimate_status', 'pending')->count();
                $cancelEstimates = Estimate::where('added_user_id', $user)->where('estimate_status', 'cancel')->count();
            } else {

                $customers = Customer::where('added_user_id', $userDetails['id'])->get();
                $staff = User::where('added_user_id', $userDetails['id'])->where('user_role', '<>', 'admin')->get();
                $confirmedOrders = Estimate::where('added_user_id', $userDetails['id'])->where('estimate_status', '<>', 'cancel')->get();
                $totalRevenue = Estimate::where('added_user_id', $userDetails['id'])->where('estimate_status', '<>', 'cancel')->sum('estimate_total');
                $schedules = EstimateSchedule::where('added_user_id', $userDetails['id'])->orderBy('estimate_schedule_id', 'DESC')->get();

                // Initialize $estimates as an empty array
                $estimates = [];

                foreach ($schedules as $schedule) {
                    $estimate = Estimate::where('added_user_id', $userDetails['id'])->where('estimate_id', $schedule->estimate_id)->first();
                    $estimates[] = $estimate;
                }

                $userToDos = UserToDo::where('added_user_id', $userDetails['id'])->orderBy('to_do_id', 'DESC')->get();
                $estimateToDos = EstimateToDos::where('to_do_assigned_to', $userDetails['id'])->orderBy('to_do_id', 'DESC')->get();
                $completeEstimates = Estimate::where('added_user_id', $userDetails['id'])->where('estimate_status', 'complete')->count();
                $pendingEstimates = Estimate::where('added_user_id', $userDetails['id'])->where('estimate_status', 'pending')->count();
                $cancelEstimates = Estimate::where('added_user_id', $userDetails['id'])->where('estimate_status', 'cancel')->count();
            }

            $admins = User::get();

            return view('dashboard', [
                'customers' => $customers,
                'staff' => $staff,
                'confirm_orders' => $confirmedOrders,
                'Todos' => $userToDos,
                'estimateToDos' => $estimateToDos,
                'schedules' => [
                    $schedules,
                    $estimates,
                ],
                'completeEstimates' => $completeEstimates,
                'pendingEstimates' => $pendingEstimates,
                'cancelEstimates' => $cancelEstimates,
                'revenue' => $totalRevenue,
                'admins' => $admins,
                'user_details' => $userDetails,
            ]);
        }
    }
}
