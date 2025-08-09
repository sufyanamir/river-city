<?php

namespace App\Http\Controllers\api;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

use App\Models\EstimateSchedule;
use App\Models\ScheduleEstimate;
use App\Models\EstimateToDos;
use App\Models\CompanyBranches;
use App\Models\EstimateItemTemplateItems;
use App\Models\EstimateItemTemplates;
use App\Models\Items;
use App\Models\Groups;
use App\Models\EstimateItem;
use App\Models\EstimateItemAssembly;
use App\Models\EstimateProposal;
use App\Models\EstimateContact;
use App\Models\EstimateActivity;
use App\Models\EstimateFile;
use App\Models\EstimateImages;
use App\Models\EstimateChat;
use App\Models\EstimateNote;
use App\Models\AssignPayment;
use App\Models\EstimatePayments;
use App\Models\EstimateExpenses;
use App\Models\CompleteEstimate;
use App\Models\Company;
use App\Models\ScheduleWork;
use App\Models\CompleteEstimateInvoiceWork;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Models\EstimateEmail;
use App\Mail\sendMailToClient;


use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\Notifications;
use App\Models\User;
use App\Models\UserToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiController extends Controller
{


    public function getUserDetails(Request $request)
    {
        try {
            $user = auth()->user();
            return response()->json(['success' => true,'message' => 'User details retrieved successfully','data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,'message' => $e->getMessage()], 400);
        }
    }

    public function login(Request $request)
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $user = User::where('email', $email)->first();

            $encryptedPassword = md5($password);

            if (!$user || $user->password != $encryptedPassword) {
                return response()->json(['success' => false,'message' => 'Invalid credentials'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['success' => true, 'message' => 'login successfull', 'token' => $token, 'userDetails' => $user], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false,'message' => $e->getMessage()], 400);
        }
    }


 // my first Api for Dashboard
   public function getDashboard($user = null){
    try {

        if ($user != null) {
            $userDetails = User::where('id', $user)->first();
        }else{
            $userDetails = auth()->user();
        }


        if ($userDetails->user_role == 'crew' || $userDetails->user_role == 'crew') {

            $scheduleEstimatesWithEstimates = [];

            $scheduleEstimates = ScheduleEstimate::where('work_assign_id', $userDetails->id)->orderBy('schedule_estimate_id', 'DESC')->get();

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

            $userToDos = UserToDo::where('added_user_id', $userDetails->id)->orderBy('to_do_id', 'DESC')->get();
            $estimateToDos = EstimateToDos::with('assigned_by')->where('to_do_assigned_to', $userDetails->id)->orderBy('to_do_id', 'DESC')->get();
            $admins = User::get();
            return response()->json([
                "success" => true,
                'data' => [
                    'schedule_estimates_with_estimates' => $scheduleEstimatesWithEstimates,
                    'todayJobsCount' => $todayJobsCount,
                    'pendingJobsCount' => $pendingJobsCount,
                    'completeJobsCount' => $completeJobsCount,
                    'totalJobsCount' => $totalJobsCount,
                    'Todos' => $userToDos,
                    'estimateToDos' => $estimateToDos,
                    'user_details' => $userDetails,
                    'admins' => $admins,
                ]
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
                $estimateToDos = EstimateToDos::with('assigned_by')->where('to_do_assigned_to', $user)->orderBy('to_do_id', 'DESC')->get();
                $completeEstimates = Estimate::where('added_user_id', $user)->where('estimate_status', 'complete')->count();
                $pendingEstimates = Estimate::where('added_user_id', $user)->where('estimate_status', 'pending')->count();
                $cancelEstimates = Estimate::where('added_user_id', $user)->where('estimate_status', 'cancel')->count();
            } else {

                $customers = Customer::where('added_user_id', $userDetails->id)->count();
                $staff = User::where('added_user_id', $userDetails->id)->where('user_role', '<>', 'admin')->count();
                $confirmedOrders = Estimate::where('added_user_id', $userDetails->id)->where('estimate_status', '<>', 'cancel')->count();
                $totalRevenue = Estimate::where('added_user_id', $userDetails->id)->where('estimate_status', '<>', 'cancel')->sum('estimate_total');
                $schedules = EstimateSchedule::where('added_user_id', $userDetails->id)->orderBy('estimate_schedule_id', 'DESC')->get();

                // Initialize $estimates as an empty array
                $estimates = [];

                foreach ($schedules as $schedule) {
                    $estimate = Estimate::where('added_user_id', $userDetails->id)->where('estimate_id', $schedule->estimate_id)->first();
                    $estimates[] = $estimate;
                }

                $userToDos = UserToDo::where('added_user_id', $userDetails->id)->orderBy('to_do_id', 'DESC')->get();
                $estimateToDos = EstimateToDos::with('assigned_by')->where('to_do_assigned_to', $userDetails->id)->orderBy('to_do_id', 'DESC')->get();
                $completeEstimates = Estimate::where('added_user_id', $userDetails->id)->where('estimate_status', 'complete')->count();
                $pendingEstimates = Estimate::where('added_user_id', $userDetails->id)->where('estimate_status', 'pending')->count();
                $cancelEstimates = Estimate::where('added_user_id', $userDetails->id)->where('estimate_status', 'cancel')->count();
            }

            $admins = User::get();

            return response()->json([
                "success" => true,
                "data" => [
                'total customers' => $customers,
                'total staff' => $staff,
                'confirm_orders' => $confirmedOrders,
                'total revenue' => $totalRevenue,
                'order summary' =>[
                    'completeEstimates' => $completeEstimates,
                    'pendingEstimates' => $pendingEstimates,
                    'cancelEstimates' => $cancelEstimates,
                ],
                'Todos' => $userToDos,
                // 'estimateToDos' => $estimateToDos,
                'schedules' => [
                    $schedules,
                    $estimates,
                ],
                // 'admins' => $admins,
                // 'user_details' => $userDetails,
                ]
            ]);
        }
    } catch (\Exception $e) {
        return response()->json([
            'seccess'=> false,
            'message' => 'Server Error',
            'error' => $e->getMessage()
        ], 500);
    }
   }

   public function getCustomer(){
    try {
        $userDetails = auth()->user();
        $customers = Customer::with('addedBy:id,name,user_role')->select('customer_id', 'added_user_id', 'customer_first_name', 'customer_last_name', 'customer_email', 'customer_phone', 'customer_primary_address', 'customer_city', 'customer_state', 'customer_zip_code', 'billing_address', 'billing_state', 'billing_zip', 'branch','potential_value', 'source')->where('customer_status', '<>', 'deleted')->get();
        $branches = CompanyBranches::get();
        $users = User::where('user_role', '<>', 'crew')->get();

        return response()->json([
            'success'=> true,
            'data'=>[
                'customers' => $customers,
                // 'users' => $users,
                // 'user_details' => $userDetails,
                // 'branches' => $branches
                ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success'=> false,
            'message'=> $e->getMessage()
        ], 500);
    }
   }

     public function updateCustomer(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'customer_id' => 'nullable',
                'first_name' => 'required|string',
                'last_name' => 'nullable|string',
                'email' => 'nullable|string',
                'phone' => 'nullable',
                'company_name' => 'nullable|string',
                'first_address' => 'required|string',
                'second_address' => 'nullable|string',
                'city' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
                'tax_rate' => 'nullable',
                'potential_value' => 'nullable|string',
                'internal_note' => 'nullable|string',
                'source' => 'nullable|string',
                'branch' => 'nullable',
                'billing_check' => 'nullable',
                'billing_city' => 'nullable|string',
                'billing_state' => 'nullable|string',
                'billing_zip_code' => 'nullable|string'
            ]);
                $firstAddress = $request->input('first_address');
                if ($firstAddress) {
                    $request->validate([
                        'city' => 'required|string',
                        'state' => 'required|string',
                        'zip_code' => 'required|numeric',
                ]);
                $fullAddress = $validatedData['first_address'] . ', ' .
                                        $validatedData['city'] . ', ' .
                                        $validatedData['state'] . ', ' .
                                        $validatedData['zip_code'];
                }

                 $billingCheck = $request->input('billing_check', 1);

                if ($billingCheck == 0) {
                    $request->validate([
                        'billing_address'   => 'required|string',
                        'billing_city'      => 'required|string',
                        'billing_state'     => 'required|string',
                        'billing_zip_code'  => 'required|numeric',
                    ]);
                    $fullBillingAddress = $request->billing_address . ', ' .
                                        $request->billing_city . ', ' .
                                        $request->billing_state . ', ' .
                                        $request->billing_zip_code;
                } else {
                    $fullBillingAddress = $validatedData['first_address'] . ', ' .
                                        $validatedData['city'] . ', ' .
                                        $validatedData['state'] . ', ' .
                                        $validatedData['zip_code'];
                }

            if ($validatedData['customer_id'] != null) {
                $customer = Customer::where('customer_id', $validatedData['customer_id'])->first();

                $customer->customer_first_name = $validatedData['first_name'];
                $customer->customer_last_name = $validatedData['last_name'];
                $customer->customer_email = $validatedData['email'];
                $customer->customer_phone = $validatedData['phone'];
                $customer->customer_company_name = $validatedData['company_name'];
                $customer->customer_primary_address = $validatedData['first_address'];
                $customer->customer_secondary_address = $validatedData['second_address'];
                $customer->customer_city = $validatedData['city'];
                $customer->customer_state = $validatedData['state'];
                $customer->customer_zip_code = $validatedData['zip_code'];
                $customer->tax_rate = $validatedData['tax_rate'];
                $customer->potential_value = $validatedData['potential_value'];
                $customer->company_internal_note = $validatedData['internal_note'];
                $customer->source = $validatedData['source'];
                $customer->branch = $validatedData['branch'];
                $customer->billing_address =  $request->billing_address;
                 $customer->billing_city = $request->billing_city;
                 $customer->billing_state = $request->billing_state;
                 $customer->billing_zip = $request->billing_zip_code;

                $customer->save();

                return response()->json(['success' => true, 'message' => 'Customer Updated Successfully!'], 200);
            }else{
                $customer = Customer::create([
                    'customer_first_name' => $validatedData['first_name'],
                    'customer_last_name' => $validatedData['last_name'],
                    'customer_email' => $validatedData['email'],
                    'customer_phone' => $validatedData['phone'],
                    'customer_company_name' => $validatedData['company_name'],
                    'customer_primary_address' => $validatedData['first_address'],
                    'customer_secondary_address' => $validatedData['second_address'],
                    'customer_city' => $validatedData['city'],
                    'customer_state' => $validatedData['state'],
                    'customer_zip_code' => $validatedData['zip_code'],
                    'tax_rate' => $validatedData['tax_rate'],
                    'potential_value' => $validatedData['potential_value'],
                    'company_internal_note' => $validatedData['internal_note'],
                    'source' => $validatedData['source'],
                    'branch' => $validatedData['branch'],
                    // 'owner' => $validatedData['owner'],
                    'added_user_id' => $userDetails['id'],
                    'billing_address'=> $request->billling_address,
                    'billing_city' => $request->billing_city,
                    'billing_state' => $request->billing_state,
                    'billing_zip' => $request->billing_zip_code,
                ]);
                return response()->json(['success' => true, 'message' => 'Customer Created Successfully!'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function getEstimateActivity($id)
    {
        try{
            $userDetails = Auth()->user();
        $activities = EstimateActivity::with('user:id,name,email,user_role')->where('estimate_id', $id)->orderBy('estimate_activity_id', 'desc')->get();

        return response()->json(['success' => true, 'message' => 'activities', $activities],200);
        // return view('estimate_activity', ['user_details' => $userDetails, 'activities' => $activities]);
        } catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function cancelEstimate($id)
    {
        try {

            $userDetails = Auth()->user();

            $estimate = Estimate::where('estimate_id', $id)->first();

            $estimate->estimate_status = 'cancel';

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Estimate Canceled!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        public function deleteEstimate($id){
            try{
                $estimate = Estimate::find($id);

                if ($estimate && $estimate->estimate_status !== 'deleted') {
                    $estimate->estimate_status = 'deleted';
                    $estimate->save();

                    return response()->json(['success' => true, 'message' => 'Estimate deleted successfully'], 200);
                }

                return response()->json(['success' => false, 'message' => 'estimate not found'], 404);
            } catch(\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }
    public function editCustomer($id){
        try {

            $customer = Customer::where('customer_id', $id)->first();

            if (!$customer) {
                return response()->json(['success' => false, 'message' => 'Customer not found!'], 200);
            }

            return response()->json([
                'success' => true,
                'customer' => $customer], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()], 400);
        }
    }

   public function deleteCustomer($id){
    try {
        $customer = Customer::with('estimates')->find($id);

        if ($customer && $customer->customer_status !== 'deleted') {

            $customer->customer_status = 'deleted';
            foreach ($customer->estimates as $estimate) {
                $estimate->estimate_status = 'deleted';
                $estimate->save();
            }

            $customer->save();

            return response()->json([
                'success' => true,
                'message' => "Customer and its related estimates marked as deleted."
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => "Customer deleted successfully."
        ], 404);
    } catch (\Exception $e) {
        return response()->json([
            'success'=> false,
            'error'=> $e->getMessage()
        ]);
    }
   }

   function getEstimate(Request $request, $type = null) {
    try {
         $userDetails = auth()->user();

        $status = $request->query('status');
        $branch = $request->query('branch');

        $branches = CompanyBranches::get();

        if ($userDetails['user_role'] == 'admin') {
            $customers = Customer::get();
            $query = Estimate::with('customer:customer_id,customer_first_name,customer_last_name,customer_email,branch,source', 'crew')->select('estimate_id', 'customer_id', 'complete_work_date', 'customer_name', 'customer_phone', 'customer_address', 'project_type', 'building_type', 'schedule_assigned', 'invoiced_payment', 'invoice_paid_total', 'estimate_status')
                ->where('estimate_status', $status ? $status : 'pending');

            if ($branch) {
                $query->whereHas('customer', function($q) use ($branch) {
                    $q->where('branch', $branch);
                });
            }

            $estimates = $query->orderBy('created_at', 'desc')->get();
            $users = User::where('user_role', '<>', 'crew')->where('sts', 'active')->get();
        } elseif ($userDetails['user_role'] == 'scheduler') {
            $query = Estimate::with('scheduler', 'assigned_work', 'customer', 'crew')
                ->where('estimate_status', $status ? $status : 'pending');

            if ($type == 'assigned') {
                $query->where('estimate_schedule_assigned_to', $userDetails->id);
            }

            if ($branch) {
                $query->whereHas('customer', function($q) use ($branch) {
                    $q->where('branch', $branch);
                });
            }

            $estimates = $query->orderBy('created_at', 'desc')->get();
            $customers = Customer::get();
            $users = User::where('user_role', '<>', 'crew')->where('sts', 'active')->get();
        } else {
            $query = Estimate::with('scheduler', 'assigned_work', 'customer', 'crew')
                ->where('estimate_status', $status ? $status : 'pending');

            if ($branch) {
                $query->whereHas('customer', function($q) use ($branch) {
                    $q->where('branch', $branch);
                });
            }

            $estimates = $query->orderBy('created_at', 'desc')->get();
            $customers = Customer::get();
            $users = User::where('user_role', '<>', 'crew')->where('sts', 'active')->get();
        }

        foreach ($estimates as $estimate) {
            // Decode the JSON safely
            $userIds = json_decode($estimate->estimate_schedule_assigned_to, true);

            // Ensure $userIds is an array; if null, set to an empty array
            if (!is_array($userIds) || empty($userIds)) {
                $userIds = []; // Avoid error in whereIn()
            }

            // Fetch users matching those IDs
            $schedulers = User::whereIn('id', $userIds)->get();

            // Attach users to the estimate dynamically
            $estimate->schedulers = $schedulers;
        }
        return response()->json([
            'success'=> true,
            'data'=>[
                'estimates' => $estimates,
                // 'user_details' => $userDetails,
                // 'customers' => $customers,
                // 'users' => $users,
                // 'branches' => $branches
            ]
            ]);
    } catch (\Exception $e) {
        return response()->json([
            'success'=> false,
            'error'=> $e->getMessage()
        ], 500);
    }
   }


    public function CustomerAndEstimateAdd(Request $request)
    {
        try {

            $userDetails = auth()->user();

            // dd($userDetails);
            $po_number = mt_rand(10000000, 99999999);


            $validatedData = $request->validate([
                'customer_id' => 'nullable',
                'first_name' => 'required|string',
                'last_name' => 'nullable|string',
                'email' => 'nullable|string',
                'phone' => 'required|string',
                'company_name' => 'nullable|string',
                'project_name' => 'nullable|string',
                'project_number' => 'nullable|string',
                'first_address' => 'required|string',
                'second_address' => 'nullable|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'zip_code' => 'required|numeric',
                'tax_rate' => 'nullable|numeric',
                'potential_value' => 'nullable|string',
                'internal_note' => 'nullable|string',
                'source' => 'nullable|string',
                'owner' => 'nullable|string',
                'branch' => 'required',
                'project_type' => 'nullable|string',
                'building_type' => 'nullable|string',
                'billing_check' => 'nullable|boolean'
            ]);
                     $firstAddress = $request->input('first_address');
                if ($firstAddress) {
                    $request->validate([
                        'city' => 'required|string',
                        'state' => 'required|string',
                        'zip_code' => 'required|numeric',
                ]);
                $fullAddress = $validatedData['first_address'] . ', ' .
                                        $validatedData['city'] . ', ' .
                                        $validatedData['state'] . ', ' .
                                        $validatedData['zip_code'];
                }

                $billingCheck = $request->input('billing_check', 1);

                if ($billingCheck == 0) {
                    $request->validate([
                        'billing_address'   => 'required|string',
                        'billing_city'      => 'required|string',
                        'billing_state'     => 'required|string',
                        'billing_zip_code'  => 'required|numeric',
                    ]);
                    $fullBillingAddress = $request->billing_address . ', ' .
                                        $request->billing_city . ', ' .
                                        $request->billing_state . ', ' .
                                        $request->billing_zip_code;
                } else {
                    $fullBillingAddress = $validatedData['first_address'] . ', ' .
                                        $validatedData['city'] . ', ' .
                                        $validatedData['state'] . ', ' .
                                        $validatedData['zip_code'];
                }


            $user = User::find($validatedData['owner']);

            if ($validatedData['customer_id']) {
                $customer = Customer::find($validatedData['customer_id']);
            } else {
                $customer = Customer::create([
                    'added_user_id' => $userDetails['id'],
                    'customer_first_name' => $validatedData['first_name'],
                    'customer_last_name' => $validatedData['last_name'],
                    'customer_email' => $validatedData['email'],
                    'customer_phone' => $validatedData['phone'],
                    'customer_company_name' => $validatedData['company_name'],
                    'customer_primary_address' => $validatedData['first_address'],
                    'customer_secondary_address' => $validatedData['second_address'],
                    'customer_city' => $validatedData['city'],
                    'customer_state' => $validatedData['state'],
                    'customer_zip_code' => $validatedData['zip_code'],
                    'tax_rate' => $validatedData['tax_rate'],
                    'potential_value' => $validatedData['potential_value'],
                    'source' => $validatedData['source'],
                    'branch' => $validatedData['branch'],
                    'billing_address' => $request->billing_address,
                    'billing_city' => $request->billing_city,
                    'billing_state' => $request->billing_state,
                    'billing_zip' => $request->billing_zip_code,
                ]);
            }

            $estimate = Estimate::create([
                'customer_id' => $customer->customer_id,
                'added_user_id' => $user->id,
                'customer_name' => $validatedData['first_name'],
                'customer_phone' => $validatedData['phone'],
                'customer_address' => $fullAddress,
                'customer_last_name' => $validatedData['last_name'],
                'tax_rate' => $validatedData['tax_rate'],
                'project_name' => $validatedData['project_name'],
                'project_number' => $validatedData['project_number'],
                'project_type' => $validatedData['project_type'],
                'building_type' => $validatedData['building_type'],
                'project_owner' => $user->name . ' ' . $user->last_name,
                'po_number' => $po_number,
                'estimate_internal_note' => $validatedData['internal_note'],
                'billing_address' => $request->billing_address,
                'billing_city' => $request->billing_city,
                'billing_state' => $request->billing_state,
                'billing_zip' => $request->billing_zip_code,
            ]);

            if ($validatedData['customer_id']) {
                $customer = Customer::find($validatedData['customer_id']);
                $notificationMessage = "A new Estimate has been created for " . $customer->customer_first_name . " " . $customer->customer_last_name . ".";
                $notification = Notifications::create([
                    'added_user_id' => $userDetails['id'],
                    'notification_message' => $notificationMessage,
                ]);
            } else {
                $notificationMessage = "A new Customer has been added " . $customer->customer_first_name . " " . $customer->customer_last_name . " and created an Estimate.";
                $notification = Notifications::create([
                    'added_user_id' => $userDetails['id'],
                    'notification_message' => $notificationMessage,
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Estimate created Successfully!', 'estimate_id' => $estimate->estimate_id], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function getEstimateDetails($id){
        try {
            $estimate = Estimate::where('estimate_id', $id)->first();
            if (!$estimate) {
                return response()->json(['success' => false, 'message' => 'Estimate not found!'], 404);
            }

            return response()->json(['success' => true, 'estimate' => $estimate], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function updateEstimateDetail(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'first_name' => 'nullable',
                'last_name' => 'nullable',
                // 'email' => 'nullable',
                'phone' => 'nullable',
                'project_name' => 'nullable',
                'project_number' => 'nullable',
                'project_type' => 'nullable',
                'building_type' => 'nullable',
                'first_address' => 'nullable',
                'tax_rate' => 'nullable',
                'owner' => 'nullable',
                'internal_note' => 'nullable',
            ]);

            $estimate = Estimate::find($validatedData['estimate_id']);

            $user = User::find($validatedData['owner']);

            if (!$estimate) {
                return response()->json(['success' => false, 'message' => 'Estimate not found!'], 404);
            }

            $estimate->customer_name = $validatedData['first_name'];
            $estimate->customer_last_name = $validatedData['last_name'];
            // $estimate->customer_email = $validatedData['email'];
            $estimate->customer_phone = $validatedData['phone'];
            $estimate->project_name = $validatedData['project_name'];
            $estimate->project_number = $validatedData['project_number'];
            $estimate->project_type = $validatedData['project_type'];
            $estimate->building_type = $validatedData['building_type'];
            $estimate->customer_address = $validatedData['first_address'];
            $estimate->tax_rate = $validatedData['tax_rate'];
            $estimate->project_owner = $user->name . ' ' . $user->last_name;
            $estimate->estimate_internal_note = $validatedData['internal_note'];

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Estimate details has been updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function addContacts(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'contact_title' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'nullable|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'estimate_id' => 'required',
            ]);

            $additionalContact = EstimateContact::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'contact_title' => $validatedData['contact_title'],
                'contact_first_name' => $validatedData['first_name'],
                'contact_last_name' => $validatedData['last_name'],
                'contact_email' => $validatedData['email'],
                'contact_phone' => $validatedData['phone'],
            ]);

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Contact Added', "A new Contact added in Contacts Section");

            return  response()->json(['success' => true, 'message' => 'Addtitional contact added'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function updateContact(Request $request)
    {
        try {
            $userDetails = auth()->user();
            $validatedData = $request->validate([
                'contact_id' => 'required',
                'contact_title' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'nullable|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'estimate_id' => 'required',
            ]);

            $contactInfo = EstimateContact::where('contact_id', $validatedData['contact_id'])->first();

            $contactInfo->contact_title = $validatedData['contact_title'];
            $contactInfo->contact_first_name = $validatedData['first_name'];
            $contactInfo->contact_last_name = $validatedData['last_name'];
            $contactInfo->contact_email = $validatedData['email'];
            $contactInfo->contact_phone = $validatedData['phone'];

            $contactInfo->save();

            return response()->json(['success' => true, 'message' => 'contact updated successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function deleteContact($id)
    {
        try {
            $additionalContact = EstimateContact::find($id);

            if (!$additionalContact) {
                return response()->json(['success' =>  false, 'message' => 'No contact found!'], 404);
            }

            $additionalContact->delete();

            return response()->json(['success' => true, 'message' => 'Contact deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }



        private function addEstimateActivity($userDetails, $estimateId, $activityTitle, $activityDescription)
    {
        EstimateActivity::create([
            'added_user_id' => $userDetails->id,
            'estimate_id' => $estimateId,
            'activity_title' => $activityTitle,
            'activity_description' => $activityDescription,
        ]);
    }
     public function addEstimateItems(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'item_id' => 'nullable',
                'item_type' => 'required|string',
                'item_name' => 'required',
                'item_units' => 'nullable',
                'labour_expense' => 'nullable',
                'material_expense' => 'nullable',
                'item_cost' => 'required',
                'item_price' => 'required',
                'item_qty' => 'required',
                'item_total' => 'required',
                'item_description' => 'nullable',
                'item_note' => 'nullable',
                'assembly_name' => 'nullable|array',
                'ass_item_id' => 'nullable|array',
                'assembly_unit_by_item_unit' => 'nullable|array',
                'item_unit_by_assembly_unit' => 'nullable|array',
                'is_upgrade' => 'nullable',
                'group_name' => 'nullable',
                'additional_item' => 'nullable',
                // 'selected_items' => 'required|array',
            ]);
            if (isset($validatedData['group_name']) && $validatedData['group_name'] != null) {
                $groupDetail = Groups::where('group_name', $validatedData['group_name'])->first();
                if (!$groupDetail) {
                    $groupDetail = Groups::create([
                        'group_name' => $validatedData['group_name'],
                        'group_type' => 'assemblies',
                        'show_unit_price' => 1,
                        'show_quantity' => 1,
                        'show_total' => 1,
                        'show_group_total' => 1,
                        'include_est_total' => 1,
                    ]);
                }
            } else {
                $groupDetail = Groups::where('group_name', 'Single')->first();
                if (!$groupDetail) {
                    $groupDetail = Groups::create([
                        'group_name' => 'Single',
                        'group_type' => 'assemblies',
                        'show_unit_price' => 1,
                        'show_quantity' => 1,
                        'show_total' => 1,
                        'show_group_total' => 1,
                        'include_est_total' => 1,
                    ]);
                }
            }

            $estimateItem = EstimateItem::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'item_id' => $validatedData['item_id'],
                'item_name' => $validatedData['item_name'],
                'item_type' => $validatedData['item_type'],
                'item_unit' => $validatedData['item_units'],
                'item_cost' => $validatedData['item_cost'],
                'item_price' => $validatedData['item_price'],
                'labour_expense' => $validatedData['labour_expense'],
                'material_expense' => $validatedData['material_expense'],
                'item_qty' => $validatedData['item_qty'],
                'item_total' => $validatedData['item_total'],
                'item_Description' => $validatedData['item_description'],
                'item_note' => $validatedData['item_note'],
                'is_upgrade' => $validatedData['is_upgrade'],
                'group_id' => $groupDetail->group_id,
                'additional_item' => $validatedData['additional_item'],
            ]);

            if (isset($validatedData['assembly_name'])) {
                // Iterate through each assembly name
                foreach ($validatedData['assembly_name'] as $key => $assemblyName) {
                    if ($assemblyName != null) {
                        $assItems = Items::where('item_id', $validatedData['ass_item_id'][$key])->first();

                        if (!$assItems) {
                            continue; // skip this iteration or handle as needed
                        }
                        // Calculate the sum for 'assembly_unit_by_item_unit' and 'item_unit_by_assembly_unit'
                        $itemUnitByAssUnitSum = $validatedData['item_unit_by_assembly_unit'][$key];
                        $assUnitByItemUnitSum = $validatedData['assembly_unit_by_item_unit'][$key];
                        $assItemQty = $validatedData['item_qty'] * $assUnitByItemUnitSum;
                        $assItemPrice = $assItems->item_price * $assItemQty;
                        // Create a new ItemAssembly for each assembly name
                        EstimateItemAssembly::create([
                            'added_user_id' => $userDetails->id,
                            'estimate_id' => $validatedData['estimate_id'],
                            'estimate_item_id' => $estimateItem->estimate_item_id,
                            'est_ass_item_name' => $assemblyName,
                            'item_unit_by_ass_unit' => $itemUnitByAssUnitSum,
                            'ass_unit_by_item_unit' => $assUnitByItemUnitSum,
                            'item_id' => $assItems->item_id,
                            'ass_item_cost' => $assItems->item_cost,
                            'ass_item_price' => $assItems->item_price,
                            'ass_item_qty' => $assItemQty,
                            'ass_item_total' => $assItemPrice,
                            'ass_item_unit' => $assItems->item_units,
                            'ass_item_description' => $assItems->item_description,
                            'ass_item_type' => $assItems->item_type,
                            'ass_labour_expense' => $assItems->labour_expense,
                            'ass_material_expense' => $assItems->material_expense,
                        ]);
                    }
                }
            }

            if ($validatedData['additional_item'] == 'no') {
                $pendingProposal = EstimateProposal::where('estimate_id', $validatedData['estimate_id'])->where('proposal_status', 'pending')->first();

                if ($pendingProposal) {
                    $pendingProposal->proposal_status = 'canceled';

                    $pendingProposal->save();
                }
            }
            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Line Item Added', "A new Line Item added in Items Section. The name of the Line Item is " . $validatedData['item_name'] . ".");

            return response()->json(['success' => true, 'message' => 'Items added to estimate'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getEstimateItem($id){
        try{
            $estimateItem = EstimateItem::with('group')->where('estimate_item_id', $id)->first();
            $estimateItemAssembly = EstimateItemAssembly::where('estimate_item_id', $estimateItem->estimate_item_id)->get();

            return response()->json([
                'success' => true,
                'item_detail' => $estimateItem,
                // 'assembly_items' => $estimateItemAssembly
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'error'=> $e->getMessage()
            ], 400);
        }
    }


        public function deleteEstimateItem($id)
    {
        try {
            $estimateItem = EstimateItem::where('estimate_item_id', $id)->first();

            if (!$estimateItem) {
                return response()->json(['success' => false, 'message' => 'Item not Found!'], 404);
            }

            $estimateItemAssemblies = EstimateItemAssembly::where('estimate_item_id', $estimateItem->estimate_item_id)->get();

            // Iterate over each item in the collection and delete it
            foreach ($estimateItemAssemblies as $assembly) {
                $assembly->delete();
            }

            // Delete the main item
            $estimateItem->delete();

            return response()->json(['success' => true, 'message' => 'Item Deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        // add ItemTemplates and Items
    public function addEstimateItemTemplate(Request $request)
    {
        // dd($request);
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'est_template_id' => 'required',
                'est_template_name' => 'required',
                'template_item_name' => 'nullable|array',
                'template_item_qty' => 'nullable|array',
                'template_item_id' => 'required|array',
                'estimate_template_description' => 'nullable',
                'estimate_template_note' => 'nullable',
                'group_name' => 'nullable',
            ]);
            if (isset($validatedData['group_name']) && $validatedData['group_name'] != null) {
                $groupDetail = Groups::where('group_name', $validatedData['group_name'])->first();
                if (!$groupDetail) {
                    $groupDetail = Groups::create([
                        'group_name' => $validatedData['group_name'],
                        'group_type' => 'assemblies',
                        'show_unit_price' => 1,
                        'show_quantity' => 1,
                        'show_total' => 1,
                        'show_group_total' => 1,
                        'include_est_total' => 1,
                    ]);
                }
            } else {
                $groupDetail = Groups::where('group_name', 'Single')->first();
                if (!$groupDetail) {
                    $groupDetail = Groups::create([
                        'group_name' => 'Single',
                        'group_type' => 'assemblies',
                        'show_unit_price' => 1,
                        'show_quantity' => 1,
                        'show_total' => 1,
                        'show_group_total' => 1,
                        'include_est_total' => 1,
                    ]);
                }
            }

            if (isset($validatedData['template_item_id'])) {
                foreach ($validatedData['template_item_id'] as $key => $itemId) {
                    $itemQty = $validatedData['template_item_qty'][$key];
                    if ($itemQty != null) {

                        $item = Items::with('assemblies')->find($itemId);

                        if ($item) {
                            $itemTotal = $itemQty * $item['item_price'];

                            $estimateItem = EstimateItem::create([
                                'added_user_id' => $userDetails['id'],
                                'estimate_id' => $validatedData['estimate_id'],
                                'item_id' => $itemId,
                                'item_name' => $item->item_name,
                                'item_type' => $item->item_type,
                                'item_unit' => $item->item_units,
                                'item_cost' => $item->item_cost,
                                'item_price' => $item->item_price,
                                'labour_expense' => $item->labour_expense,
                                'material_expense' => $item->material_expense,
                                'item_qty' => $itemQty,
                                'item_total' => $itemTotal,
                                'item_Description' => $item->item_description,
                                'item_note' => $item->item_note,
                                // 'is_upgrade' => $validatedData['is_upgrade'],
                                'group_id' => $groupDetail != null ? $groupDetail->group_id : $item->group_ids,
                            ]);

                            if ($item->item_type == 'assemblies') {
                                foreach ($item->assemblies as $key => $assItem) {

                                    $actItem = Items::where('item_id', $assItem->ass_item_id)->first();

                                    $assItemQty = $itemQty * $assItem->ass_unit_by_item_unit;
                                    // dd($actItem);
                                    $assItemPrice = $actItem->item_price * $assItemQty;
                                    EstimateItemAssembly::create([
                                        'added_user_id' => $userDetails['id'],
                                        'estimate_id' => $validatedData['estimate_id'],
                                        'estimate_item_id' => $estimateItem->estimate_item_id,
                                        'est_ass_item_name' => $assItem->assembly_name,
                                        'item_unit_by_ass_unit' => $assItem->item_unit_by_ass_unit,
                                        'ass_unit_by_item_unit' => $assItem->ass_unit_by_item_unit,
                                        'item_id' => $assItem->ass_item_id,
                                        'ass_item_cost' => $actItem->item_cost,
                                        'ass_item_price' => $actItem->item_price,
                                        'ass_item_qty' => $assItemQty,
                                        'ass_item_total' => $assItemPrice,
                                        'ass_item_unit' => $actItem->item_units,
                                        'ass_item_description' => $actItem->item_description,
                                        'ass_item_type' => $actItem->item_type,
                                        'ass_labour_expense' => $actItem->labour_expense,
                                        'ass_material_expense' => $actItem->material_expense,
                                    ]);
                                }
                            }
                        } else {
                            // Handle the case where the item with the given item_id is not found
                            return response()->json(['success' => false, 'message' => 'Item not found for item_id ' . $itemId], 404);
                        }
                    }
                }
            }

            $pendingProposal = EstimateProposal::where('estimate_id', $validatedData['estimate_id'])->where('proposal_status', 'pending')->first();

            if ($pendingProposal) {
                $pendingProposal->proposal_status = 'canceled';

                $pendingProposal->save();
            }


            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Line Items Added', "New Line items has been added from the template.");
            return response()->json(['success' => true, 'message' => 'Item Added!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }


        public function addEstimateFile(Request $request)
    {
        try {
            $userDetails = auth()->user();

            // Validate the form data
            $request->validate([
                'estimate_id' => 'required',
                'upload_file' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:2048', // Adjust validation rules as needed
            ]);

            // Process the form data and handle the file upload
            $estimateId = $request->input('estimate_id');
            $file = $request->file('upload_file');

            // Save the file to a specific location
            $path = $file->store('estimate_files', 'public');

            // Create a new record in the database
            $estimateFile = new EstimateFile([
                'added_user_id' =>  $userDetails['id'],
                'estimate_id' => $estimateId,
                'estimate_file_name' => $file->getClientOriginalName(), // Get the original file name
                'estimate_file' => $path,
            ]);

            $estimateFile->save();

            $this->addEstimateActivity($userDetails, $estimateId, 'File Uploaded', "A new File has been upload in Files Section");

            // Redirect or respond accordingly
            return response()->json(['success' => true, 'message' => 'File uploaded successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()],  400);
        }
    }

     public function deleteFile($id)
    {
        try {
            $file = EstimateFile::where('estimate_file_id', $id)->first();

            if (!$file) {
                return response()->json(['success' => false, 'message' => 'File not found!'], 404);
            }

            $filePath = $file->estimate_file;

            // Delete file from storage
            Storage::delete($filePath);

            // Delete record from the database
            $file->delete();

            return response()->json(['success' => true, 'message' => 'File deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle the exception if needed
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        public function viewGallery($id)
    {
       try {
         $userDetails = auth()->user();

        $estimate = Estimate::where('estimate_id', $id)
                    ->select('estimate_id','customer_id','customer_name','customer_phone','customer_address','billing_address','customer_last_name', 'project_owner')->first();
        $estimateImages = EstimateImages::where('estimate_id', $estimate->estimate_id)->get();
        $customer = Customer::select('customer_email')->where('customer_id', $estimate->customer_id)->first();
        $users = User::where('id', '<>', $userDetails->id)->where('sts', 'active')->get();
        $chatMessages = EstimateChat::with('addedUser')->where('estimate_id', $id)->orderby('estimate_chat_id', 'asc')->get();
        return response()->json([
            'success'=> true,
            'data'=>[
                // 'chatMessages' => $chatMessages,
                'estimate' => $estimate,
                'customer' => $customer,
                'estimate_images' => $estimateImages,
                // 'users' => $users,
                // 'user_details' => $userDetails
            ]
        ]);
       } catch (\Exception $e) {
        return response()->json([
            'success'=>false,
            'error'=> $e->getMessage()
        ], 400);
       }
    }


        // send proposal
    public function sendProposal(Request $request)
    {
        try {
            $userDetails = auth()->user();
            if ($request->input('secondProposal') == 1) {
                $validatedData = $request->validate([
                    'estimate_id' => 'required',
                    'email_to' => 'required|string',
                    'email_title' => 'required',
                    'email_subject' => 'required',
                    'email_body' => 'required',
                ]);

                $emailTo = explode(',', $validatedData['email_to']);

                $estimate = Estimate::with('customer')->where('estimate_id', $validatedData['estimate_id'])->first();
                $estimateCustomer = $estimate->customer_id;
                $loggedInUserEmail = $userDetails['email'] ?? 'noreply@example.com'; // Default fallback

                // Generate HTML Email Content
                $emailData = [
                    'estimate_id' => $validatedData['estimate_id'],
                    'customer_id' => $estimateCustomer,
                    'email' => $validatedData['email_to'],
                    'name' => $estimate['customer_name'] . ' ' . $estimate['customer_last_name'],
                    'title' => $validatedData['email_title'],
                    'subject' => $validatedData['email_subject'],
                    'body' => $validatedData['email_body'],
                    'branch' => $estimate->customer->branch,
                    'attachments' => [],
                ];

                // Render the email template into an HTML string
                $htmlEmailContent = View::make('emails.proposal-mail', ['emailData' => $emailData])->render();

                // Prepare the final data to send to Zapier
                $zapierData = [
                    'email_to' => '', // Will be set dynamically
                    'cc' => ['office@rivercitypaintinginc.com', $loggedInUserEmail], // Company + Logged-in User
                    'reply_to' => $loggedInUserEmail, // Set reply-to
                    'subject' => $validatedData['email_subject'],
                    'html_body' => $htmlEmailContent,
                    'attachments' => [],
                ];

                // Send the email via Zapier for each recipient
                foreach ($emailTo as $email) {
                    $zapierData['email_to'] = trim($email);
                    Http::post('https://hooks.zapier.com/hooks/catch/17891889/2q9xn0t/', $zapierData);
                }

                return response()->json(['success' => true, 'message' => 'Proposal mail sent successfully!', 'estimate_id' => $validatedData['estimate_id']], 200);
            } else {
                $validatedData = $request->validate([
                    'estimate_id' => 'required',
                    'email_to' => 'required|string',
                    'estimate_total' => 'required',
                    'email_title' => 'required',
                    'email_subject' => 'required',
                    'email_body' => 'required',
                    'terms_and_conditions' => 'required',
                    'discounted_total' => 'nullable',
                    'proposal_type' => 'nullable',
                    'group_id' => 'nullable'
                ]);
                $group_id = $validatedData['group_id'];
                $preview = null;
                // Prepare the proposal data
                $estimateCustomer = Estimate::where('estimate_id', $validatedData['estimate_id'])->pluck('customer_id')->first();
                $data = $this->prepareProposalData($validatedData['estimate_id'], $preview, $group_id);
                $data['terms_and_conditions'] = $validatedData['terms_and_conditions'];

                // Set estimate_total and customer_signature to null
                if (isset($data['estimate'])) {
                    $data['estimate']['estimate_total'] = null;
                    $data['estimate']['customer_signature'] = null;
                }

                $jsonData = json_encode($data);
                $emailTo = explode(',', $validatedData['email_to']);
                $loggedInUserEmail = $userDetails['email'] ?? 'noreply@example.com'; // Default fallback

                $estimate = Estimate::with('customer')->where('estimate_id', $validatedData['estimate_id'])->first();
                $estimateFiles = EstimateFile::where('estimate_id', $validatedData['estimate_id'])->get();
                $estimateImages = EstimateImages::where('estimate_id', $validatedData['estimate_id'])->where('attachment', 1)->get();

                // Generate HTML Email Content
                $emailData = [
                    'estimate_id' => $validatedData['estimate_id'],
                    'customer_id' => $estimateCustomer,
                    'email' => $validatedData['email_to'],
                    'name' => $estimate['customer_name'] . ' ' . $estimate['customer_last_name'],
                    'title' => $validatedData['email_title'],
                    'subject' => $validatedData['email_subject'],
                    'body' => $validatedData['email_body'],
                    'branch' => $estimate->customer->branch,
                    'attachments' => [],
                ];
                if ($group_id == null) {
                    $estimate->estimate_total = null;
                    $estimate->discounted_total = $validatedData['discounted_total'];
                    $estimate->save();
                }

                // Render the email template into an HTML string
                $htmlEmailContent = View::make('emails.proposal-mail', ['emailData' => $emailData])->render();

                // Attach files (Public URLs)
                foreach ($estimateFiles as $file) {
                    $filePath = storage_path('app/public/' . $file->estimate_file);
                    if (File::exists($filePath)) {
                        $url = asset('storage/' . $file->estimate_file);
                        $emailData['attachments'][] = $url;
                    }
                }

                foreach ($estimateImages as $image) {
                    $imagePath = storage_path('app/public/' . $image->estimate_image);
                    if (File::exists($imagePath)) {
                        $url = asset('storage/' . $image->estimate_image);
                        $emailData['attachments'][] = $url;
                    }
                }

                // Prepare the final data to send to Zapier
                $zapierData = [
                    'email_to' => '', // Will be set dynamically
                    'cc' => ['office@rivercitypaintinginc.com', $loggedInUserEmail], // Company + Logged-in User
                    'reply_to' => $loggedInUserEmail, // Set reply-to
                    'subject' => $validatedData['email_subject'],
                    'html_body' => $htmlEmailContent,
                    'attachments' => $emailData['attachments'],
                ];

                // Send the email via Zapier for each recipient
                foreach ($emailTo as $email) {
                    $zapierData['email_to'] = trim($email);
                    Http::post('https://hooks.zapier.com/hooks/catch/17891889/2q9xn0t/', $zapierData);
                }

                // Send a copy to the company (already included in CC, but for safety)
                // $zapierData['email_to'] = 'office@rivercitypaintinginc.com';
                // Http::post('https://hooks.zapier.com/hooks/catch/17891889/2q9xn0t/', $zapierData);
                if ($validatedData['group_id'] == null) {
                    $existingProposals = EstimateProposal::where('estimate_id', $validatedData['estimate_id'])->get();
                    if (!$existingProposals->isEmpty()) {
                        $existingProposals->each(function ($proposal) {
                            $proposal->proposal_status = 'canceled';
                            $proposal->save();
                        });
                    }
                }
                // Save proposal data in the database
                EstimateProposal::create([
                    'estimate_id' => $validatedData['estimate_id'],
                    'proposal_total' => $validatedData['estimate_total'],
                    'proposal_data' => $jsonData,
                    'proposal_terms_and_conditions' => $validatedData['terms_and_conditions'],
                    'proposal_type' => $validatedData['proposal_type'],
                    'group_id' => $validatedData['group_id'],
                ]);

                // Log activity
                $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Proposal Sent', "A Proposal has been created and sent to the Customer");

                return response()->json(['success' => true, 'message' => 'Proposal Sent Successfully!', 'estimate_id' => $validatedData['estimate_id']], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
        private function prepareProposalData($id, $preview = null, $group_id = null)
    {
        $userDetails = auth()->user();

        $estimate = Estimate::where('estimate_id', $id)->first();
        $customer = Customer::where('customer_id', $estimate->customer_id)->first();

        // Base query for estimate items
        $itemsQuery = EstimateItem::with('group')
            ->where('estimate_id', $estimate->estimate_id)
            ->where('item_type', '<>', 'upgrades')
            ->where('additional_item', '<>', 'yes')
            ->where('item_status', 'included');

        // If group_id is provided, filter by group_id
        if ($group_id) {
            $itemsQuery->where('group_id', $group_id);
        }


        $items = $itemsQuery->get();

        $items = $itemsQuery->get()->sortBy(function ($item) {
            return $item->sort_order == 0 ? PHP_INT_MAX : $item->sort_order;
        });

        $upgrades = EstimateItem::with('assemblies')
            ->where('estimate_id', $estimate->estimate_id)
            ->where('item_type', 'upgrades')
            ->where('item_status', 'included')
            ->get();

        $existingProposals = EstimateProposal::where('estimate_id', $id)->count();
        $estimateItemTemplates = EstimateItemTemplates::where('estimate_id', $estimate->estimate_id)
            ->where('template_status', 'included')
            ->get();
        $estimateItemTemplateItems = [];

        foreach ($estimateItemTemplates as $key => $itemTemplate) {
            $templateItems = EstimateItemTemplateItems::where('est_template_id', $itemTemplate->est_template_id)->get();

            // Extract item_qty from the template items
            $itemQuantities = $templateItems->pluck('item_qty')->toArray();
            $itemTotals = $templateItems->pluck('item_total')->toArray();

            // Fetch all data for Items
            $itemss = Items::whereIn('item_id', $templateItems->pluck('item_id')->toArray())->get();

            // Combine item_qty and Items data in a new array
            $combinedItems = [];
            foreach ($itemss as $index => $item) {
                $combinedItems[] = [
                    'est_template_item_id' => $templateItems[$index]->est_template_item_id,
                    'item_qty' => $itemQuantities[$index],
                    'item_total' => $itemTotals[$index],
                    'item_id' => $item->item_id,
                    'item_name' => $item->item_name,
                    'item_type' => $item->item_type,
                    'item_units' => $item->item_units,
                    'item_cost' => $templateItems[$index]->item_cost,
                    'item_price' => $templateItems[$index]->item_price,
                    'labour_expense' => $templateItems[$index]->labour_expense,
                    'material_expense' => $templateItems[$index]->material_expense,
                    'item_description' => $templateItems[$index]->item_description,
                    'item_note' => $templateItems[$index]->item_note,
                ];
            }

            // Add the combinedItems to the template items
            $itemTemplate->estimateItemTemplateItems = $combinedItems;

            // Add the modified itemTemplate to the result array
            $estimateItemTemplateItems[] = $itemTemplate;
        }

        return [
            'user_details' => $userDetails,
            'estimate' => $estimate,
            'customer' => $customer,
            'estimate_items' => $items,
            'existing_proposals' => $existingProposals,
            'upgrades' => $upgrades,
            'templates' => $estimateItemTemplates,
            'preview' => $preview,
            'group_id' => $group_id, // Optional: pass group_id to the view if needed
        ];
    }
        public function makeProposal($id, Request $request)
    {
        try {

            $preview = $request->query('preview');
            $group_id = $request->query('group_id');

            $data = $this->prepareProposalData($id, $preview, $group_id);

            return response()->json([
                'success'=> true,
                'data'=> $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()], 400);
        }
    }

        public function viewProposal(Request $request)
    {
        try {
            $estimateId = $request->query('estimateId');
            $proposalId = $request->query('proposalId');
            $group_id = $request->query('group_id');
            $preview = null;

            if ($estimateId) {
                // $data = $this->prepareProposalData($estimateId, $preview, $group_id);

                // Fetch the latest proposal with priority to 'pending' status
                $latestProposal = EstimateProposal::where('estimate_Proposal_id', $estimateId)
                    ->where(function ($query) {
                        $query->where('proposal_status', 'pending')
                            ->orWhere('proposal_status', 'accepted');
                    })->when($group_id, function ($query, $group_id) {
                        return $query->where('group_id', $group_id);
                    })
                    ->orderByRaw("FIELD(proposal_status, 'pending', 'accepted')")
                    ->orderBy('created_at', 'desc')
                    ->first();
                // dd($latestProposal);
                $data = json_decode($latestProposal->proposal_data, true);
                // return response()->json(['success' => true, 'data' => $data], 200);
                if ($latestProposal) {
                    $data['terms_and_conditions'] = $latestProposal->proposal_terms_and_conditions;
                } else {
                    return response()->json(['success' => false, 'message' => 'No valid proposal found'], 404);
                    // return view('accept-proposal', ['success' => false, 'message' => 'No valid Estimate found', 'sts' => 404]);
                }
                $proposalData = json_decode($latestProposal->proposal_data, true);
                $userIdfromProposal = $proposalData['estimate']['added_user_id'];
                $proposalData = json_decode($latestProposal->proposal_data, true);
                if (!session()->has('user_details')) {
                    $notificationMessage = 'The proposal that you send has been viewed by the customer ' . $proposalData['estimate']['customer_name'] . ' ' . $proposalData['estimate']['customer_last_name'] . '. Please check the Estimate no. ' . $proposalData['estimate']['estimate_id'] . ' for more details.';

                    $notification = Notifications::create([
                        'added_user_id' => $userIdfromProposal,
                        'notification_message' => $notificationMessage,
                    ]);
                    $latestProposal->view_count++;
                    $latestProposal->last_viewed_at = now();
                    $latestProposal->save();
                }
                $data['proposal_id'] = $latestProposal->estimate_proposal_id;
                $data['group_id'] = $latestProposal->group_id;
                $data['proposal_status'] = $latestProposal->proposal_status;
            } elseif ($proposalId) {


                // Fetch the latest proposal with priority to 'pending' status
                $latestProposal = EstimateProposal::where('estimate_proposal_id', $proposalId)
                    ->when($group_id, function ($query, $group_id) {
                        return $query->where('group_id', $group_id);
                    })
                    ->first();
                $proposalData = json_decode($latestProposal->proposal_data, true);
                // dd($latestProposal);
                $estimateId = $latestProposal->estimate_id;
                $data = $proposalData;

                if ($latestProposal) {
                    $data['terms_and_conditions'] = $latestProposal->proposal_terms_and_conditions;
                } else {
                    return response()->json(['success' => false, 'message' => 'No valid proposal found'], 404);
                    // return view('accept-proposal', ['success' => false, 'message' => 'No valid Estimate found', 'sts' => 404]);
                }

                $userIdfromProposal = $proposalData['estimate']['added_user_id'];
                $proposalData = json_decode($latestProposal->proposal_data, true);
                if (!session()->has('user_details')) {
                    $notificationMessage = 'The proposal that you send has been viewed by the customer ' . $proposalData['estimate']['customer_name'] . ' ' . $proposalData['estimate']['customer_last_name'] . '. Please check the Estimate no. ' . $proposalData['estimate']['estimate_id'] . ' for more details.';

                    $notification = Notifications::create([
                        'added_user_id' => $userIdfromProposal,
                        'notification_message' => $notificationMessage,
                    ]);
                }
                $data['proposal_id'] = $latestProposal->estimate_proposal_id;
                $data['group_id'] = $latestProposal->group_id;
                $data['proposal_status'] = $latestProposal->proposal_status;
                $data['proposal_total'] = $latestProposal->proposal_total;
                // dd($data);
                return response()->json([
                    'success'=> false,
                    'data' => $data
                ], 200);
                // return view('previousProposal', $data);
            } else {
                return response()->json(['success' => false, 'message' => 'No valid ID provided'], 400);
                // return view('accept-proposal', ['success' => false, 'message' => 'No valid ID provided', 'sts' => 400]);
            }

            return response()->json([
                'success'=> true,
                'data' => $data
            ], 200);
            // return view('accept-proposal', $data);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        // estimate note
    public function addEstimateNote(Request $request)
    {
        try {

            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'estimate_note' => 'required|string',
            ]);

            $estimateNote = EstimateNote::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'estimate_note' => $validatedData['estimate_note'],
            ]);

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Note Added', "A new Note added in Notes Section");

            return response()->json(['success' => true, 'message' => 'Note added!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        // edit estimate note
    public function editEstimateNote(Request $request)
    {
        try {

            $userDetails = auth()->user();
            $validatedData = $request->validate([
                'note_id' => 'required',
                'estimate_note' => 'required',
            ]);

            $estimateNote = EstimateNote::where('estimate_note_id', $validatedData['note_id'])->first();

            if (!$estimateNote) {
                return response()->json(['success' => false, 'message' => 'Note not found!'], 404);
            }

            $estimateNote->estimate_note = $validatedData['estimate_note'];

            $estimateNote->save();

            return response()->json(['success' => true, 'message' => 'Note updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        public function deleteEstimateNote($id)
    {
        try {
            $estimateNote = EstimateNote::where('estimate_note_id', $id)->first();

            if (!$estimateNote) {
                return response()->json(['success' => false, 'message' => 'Note not found!'], 404);
            }

            $estimateNote->delete();

            return response()->json(['success' => true, 'message' => 'Note deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function sendEmail(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'email_id' => 'required|integer',
                'email_name' => 'required|string',
                'email_to' => 'required|string',
                'email_subject' => 'nullable|string',
                'email_body' => 'required|string',
                'customer_id' => 'required',
            ]);

            $customer = Customer::where('customer_id', $validatedData['customer_id'])->first();

            $emailData = [
                'estimate_id' => $validatedData['estimate_id'],
                'email_id' => $validatedData['email_id'],
                'email_name' => $validatedData['email_name'],
                'email_to' => $validatedData['email_to'],
                'email_subject' => $validatedData['email_subject'],
                'email_body' => $validatedData['email_body'], // Use the modified email body
                'name' => $customer->customer_first_name . ' ' . $customer->customer_last_name,
                'branch' => $customer->branch,
            ];

            // Create an instance of the Mailable class
            $mail = new sendMailToClient($emailData);

            Mail::to($validatedData['email_to'])
                ->send($mail);

            $mail = EstimateEmail::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'email_id' => $validatedData['email_id'],
                'email_name' => $validatedData['email_name'],
                'email_to' => $validatedData['email_to'],
                'email_subject' => $validatedData['email_subject'],
                'email_body' => $validatedData['email_body'],
            ]);

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Email Sent', "An Email has been sent to the Customer. The Subject of the email is " . $validatedData['email_subject'] . ".");

            return response()->json([
                'success' => true,
                'message' => 'Email sent to the client!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function addPayment(Request $request){
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'invoice_id' => 'required',
                'invoice_date' => 'required',
                'invoice_amount' => 'nullable|numeric',
                'note' => 'nullable|string',
                'po_number' => 'required|string',
            ]);

            $estimateCompleteInvoices = AssignPayment::where('estimate_id', $validatedData['estimate_id'])
                ->where('invoice_status', 'unpaid')
                ->first();

            // If no unpaid invoice found
            if (!$estimateCompleteInvoices) {
                return response()->json([
                    'success' => false,
                    'message' => 'No unpaid invoice found for the provided estimate ID.'
                ], 404);
            }

            // Mark invoice as paid
            $estimateCompleteInvoices->invoice_status = 'paid';
            $estimateCompleteInvoices->save();

            $estimate = Estimate::with('invoices')
                ->where('estimate_id', $validatedData['estimate_id'])
                ->first();

            $customer = Customer::where('customer_id', $estimate->customer_id)->first();

            $estimate->invoice_paid = 1;
            $estimate->invoice_paid_total += $validatedData['invoice_amount'];
            $estimate->estimate_status = 'paid';
            $estimate->save();

            EstimatePayments::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $estimate->estimate_id,
                'estimate_complete_invoice_id' => $estimateCompleteInvoices->estimate_complete_invoice_id,
                'complete_invoice_date' => $validatedData['invoice_date'],
                'invoice_total' => $validatedData['invoice_amount'],
                'note' => $validatedData['note'],
            ]);

            $this->addEstimateActivity(
                $userDetails,
                $validatedData['estimate_id'],
                'Payment Completed',
                "Payment has been completed of the Estimate."
            );

            return response()->json([
                'success' => true,
                'message' => 'Payment has been completed!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'error'=> $e->getMessage()
            ], 400);
        }
    }

        // get payment
    public function getPayment($id)
    {
        try {
            $invoice = AssignPayment::select('added_user_id', 'estimate_id', 'payment_assigned_to', 'start_date', 'end_date', 'note', 'complete_invoice_date', 'invoice_name', 'tax_rate', 'invoice_total', 'invoice_due', 'invoice_status', 'invoice_subtotal')->where('estimate_complete_invoice_id', $id)->first();
            // $invoice = AssignPayment::where('estimate_complete_invoice_id', $id)->first();
            $payment = EstimatePayments::where('estimate_complete_invoice_id', $id)->first();
            if (!$invoice) {
                return response()->json(['success' => false, 'message' => 'Payment not found!'], 404);
            }
            if (!$payment) {
                return response()->json(['success' => false, 'message' => 'Payment not found!'], 404);
            }

            return response()->json(['success' => true, 'payment' => $payment, 'invoice' => $invoice], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function updatePayment(Request $request)
    {
        try {
            $userDetails = auth()->user();
            $validatedData = $request->validate([
                'payment_id' => 'required',
                'invoice_date' => 'nullable',
                'invoice_amount' => 'nullable',
                'note' => 'nullable',
            ]);

            $payment = EstimatePayments::where('estimate_payment_id', $validatedData['payment_id'])->first();
            $invoice = AssignPayment::where('estimate_complete_invoice_id', $payment->estimate_complete_invoice_id)->first();
            $payment->complete_invoice_date = $validatedData['invoice_date'];
            $payment->invoice_total = $validatedData['invoice_amount'];
            $payment->note = $validatedData['note'];

            $estimate = Estimate::where('estimate_id', $payment->estimate_id)->first();

            $estimate->invoice_paid_total = $validatedData['invoice_amount'];

            if ($invoice->invoice_status == 'unpaid') {
                $invoice->invoice_status = 'paid';
                $invoice->save();
            }

            $payment->save();
            $estimate->save();
            $this->addEstimateActivity($userDetails, $payment->estimate_id, 'Payment Updated', "An existing payment has been updated.");
            return response()->json(['success' => true, 'message' => 'Payment updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        public function deletePayment($id)
    {
        try {
            $userDetails = auth()->user();
            $payment = EstimatePayments::where('estimate_payment_id', $id)->first();

            if (!$payment) {
                return response()->json(['success' => false, 'message' => 'Payment not found!'], 404);
            }

            $invoice = AssignPayment::where('estimate_complete_invoice_id', $payment->estimate_complete_invoice_id)->first();
            $estimate = Estimate::where('estimate_id', $payment->estimate_id)->first();

            if ($invoice) {
                $invoice->invoice_status = 'unpaid';
                $invoice->save();
            }
            $estimate->invoice_paid_total = $estimate->invoice_paid_total - $payment->invoice_total;
            $estimate->save();

            $this->addEstimateActivity($userDetails, $payment->estimate_id, 'Payment Deleted', "A payment has been deleted.");
            $payment->delete();

            return response()->json(['success' => true, 'message' => 'Payment deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        public function viewPayment($id)
    {
        try {
            $userDetails = auth()->user();
            $estimate = Estimate::with('customer:customer_id,customer_first_name,customer_last_name,customer_email,customer_phone,customer_primary_address,customer_secondary_address,customer_city,customer_state,customer_zip_code,billing_address,billing_city,billing_state,billing_zip')->where('estimate_id', $id)
            ->select('estimate_id','customer_id','customer_name','customer_phone','customer_address','billing_address','customer_last_name','project_name','project_number','project_type','building_type','project_owner')
            ->first();
            $payment = EstimatePayments::where('estimate_payment_id', $id)->first();
            // dd($payment);
            return response()->json([
                'success'=>true,
                'data' => ['payment' => $payment, 'estimate' => $estimate, 'type' => 'Payment']
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function addEstimateExpense(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'date' => 'required',
                'item_type' => 'required',
                'vendor' => 'required',
                'hours' => 'nullable',
                'subtotal' => 'required',
                'tax' => 'nullable',
                'total' => 'required',
                'paid' => 'nullable',
                'description' => 'nullable',
            ]);
            $paid = isset($validatedData['paid']) ? $validatedData['paid'] : 'not paid';
            $expense = EstimateExpenses::create([
                'added_user_id' =>  $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'expense_date' => $validatedData['date'],
                'expense_item_type' => $validatedData['item_type'],
                'expense_vendor' => $validatedData['vendor'],
                'labour_hours' => $validatedData['hours'],
                'expense_subtotal' => $validatedData['subtotal'],
                'expense_tax' => $validatedData['tax'],
                'expense_total' => $validatedData['total'],
                'expense_paid' => $paid,
                'expense_description' => $validatedData['description'],
            ]);

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Expense Added', "A new Expense added in Expenses Section");

            return response()->json(['success' => true, 'message' => 'Expense added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }


        public function getExpenseDataToEdit($id)
    {
        try {
            $expense = EstimateExpenses::where('estimate_expense_id', $id)->first();

            return response()->json(['success' => true, 'expense_detail' => $expense], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }


        // edit estimate expenses
    public function updateEstimateExpense(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_expense_id' => 'required',
                'date' => 'nullable',
                'item_type' => 'nullable',
                'vendor' => 'nullable',
                'hours' => 'nullable',
                'subtotal' => 'nullable',
                'tax' => 'nullable',
                'total' => 'nullable',
                'paid' => 'nullable',
                'description' => 'nullable',
            ]);

            $expense = EstimateExpenses::where('estimate_expense_id', $validatedData['estimate_expense_id'])->first();

            if (isset($validatedData['date'])) {
                $expense->expense_date = $validatedData['date'];
            }
            $expense->expense_item_type = $validatedData['item_type'];
            $expense->expense_vendor = $validatedData['vendor'];
            $expense->labour_hours = $validatedData['hours'];
            $expense->expense_subtotal = $validatedData['subtotal'];
            $expense->expense_tax = $validatedData['tax'];
            $expense->expense_total = $validatedData['total'];
            if (isset($validatedData['paid']) == 'paid') {
                $expense->expense_paid = 'paid';
            }
            $expense->expense_description = $validatedData['description'];

            $expense->save();

            return response()->json(['success' => true, 'message' => 'Expense Updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        // delete estimate expenses
    public function deleteEstimateExpense($id)
    {
        try {

            $expense = EstimateExpenses::where('estimate_expense_id', $id)->first();

            if (!$expense) {
                return response()->json(['success' => false, 'message' => 'Expense not found!'], 404);
            }

            $expense->delete();

            return response()->json(['success' => true, 'message' => 'Expense deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function completeInvoiceAndAssignPayment(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'complete_invoice_date' => 'required',
                'assign_payment' => 'nullable',
                'invoice_name' => 'nullable',
                'subtotal_input' => 'nullable',
                'tax_input' => 'nullable',
                'total_input' => 'nullable',
                'note' => 'nullable',
            ]);

            // Fetch the estimate with its customer
            $estimate = Estimate::with('customer')->where('estimate_id', $validatedData['estimate_id'])->first();

            // Set default values if total_input or subtotal_input are not provided
            $totalInput = $validatedData['total_input'] ?? $estimate->estimate_total;
            $subtotalInput = $validatedData['subtotal_input'] ?? $estimate->estimate_total;

            // Update invoiced_payment with the total input value
            $estimate->invoiced_payment = $estimate->invoiced_payment + $totalInput;
            $estimate->payment_assigned = 1;

            // Create a new AssignPayment record
            $assignPayment = AssignPayment::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'payment_assigned_to' => $validatedData['assign_payment'] ?? $userDetails['id'],
                'note' => $validatedData['note'],
                'complete_invoice_date' => $validatedData['complete_invoice_date'],
                'invoice_name' => $validatedData['invoice_name'] ?? 'Final Invoice',
                'tax_rate' => $validatedData['tax_input'] ?? 0,
                'invoice_total' => $totalInput,
                'invoice_due' => $totalInput,
                'invoice_subtotal' => $subtotalInput,
            ]);
            $estimate->save();

            // Log the activity
            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Invoice Created', "A new Invoice has been created for the customer, added in Invoices Section");

            return response()->json(['success' => true, 'message' => 'Invoice Completed and Payment assigned!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        // get invoice
    public function getInvoice($id)
    {
        try {

            $invoice = AssignPayment::select('estimate_complete_invoice_id', 'added_user_id', 'estimate_id', 'payment_assigned_to', 'start_date', 'end_date', 'note', 'complete_invoice_date', 'invoice_name', 'tax_rate', 'invoice_total', 'invoice_due', 'invoice_status', 'invoice_subtotal')->where('estimate_complete_invoice_id', $id)->first();

            if (!$invoice) {
                return response()->json(['success' => false, 'message' => 'Invoice not found!'], 404);
            }

            return response()->json(['success' => true, 'invoice' => $invoice], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function updateInvoice(Request $request)
    {
        try {
            $userDetails = auth()->user();
            $validatedData = $request->validate([
                'invoice_id' => 'required',
                'estimate_id' => 'required',
                'complete_invoice_date' => 'required',
                'assign_payment' => 'nullable',
                'invoice_name' => 'nullable',
                'subtotal_input' => 'nullable',
                'tax_input' => 'nullable',
                'total_input' => 'nullable',
                'note' => 'nullable',
            ]);

            $invoice = AssignPayment::where('estimate_complete_invoice_id', $validatedData['invoice_id'])->first();

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->invoiced_payment = $estimate->invoiced_payment - $invoice->invoice_total;

            $invoice->complete_invoice_date = $validatedData['complete_invoice_date'];
            $invoice->invoice_name = $validatedData['invoice_name'];
            $invoice->invoice_subtotal = $validatedData['subtotal_input'];
            $invoice->tax_rate = $validatedData['tax_input'];
            $invoice->invoice_total = $validatedData['total_input'];
            $invoice->invoice_due = $validatedData['total_input'];

            $invoice->save();

            $estimate->invoiced_payment = $estimate->invoiced_payment + $invoice->invoice_total;

            $estimate->save();

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Invoice Updated', "The details of an existing invoice updated.");
            return response()->json(['success' => true, 'message' => 'Invoice updated successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function deleteInvoice($id)
    {
        try {
            $userDetails = auth()->user();

            $invoice = AssignPayment::where('estimate_complete_invoice_id', $id)->first();
            $estimate = Estimate::where('estimate_id', $invoice->estimate_id)->first();

            if (!$invoice) {
                return response()->json(['success' => false, 'message' => 'Invoice not found!'], 404);
            }

            $estimate->invoiced_payment = $estimate->invoiced_payment - $invoice->invoice_total;
            $estimate->save();

            $invoice->delete();
            $this->addEstimateActivity($userDetails, $invoice->estimate_id, 'Invoice Deleted', "An Invoice has been deleted.");
            return response()->json(['success' => true, 'message' => 'Invoice deleted Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        public function viewInvoice($id)
    {
        try {
            $userDetails = auth()->user();
            $estimate = Estimate::with('customer:customer_id,customer_first_name,customer_last_name,customer_email,customer_phone,customer_primary_address,customer_secondary_address,customer_city,customer_state,customer_zip_code,billing_address,billing_city,billing_state,billing_zip')->where('estimate_id', $id)
            ->select('estimate_id','customer_id','customer_name','customer_phone','customer_address','billing_address','customer_last_name','project_name','project_number','project_type','building_type','project_owner')->first();
            $invoice = AssignPayment::select('estimate_complete_invoice_id','added_user_id', 'estimate_id', 'payment_assigned_to', 'start_date', 'end_date', 'note', 'complete_invoice_date', 'invoice_name', 'tax_rate', 'invoice_total', 'invoice_due', 'invoice_status', 'invoice_subtotal')->where('estimate_complete_invoice_id', $id)->first();
            // dd($invoice);
            return response()->json([
                'success'=> true,
                'data'=> [
                    // 'user_details' => $userDetails,
                    'invoice' => $invoice,
                    'estimate' => $estimate,
                    'type' => 'Invoice'
                    ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

      public function addToDos(Request  $request)
    {
        try {
            $userDetails = auth()->user();

            if ($request->input('estimate_schedule_id') != null) {
                $toDoId = $request->input('estimate_schedule_id');
                $estimateToDo = EstimateToDos::where('to_do_id', $toDoId)->first();
                $validatedData = $request->validate([
                    'start_date' => 'nullable',
                    'end_date' => 'nullable',
                    'task_name' => 'required',
                    'note' => 'nullable',
                    'assign_work' => 'required',
                ]);
                $estimateToDo->start_date = $validatedData['start_date'];
                $estimateToDo->end_date = $validatedData['end_date'];
                $estimateToDo->to_do_title = $validatedData['task_name'];
                $estimateToDo->to_do_assigned_to = $validatedData['assign_work'];
                $estimateToDo->note = $validatedData['note'];
                $estimateToDo->save();
                return response()->json(['success' => true, 'message' => 'To Do updated!'], 200);
            } else {
                $validatedData = $request->validate([
                    'estimate_id' => 'required',
                    'task_name' =>  'required',
                    'assign_work' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'note' => 'nullable',
                ]);
                foreach ($validatedData['assign_work'] as $userId) {
                    $toDo = EstimateToDos::create([
                        'added_user_id' => $userDetails['id'],
                        'estimate_id' => $validatedData['estimate_id'],
                        'to_do_title' => $validatedData['task_name'],
                        'to_do_assigned_to' => $userId,
                        'start_date' => $validatedData['start_date'],
                        'end_date' => $validatedData['end_date'],
                        'note' => $validatedData['note'],
                    ]);
                }

                $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'To-Do Added', "A new To-Do added in To-Dos Section");

                return response()->json(['success' => true, 'message' => 'To Do Added!'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }


     public function completeToDo($id)
    {
        try {
            $toDo = EstimateToDos::where('to_do_id', $id)->first();

            $toDo->to_do_status = 'completed';

            $toDo->save();

            return response()->json(['success' => true, 'message' => 'To Do completed!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

     public function deleteToDo($id)
    {
        try {
            $toDo = EstimateToDos::where('to_do_id', $id)->first();

            if (!$toDo) {
                return response()->json(['success' => false, 'message' => 'No To Do found!'], 404);
            }

            $toDo->delete();

            return response()->json(['success' => true, 'message' => 'To Do deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // public function addUserToDo(Request $request)
    // {
    //     try {
    //         $apiUser = $request->user();

    //         $validatedData = $request->validate([
    //             'to_do_title' => 'required',
    //             'start_date' => 'nullable',
    //             'end_date' => 'nullable',
    //             'note' => 'nullable',
    //             'address' => 'nullable',
    //         ]);

    //             UserToDo::create([
    //                 'added_user_id' => $apiUser->id,
    //                 'to_do_title' => $validatedData['to_do_title'],
    //                 'start_date' => $validatedData['start_date'],
    //                 'end_date' => $validatedData['end_date'],
    //                 'note' => $validatedData['note'],
    //                 'to_do_assigned_to' => $apiUser->id,
    //                 'to_do_address' => $validatedData['address'],
    //             ]);

    //         return response()->json(['success' => true, 'message' => 'To Do added!'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    //     }
    // }


    //Schedule Estimate
     public function getEstimatesOnCalendar($id = null)
    {
        try{
                    $userDetails = auth()->user();
        $branch = request()->query('branch');
        $branches = CompanyBranches::get();

        if ($userDetails['user_role'] == 'crew') {

            $scheduleEstimates = ScheduleEstimate::get();
            $estimates = [];
            foreach ($scheduleEstimates as $scheduleEstimate) {
                $query = Estimate::with(['scheduler', 'crew'])->where('estimate_id', $scheduleEstimate->estimate_id);

                if ($branch) {
                    $query->whereHas('customer', function($q) use ($branch) {
                        $q->where('branch', $branch);
                    });
                }

                $estimate = $query->first();
                if ($estimate) {
                    $estimates[] = $estimate;
                }
            }

            $userToDos = UserToDo::with('assigned_to')->get();
            $estimateToDos = EstimateToDos::with('assigned_by')->get();
            $allEmployees = User::where('sts', 'active')->get();
            return view('calendar', ['estimates' => $estimates, 'allEmployees' => $allEmployees, 'userToDos' => $userToDos, 'estimateToDos' => $estimateToDos, 'branches' => $branches]);
        } elseif ($userDetails['user_role'] == 'scheduler') {
            $query = Estimate::with(['scheduler', 'crew'])->select('estimate_id','customer_id','customer_name','customer_phone','customer_address','billing_address','customer_last_name','project_name','project_number','project_type','building_type','project_owner');

            if ($id) {
                $query->where('added_user_id', $id)
                      ->orWhereJsonContains('estimate_schedule_assigned_to', $id);
            }

            if ($branch) {
                $query->whereHas('customer', function($q) use ($branch) {
                    $q->where('branch', $branch);
                });
            }

            $estimates = $query->get();
        } else {
            $query = Estimate::with(['scheduler', 'crew']);

            if ($branch) {
                $query->whereHas('customer', function($q) use ($branch) {
                    $q->where('branch', $branch);
                });
            }

            $estimates = $query->get();
        }

        if ($id != null) {
            $userToDos = UserToDo::with('assigned_to')->Where('to_do_assigned_to', $id)->get();
            $estimateToDos = EstimateToDos::with('assigned_by')->where('to_do_assigned_to', $id)->get();
        } else {
            $userToDos = UserToDo::with('assigned_to')->get();
            $estimateToDos = EstimateToDos::with('assigned_by')->get();
        }

        foreach ($estimates as $estimate) {
            // Decode the JSON safely
            $userIds = json_decode($estimate->estimate_schedule_assigned_to, true);

            // Ensure $userIds is an array; if null, set to an empty array
            if (!is_array($userIds) || empty($userIds)) {
                $userIds = []; // Avoid error in whereIn()
            }

            // Fetch users matching those IDs
            $schedulers = User::whereIn('id', $userIds)->get();

            // Attach users to the estimate dynamically
            $estimate->schedulers = $schedulers;
        }

        $allEmployees = User::where('sts', 'active')->get();
        return response()->json([
            'success'=> true,
            'data'=> ['filterId' => $id, 'estimates' => $estimates, 'allEmployees' => $allEmployees, 'userToDos' => $userToDos, 'estimateToDos' => $estimateToDos, 'branches' => $branches]
        ]);
        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'error'=> $e->getMessage()
            ]);
        }
    }

        public function getEstimateToSetSchedule($id)
    {
        try{
            $userDetails = auth()->user();
            $filterId = null;
            $branch = request()->query('branch');
            $branches = CompanyBranches::get();

            $eventEstimate = Estimate::with(['scheduler', 'crew'])->where('estimate_id', $id)->first();
            $customer = Customer::where('customer_id', $eventEstimate->customer_id)->first();

            $query = Estimate::with(['scheduler', 'crew']);

            if ($branch) {
                $query->whereHas('customer', function($q) use ($branch) {
                    $q->where('branch', $branch);
                });
            }

            $estimates = $query->get();
            $users = User::where('user_role', 'scheduler')->where('sts', 'active')->get();
            $allEmployees = User::where('sts', 'active')->get();

            $userToDos = UserToDo::with('assigned_to')->get();
            $estimateToDos = EstimateToDos::with('assigned_by')->get();

            foreach ($estimates as $estimate) {
                // Decode the JSON safely
                $userIds = json_decode($estimate->estimate_schedule_assigned_to, true);

                // Ensure $userIds is an array; if null, set to an empty array
                if (!is_array($userIds) || empty($userIds)) {
                    $userIds = []; // Avoid error in whereIn()
                }

                // Fetch users matching those IDs
                $schedulers = User::whereIn('id', $userIds)->get();

                // Attach users to the estimate dynamically
                $estimate->schedulers = $schedulers;
            }

            return response()->json([
                'success'=> true,
                'user_details' => $userDetails,
                // 'data'=> [
                // 'filterId' => $filterId,
                // 'estimates' => $estimates,
                // 'estimate' => $eventEstimate,
                // 'customer' => $customer,
                // 'user_details' => $userDetails,
                // 'employees' => $users,
                // 'allEmployees' => $allEmployees,
                // 'userToDos' => $userToDos,
                // 'estimateToDos' => $estimateToDos,
                // 'branches' => $branches]
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'error'=> $e->getMessage()
            ], 400);
        }
    }

     public function addUserToDo(Request $request)
    {
        try {
            $userDetails = auth()->user();
            if ($request->input('estimate_schedule_id') != null) {
                $toDoId = $request->input('estimate_schedule_id');
                $validatedData = $request->validate([
                    'start_date' => 'nullable',
                    'end_date' => 'nullable',
                    'assign_work' => 'nullable',
                    'task_name' => 'required',
                    'note' => 'nullable',
                    'address' => 'nullable',
                ]);
                $toDo = UserToDo::where('to_do_id', $toDoId)->first();
                $toDo->start_date = $validatedData['start_date'];
                $toDo->end_date = $validatedData['end_date'];
                $toDo->to_do_assigned_to = $validatedData['assign_work'];
                $toDo->to_do_title = $validatedData['task_name'];
                $toDo->note = $validatedData['note'];
                $toDo->to_do_address = $validatedData['address'];
                $toDo->save();
                return response()->json(['success' => true, 'message' => 'To Do updated!'], 200);
            } else {
                $validatedData = $request->validate([
                    'to_do_title' => 'required',
                    'assign_work' => 'nullable|array',
                    'start_date' => 'nullable',
                    'end_date' => 'nullable',
                    'note' => 'nullable',
                    'address' => 'nullable',
                ]);

                foreach ($validatedData['assign_work'] as $userId) {
                    UserToDo::create([
                        'added_user_id' => $userDetails['id'],
                        'to_do_title' => $validatedData['to_do_title'],
                        'start_date' => $validatedData['start_date'],
                        'end_date' => $validatedData['end_date'],
                        'note' => $validatedData['note'],
                        'to_do_assigned_to' => $userId,
                        'to_do_address' => $validatedData['address'],
                    ]);
                }

                return response()->json(['success' => true, 'message' => 'To Do added!'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     public function deleteUserToDo($id)
    {
        try {

            $toDo = UserToDo::where('to_do_id', $id)->first();

            $toDo->delete();

            return response()->json(['success' => true, 'message' => 'To Do deleeted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }


    public function completeUserToDo($id)
    {
        try {

            $toDo = UserToDo::where('to_do_id', $id)->first();

            $toDo->to_do_status = 'completed';

            $toDo->save();

            return response()->json(['success' => true, 'message' => 'To Do Completed!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
     public function resetPassword($id)
    {
        try{
            $user = User::where('id', $id)->first();
            return response()->json([
                'success'=> true,
                'data'=> ['userDetail' => $user]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success'=>false,
                'error'=> $e->getMessage()
            ]);
        }
    }

        public function forgotPasswordMail(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'email' => 'required',
            ]);

            $user = User::where('email', $validatedData['email'])->where('sts', 'active')->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found!'], 404);
            }

            $emailData = [
                'email' => $validatedData['email'],
                'userId' => $user->id,
                'name' => $user->name . ' ' . $user->last_name,
            ];

            $mail = new ForgotPasswordMail($emailData);
            Mail::to($validatedData['email'])->send($mail);

            return response()->json(['success' => true, 'message' => 'An email sent to your address. Please check your email.'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

   public function setScheduleEstimate(Request $request)
{
    try {
        if ($request->input('estimate_schedule_id') != null) {
            $validatedData = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'assign_work' => 'required|array',
                'note' => 'nullable|string',
            ]);

            $estimateSchedule = EstimateSchedule::where('estimate_schedule_id', $request->input('estimate_schedule_id'))->first();

            if (!$estimateSchedule) {
                return response()->json(['success' => false, 'message' => 'Estimate Schedule not found.'], 404);
            }

            $estimate = Estimate::where('estimate_id', $estimateSchedule->estimate_id)->first();

            if (!$estimate) {
                return response()->json(['success' => false, 'message' => 'Estimate not found.'], 404);
            }

            $estimateSchedule->start_date = $validatedData['start_date'];
            $estimateSchedule->end_date = $validatedData['end_date'];
            $estimateSchedule->estimate_complete_assigned_to = json_encode($validatedData['assign_work']);
            $estimateSchedule->note = $validatedData['note'] ?? '';

            $estimate->scheduled_start_date = $validatedData['start_date'];
            $estimate->scheduled_end_date = $validatedData['end_date'];
            $estimate->estimate_schedule_assigned_to = json_encode($validatedData['assign_work']);

            $estimateSchedule->save();
            $estimate->save();

            return response()->json([
                'success' => true,
                'message' => 'Estimate Schedule Updated!',
                'estimate_id' => $estimate->estimate_id
            ], 200);

        } else {
            $userDetails = auth()->user();

            if (!$userDetails) {
                return response()->json(['success' => false, 'message' => 'Unauthorized.'], 401);
            }

            $validatedData = $request->validate([
                'estimate_id' => 'required|integer',
                'assign_estimate_completion' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'note' => 'nullable|string'
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            if (!$estimate) {
                return response()->json(['success' => false, 'message' => 'Estimate not found.'], 404);
            }

            $estimateSchedule = EstimateSchedule::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'estimate_complete_assigned_to' => json_encode($validatedData['assign_estimate_completion']),
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'note' => $validatedData['note'] ?? '',
            ]);

            $estimate->estimate_schedule_assigned = 1;
            $estimate->estimate_schedule_assigned_to = json_encode($validatedData['assign_estimate_completion']);
            $estimate->scheduled_start_date = $validatedData['start_date'];
            $estimate->scheduled_end_date = $validatedData['end_date'];
            $estimate->save();

            return response()->json([
                'success' => true,
                'message' => 'Estimate is Scheduled!',
                'estimate_id' => $estimate->estimate_id
            ], 200);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred: ' . $e->getMessage()
        ], 400);
    }
}

 public function deleteScheduleEstimate($id)
    {
        try {

            $estimateSchedule = EstimateSchedule::where('estimate_schedule_id', $id)->first();

            if (!$estimateSchedule) {
                return response()->json(['success' => false, 'message' => 'Estimate Schedule not found!'], 404);
            }

            $estimate = Estimate::where('estimate_id', $estimateSchedule->estimate_id)->first();

            $estimate->estimate_schedule_assigned = 0;
            $estimate->estimate_schedule_assigned_to = null;
            $estimate->scheduled_start_date = null;
            $estimate->scheduled_end_date = null;

            $estimate->save();
            $estimateSchedule->delete();

            return response()->json(['success' => true, 'message' => 'Estimate Schedule Deleted!'], 200);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
        // Complete Estimate
    public function completeEstimate(Request $request)
    {
        try {
            $userDetails = auth()->user();


            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'estimator_id' => 'required|numeric',
                'assign_estimate' => 'required|numeric',
                'start_date' => 'required',
                'end_date' => 'required',
                'note' => 'nullable|string',
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->estimated_completed_by = $validatedData['estimator_id'];
            $estimate->estimate_assigned_to = $validatedData['assign_estimate'];
            $estimate->estimate_assigned = 1;

            $estimate->save();

            $completeEstimate = CompleteEstimate::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'estimate_completed_by' => $validatedData['estimator_id'],
                'estimate_assigned_to_accept' => $validatedData['assign_estimate'],
                'acceptence_start_date' => $validatedData['start_date'],
                'acceptence_end_date' => $validatedData['end_date'],
                'note' => $validatedData['note'],
            ]);

            return response()->json(['success' => true, 'message' => 'Estimated Completed Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
        // Reassign Complete Estimate
    public function reassignCompleteEstimate(Request $request)
    {
        try {
            $userDetails = auth()->user();


            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'estimator_id' => 'required|numeric',
                'assign_estimate' => 'required|numeric',
                'start_date' => 'required',
                'end_date' => 'required',
                'note' => 'nullable|string',
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->estimated_completed_by = $validatedData['estimator_id'];
            $estimate->estimate_assigned_to = $validatedData['assign_estimate'];
            $estimate->estimate_assigned = 1;

            $estimate->save();

            $completedEstimate = CompleteEstimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $completedEstimate->estimate_completed_by = $validatedData['estimator_id'];
            $completedEstimate->estimate_assigned_to_accept = $validatedData['assign_estimate'];
            $completedEstimate->acceptence_start_date = $validatedData['start_date'];
            $completedEstimate->acceptence_end_date = $validatedData['end_date'];
            $completedEstimate->note = $validatedData['note'];

            $completedEstimate->save();

            return response()->json(['success' => true, 'message' => 'Estimate Reassigned Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
      // Schedule estimate
    public function scheduleEstimate(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'schedule_work' => 'required|string',
                'start_date' => 'required',
                'end_date' => 'required',
                'note' => 'nullable',
            ]);

            $schedluleEstimate = ScheduleWork::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'schedule_assign_id' => $validatedData['schedule_work'],
                'schedule_start_date' => $validatedData['start_date'],
                'schedule_end_date' => $validatedData['end_date'],
                'note' => $validatedData['note'],
                'schedule_assigned' => 1,
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->schedule_assigned = 1;
            $estimate->schedule_assigned_to = $validatedData['schedule_work'];

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Work is assigned for schedule!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' =>  false, 'message' => $e->getMessage()], 400);
        }
    }
    //setScheduleWork
     public function setScheduleWork(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'assign_work' => 'required|string',
                'note' => 'nullable',
            ]);

            $schedule = ScheduleEstimate::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'work_assigned' => 1,
                'work_assign_id' => $validatedData['assign_work'],
                'note' => $validatedData['note'],
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->scheduled_start_date = $validatedData['start_date'];
            $estimate->scheduled_end_date = $validatedData['end_date'];
            $estimate->work_assigned  = 1;
            $estimate->work_assigned_to = $validatedData['assign_work'];

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'The work is scheduled!', 'estimate_id' => $estimate->estimate_id], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
        // update schedule
    public function updateScheuleWork(Request $request)
    {
        try {

            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'startDate' => 'nullable',
                'fendDate' => 'nullable',
                'assign_work' => 'nullable',
                'note' => 'nullable',
            ]);

            $schedule = ScheduleEstimate::where('estimate_id', $validatedData['estimate_id'])->first();
            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            if (isset($validatedData['startDate']) != null) {
                $schedule->start_date = $validatedData['startDate'];
            }
            if (isset($validatedData['fendDate']) != null) {
                $schedule->end_date = $validatedData['fendDate'];
            }

            if (isset($validatedData['assign_work']) != null) {
                $schedule->work_assign_id = $validatedData['assign_work'];
                $estimate->work_assigned_to = $validatedData['assign_work'];
            }

            if (isset($validatedData['note']) != null) {
                $schedule->note = $validatedData['note'];
            }

            $estimate->save();
            $schedule->save();

            return response()->json(['success' => true, 'message' => 'Work date updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     // Complete work  and assign invoice
    public function completeWorkAndAssignInvoice(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'work_completed_by' => 'required',
                'complete_work_date' => 'required',
                'assign_invoice' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            $work = CompleteEstimateInvoiceWork::create([
                'added_user_id' => $userDetails->id,
                'estimate_id' => $validatedData['estimate_id'],
                'invoice_assigned_to' => $validatedData['assign_invoice'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->work_completed_by = $userDetails->id;
            $estimate->work_completed = 1;
            $estimate->complete_work_date = $validatedData['complete_work_date'];
            $estimate->invoice_assigned = 1;
            $estimate->invoice_assigned_to = $validatedData['assign_invoice'];

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Invoice work has Assigned!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // viewGallery
     public function uploadImage(Request $request)
    {
        try {
            $userDetails = Auth()->user();

            // Validate the form data
            $request->validate([
                'estimate_id' => 'required',
                'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            ]);

            $estimateId = $request->input('estimate_id');
            $image = $request->file('file');

            // $path = $image->store('estimate_images', 'public');
            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
            'folder' => 'estimate_image',
                'transformation' => [
                'width' => 800,
                'height' => 600,
                'crop' => 'limit', // Keeps aspect ratio, limits to size
                'quality' => 'auto', // Auto compress
                'fetch_format' => 'auto' // Converts to WebP or JPEG
            ]
        ]);
         $imageUrl = $uploadedImage->getSecurePath();

            // Create a new record in the database for each file
            $estimateImage = new EstimateImages([
                'added_user_id' =>  $userDetails->id,
                'estimate_id' => $estimateId,
                'estimate_image' => $imageUrl,
            ]);

            $estimateImage->save();

            $this->addEstimateActivity($userDetails, $estimateId, 'Image Uploaded', "New Images has been uploaded in Photos Section");

            // Redirect or respond accordingly
            return response()->json(['success' => true, 'message' => 'Images uploaded successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()],  400);
        }
    }

     public function deleteEstimateImage($id)
    {
        try {
            $estimateImage = EstimateImages::where('estimate_image_id', $id)->first();
            // Check if the image exists
            if ($estimateImage) {
                // Delete the image file from the file system
                $imagePath = public_path($estimateImage->estimate_image); // Adjust this based on your file storage configuration
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Delete the record from the database
                $estimateImage->delete();

                // Optionally, you may also delete the image from the estimate_images folder
                // Assuming that the estimate_images folder is located in the public directory
                $imageFileName = basename($estimateImage->estimate_image);
                $estimateImagesFolder = public_path('estimate_images');

                $imageFilePath = $estimateImagesFolder . '/' . $imageFileName;
                if (file_exists($imageFilePath)) {
                    unlink($imageFilePath);
                }
                return response()->json(['success' => true, 'message' => 'Image deleted successfully!'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Image not found!'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()], 400);
        }
    }

    public function getCustomerDetails(Request $request)
    {
        try {
            $user = $request->user();

            $email = $request->input('email');
            $phone = $request->input('phone');

            if (!$email && !$phone) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please provide at least an email or phone to search.'
                ], 422);
            }

            $query = Customer::query();

            if ($email) {
                $query->where('customer_email', $email);
            }

            if ($phone) {
                $query->where('customer_phone', $phone);
            }

            // Eager load estimates count
            $customer = $query->withCount('estimates')->first();

            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found'
                ], 404);
            }

            // Select only specific fields to return
            $response = [
                'customer_first_name' => $customer->customer_first_name,
                'customer_last_name'  => $customer->customer_last_name,
                'branch'              => $customer->branch,
                'customer_email'      => $customer->customer_email,
                'customer_phone'      => $customer->customer_phone,
                'estimate_count'      => $customer->estimates_count,
            ];

            return response()->json([
                'success' => true,
                'data' => $response
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

     // get Crew estimate on jobs
    public function getEstimateOnJobs()
    {
        try{
            $userDetails = auth()->user();

            $scheduleEstimatesWithEstimates = [];

            $scheduleEstimates = ScheduleEstimate::where('work_assign_id', $userDetails->id)->get();

            foreach ($scheduleEstimates as $scheduleEstimate) {
                $estimate = Estimate::where('estimate_id', $scheduleEstimate->estimate_id)
                ->select('estimate_id','customer_id','customer_name','customer_phone','customer_address','billing_address','customer_last_name','project_name','project_number','project_type','building_type','project_owner')
                ->first();

                if ($estimate) {
                    // Associate ScheduleEstimate with Estimate
                    $scheduleEstimatesWithEstimates[] = [
                        'schedule_estimate' => $scheduleEstimate,
                        'estimate' => $estimate,
                    ];
                }
            }

        // return view('jobs', ['schedule_estimates_with_estimates' => $scheduleEstimatesWithEstimates]);
            return response()->json([
                'success' => true,
                'data' => $scheduleEstimatesWithEstimates], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success'=> false,
                'error'=> $e->getMessage()
            ], 400);
        }
    }

    public function getChatMessage($id){
        try{

        $userDetails = auth()->user();
        $estimate = Estimate::where('estimate_id', $id)
        ->select('estimate_id','customer_id','customer_name','customer_phone','customer_address','billing_address','customer_last_name','project_name','project_number','project_type','building_type','project_owner')
        ->first();
        $customer = Estimate::where('customer_id', $estimate->customer_id)->first();
        $chatMessages = EstimateChat::with('addedUser')->where('estimate_id', $id)->orderBy('estimate_chat_id', 'asc')->get();
        $users = User::where('id', '<>', $userDetails->id)->where('sts', 'active')->get();

            return response()->json([
                'success'=> true,
                'data'=> [
                    'chatMessages' => $chatMessages,
                'estimate' => $estimate,
                // 'customer' => $customer,
                // 'users' => $users
                ]
                ]);
        } catch(\Exception $e){
            return response()->json([
                'success'=>false,
                'error'=> $e->getMessage()
            ]);
        }
    }

    public function viewEstimateMaterials($id){
        try{
            $userDetails = auth()->user();
        $estimate = Estimate::where('estimate_id', $id)
        ->select('estimate_id','customer_id','customer_name','customer_phone','customer_address','billing_address','customer_last_name','project_name','project_number','project_type','building_type','project_owner')->first();
        $materialItems = EstimateItem::where('estimate_id', $id)
            ->where('item_type', '<>', 'upgrades')
            ->where('additional_item', '<>', 'yes')
            ->get()
            ->sortBy(function ($item) {
                return $item->sort_order == 0 ? PHP_INT_MAX : $item->sort_order;
            });
        $estimateAssemblyItems = EstimateItem::with('assemblies')->where('estimate_id', $estimate->estimate_id)->where('item_type', 'assemblies')->where('additional_item', '<>', 'yes')->get();
        $upgrades = EstimateItem::with('assemblies')->where('estimate_id', $id)->where('item_type', 'upgrades')->where('upgrade_status', 'accepted')->where('additional_item', '<>', 'yes')->get();
        $itemTemplates = EstimateItemTemplates::with('templateItems')->where('estimate_id', $id)->get();
        $customer = Customer::where('customer_id', $estimate->customer_id)
        ->select('customer_id','added_user_id','customer_first_name','customer_last_name','customer_email','customer_phone','customer_city','customer_state','customer_zip_code','billing_address','billing_city','billing_state','billing_zip')->first();
        $estimateAdditionalItems = EstimateItem::with('group', 'assemblies')->where('estimate_id', $estimate->estimate_id)->where('additional_item', 'yes')->get();
        // return view('viewEstimateMaterials', ['estimate_items' => $materialItems, 'estimateAdditionalItems' => $estimateAdditionalItems, 'assemblies' => $estimateAssemblyItems, 'upgrades' => $upgrades, 'templates' => $itemTemplates, 'customer' => $customer, 'estimate' => $estimate]);

            return response()->json([
                'success'=> true,
                'data'=>[
                    'estimate_items' => $materialItems,
                    'estimateAdditionalItems' => $estimateAdditionalItems,
                    'assemblies' => $estimateAssemblyItems,
                    'upgrades' => $upgrades,
                    'templates' => $itemTemplates,
                    'customer' => $customer,
                    'estimate' => $estimate
                    ]
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success'=> false,
                'error'=> $e->getMessage()
            ]);
        }
    }

    // CrewCalendar
   public function getEstimatesOnCrewCalendar()
    {
        try{
            $userDetails = auth()->user();
            $branch = request()->query('branch');
            $branches = CompanyBranches::get();

            if($userDetails['user_role'] == 'crew'){
                $crew = User::where('id', $userDetails['id'])->where('user_role', 'crew')->get();
            }else{
                $crew = User::where('user_role', 'crew')->get();
            }
            $query = ScheduleEstimate::with(['estimate', 'estimate.customer']);

            if ($branch) {
                $query->whereHas('estimate.customer', function($q) use ($branch) {
                    $q->where('branch', $branch);
                });
            }

            if(isset($userDetails['user_role']) && $userDetails['user_role'] === 'crew'){
                $query->whereHas('estimate', function ($q)  use ($userDetails){
                    $q->where('work_assign_id', $userDetails['id']);
                });
            }

            $estimates = $query->get();

            // Enhance each estimate with the user who added it and their color
            foreach ($estimates as $estimate) {
                if ($estimate->estimate) {
                    // Get the user who added the estimate
                    $addedUserId = $estimate->estimate->added_user_id;
                    $addedUser = User::find($addedUserId);

                    if ($addedUser) {
                        // Set as attributes on the object instead of properties
                        $estimate->setAttribute('user_color', $addedUser->user_color);
                        $estimate->setAttribute('added_user_name', $addedUser->name . ' ' . $addedUser->last_name);
                    }
                }
            }

            $employees = User::where('user_role', 'crew')->where('sts', 'active')->get();

            return response()->json([
                'success'=>true,
                'data'=>[
                    // 'estimates' => $estimates,
                    'crew' => $crew,
                    'employees' => $employees,
                    // 'branches' => $branches
                ],
            ],200);
            // return view('crewCalendar', [
            //     'estimates' => $estimates,
            //     'crew' => $crew,
            //     'employees' => $employees,
            //     'branches' => $branches
            // ]);
        } catch(\Exception $e){
            response()->json(['success'=>false, 'error'=> $e->getMessage()], 400);
        }
    }


      // get user on setting
    public function getUserOnSettings()
    {
        try{
            $userDetails = auth()->user();

            $user = User::select('id', 'name', 'email', 'phone', 'address', 'user_image', 'password', 'user_role',)->find($userDetails->id);

            $company = null;
            if($user && $user->user_role === 'admin'){
                $company = Company::first();
            }
            // $company = Company::first();
            return response()->json([
                'success'=> true,
                'data'=> [
                    'user_details' => $user,
                    'company' => $company
                ]
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success'=>false,
                'error'=> $e->getMessage()
            ]);
        }
    }

    public function updateSettings(Request $request)
    {
        try {
            $userDetails = auth()->user();

            $validatedData = $request->validate([
                'user_id' => 'required',
                'name' => 'nullable',
                'phone' => 'nullable',
                'address' => 'nullable',
                'old_password' => 'nullable',
                'confirm_password' => 'nullable',
                'upload_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
                'sidebar' => 'nullable',
            ]);

            $user = User::where('id', $validatedData['user_id'])->first();

            session()->put('user_details.sidebar', $request->sidebar);
            $user->name = $validatedData['name'];
            $user->phone = $validatedData['phone'];
            $user->address = $validatedData['address'];
            $user->sidebar = $validatedData['sidebar'];

            if (isset($validatedData['old_password'])) {
                if (md5($validatedData['old_password']) == $user->password) {
                    $user->password = md5($validatedData['confirm_password']);
                }
            }

            if ($request->hasFile('upload_image')) {
                $image = $request->file('upload_image');

                $CloudinaryUrl = Cloudinary::upload($image->getRealPath())->getSecurePath();
                // $imageName = time() . '.' . $image->getClientOriginalExtension();
                // $image->storeAs('public/user_images', $imageName); // Adjust storage path as needed
                // $user->user_image = 'storage/user_images/' . $imageName;


                $user->user_image = $CloudinaryUrl;
                session()->put('user_details.user_image', $user->user_image);
            }

            $user->save();

            return response()->json(['success' => true, 'message' => 'Profile Updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

     // update estimate item
    public function updateEstimateItem(Request $request)
    {
        try {
            // dd($request);
            $userDetails = Auth()->user();
            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'item_id' => 'required',
                'item_name' => 'required',
                'item_units' => 'nullable',
                'labour_expense' => 'nullable',
                'material_expense' => 'nullable',
                'item_cost' => 'required',
                'item_price' => 'required',
                'item_qty' => 'required',
                'item_total' => 'required',
                'item_description' => 'nullable',
                'item_note' => 'nullable',
                'assembly_id' => 'nullable|array',
                'assembly_name' => 'nullable|array',
                'ass_item_id' => 'nullable|array',
                'group_name' => 'nullable',
                'assembly_unit_by_item_unit' => 'nullable|array',
                'item_unit_by_assembly_unit' => 'nullable|array',
                // 'selected_items' => 'required|array',
                'additional_item' => 'nullable',
            ]);

            $estimateItem = EstimateItem::where('estimate_item_id', $validatedData['item_id'])->first();
            $estimateItemAssembly = EstimateItemAssembly::where('estimate_item_id', $estimateItem->estimate_item_id)->get();
            if (isset($validatedData['group_name']) && $validatedData['group_name'] != null) {
                $groupDetail = Groups::where('group_name', $validatedData['group_name'])->first();
                if (!$groupDetail) {
                    $newGroup = Groups::create([
                        'group_name' => $validatedData['group_name'],
                        'group_type' => 'assemblies',
                        'show_unit_price' => 1,
                        'show_quantity' => 1,
                        'show_total' => 1,
                        'show_group_total' => 1,
                        'include_est_total' => 1,
                    ]);
                    $estimateItem->group_id = $newGroup->group_id;
                } else {
                    $estimateItem->group_id = $groupDetail->group_id;
                }
            } else {
                $groupDetail = Groups::where('group_name', 'Single')->first();
                if (!$groupDetail) {
                    $groupDetail = Groups::create([
                        'group_name' => 'Single',
                        'group_type' => 'assemblies',
                        'show_unit_price' => 1,
                        'show_quantity' => 1,
                        'show_total' => 1,
                        'show_group_total' => 1,
                        'include_est_total' => 1,
                    ]);
                }
                $estimateItem->group_id = $groupDetail->group_id;
            }

            $estimateItem->item_name = $validatedData['item_name'];
            $estimateItem->item_unit = $validatedData['item_units'];
            $estimateItem->labour_expense = $validatedData['labour_expense'];
            $estimateItem->material_expense = $validatedData['material_expense'];
            $estimateItem->item_cost = $validatedData['item_cost'];
            $estimateItem->item_price = $validatedData['item_price'];
            $estimateItem->item_qty = $validatedData['item_qty'];
            $estimateItem->item_total = $validatedData['item_total'];
            $estimateItem->item_description = $validatedData['item_description'];
            $estimateItem->item_note = $validatedData['item_note'];

            $estimateItem->save();

            $estItemAssembly = EstimateItemAssembly::where('estimate_item_id', $validatedData['item_id'])->get();

            foreach ($estItemAssembly as $assembly) {
                $assembly->delete();
            }

            // Update or insert EstimateItemAssembly data
            if (isset($validatedData['assembly_name'])) {

                foreach ($validatedData['assembly_name'] as $key => $assemblyName) {
                    if ($assemblyName != null) {
                        $itemUnitByAssUnitSum = $validatedData['item_unit_by_assembly_unit'][$key];
                        $assUnitByItemUnitSum = $validatedData['assembly_unit_by_item_unit'][$key];
                        $assItems = Items::where('item_id', $validatedData['ass_item_id'][$key])->first();
                        $assItemQty = $validatedData['item_qty'] * $assUnitByItemUnitSum;
                        $assItemPrice = $assItems->item_price * $assItemQty;

                        $assemblyData = [
                            'added_user_id' => $userDetails->id,
                            'estimate_id' => $validatedData['estimate_id'],
                            'estimate_item_id' => $validatedData['item_id'],
                            'est_ass_item_name' => $validatedData['assembly_name'][$key],
                            'item_unit_by_ass_unit' => $itemUnitByAssUnitSum,
                            'ass_unit_by_item_unit' => $assUnitByItemUnitSum,
                            'item_id' => $assItems->item_id,
                            'ass_item_cost' => $assItems->item_cost,
                            'ass_item_price' => $assItems->item_price,
                            'ass_item_qty' => $assItemQty,
                            'ass_item_total' => $assItemPrice,
                            'ass_item_unit' => $assItems->item_units,
                            'ass_item_description' => $assItems->item_description,
                            'ass_item_type' => $assItems->item_type,
                            'ass_labour_expense' => $assItems->labour_expense,
                            'ass_material_expense' => $assItems->material_expense,
                        ];
                        EstimateItemAssembly::create($assemblyData);
                    }
                    // Insert new record
                }
            }
            if ($validatedData['additional_item'] == 'no') {
                $pendingProposal = EstimateProposal::where('estimate_id', $validatedData['estimate_id'])->where('proposal_status', 'pending')->first();

                if ($pendingProposal) {
                    $pendingProposal->proposal_status = 'canceled';

                    $pendingProposal->save();
                }
            }
            return response()->json(['success' => true, 'message' => 'Item updated successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
     // edit group
    public function editGroup(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'group_id' => 'required',
                'group_name' => 'required|string',
                // 'total_items' => 'required|numeric',
                'group_type' => 'required|string',
                // 'group_item_ids' => 'required|array',
                'group_description' => 'nullable|string',
                'show_unit_price' => 'nullable',
                'show_quantity' => 'nullable',
                'show_total' => 'nullable',
                'show_unit_price' => 'nullable|boolean', // Validate as boolean
                'show_quantity' => 'nullable|boolean', // Validate as boolean
                'show_total' => 'nullable|boolean', // Validate as boolean
                'show_group_total' => 'nullable',
                'include_est_total' => 'nullable',
            ]);

            $group = Groups::where('group_id', $validatedData['group_id'])->first();

            $group->group_name = $validatedData['group_name'];
            $group->group_type = $validatedData['group_type'];
            $group->group_description = $validatedData['group_description'];
            // Set the values of checkboxes to 1 if checked, otherwise set to 0
            $group->show_unit_price = $request->has('show_unit_price') ? 1 : 0;
            $group->show_quantity = $request->has('show_quantity') ? 1 : 0;
            $group->show_total = $request->has('show_total') ? 1 : 0;
            $group->show_group_total = $request->has('show_group_total') ? 1 : 0;
            $group->include_est_total = $request->has('include_est_total') ? 1 : 0;

            $group->save();

            return response()->json(['success' => true, 'message' => 'Group Updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

        public function deleteEstimateGroupItems(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'group_id' => 'required',
            ]);

            $estimateItems = EstimateItem::where('estimate_id', $validatedData['estimate_id'])
                ->where('group_id', $validatedData['group_id'])
                ->get();

            foreach ($estimateItems as $item) {
                $item->delete();
            }

            return response()->json(['success' => true, 'message' => 'Items deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getBranches(){
        try {
            $userDetails = auth()->user();
            // $branches = CompanyBranches::select('branch_id', 'branch_name', 'branch_address', 'branch_city', 'branch_state', 'branch_zip_code')->get();
            $branches = CompanyBranches::all();
            return response()->json([
                'success' => true,
                'data' => $branches
            ], 200);

        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // OwerList Api
    public function getUsersList(Request $request, $key = null){
        // $userDetails = auth()->user();
        $query = User::select('id', 'name', 'email', 'phone', 'address', 'user_image', 'departement', 'user_role');
            if ($key) {
                $query->where('user_role', $key);
            }
            $owner = $query->get();

        // $owner = User::find($key);

        // $addedUser = User::whereIn('added_user_id', $owner->pluck('id'))
        //     ->select('id', 'name', 'email', 'phone', 'address', 'user_image', 'departement', 'user_role')
        //     ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'owner' => $owner,
                    // 'added_user' => $addedUser
                ]
            ], 200);

    }
    // Log Out
    public function logout(Request $request)
    {
        try{
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'success'=> true,
                'data'=> 'Logout Successful.'
            ], 200);
        } catch(\Exception $e){
            return response()->json([
                'success'=> false,
                'error'=> $e->getMessage()
            ], 400);
        }
    }
}
