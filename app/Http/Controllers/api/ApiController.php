<?php

namespace App\Http\Controllers\api;

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

            return response()->json(['success' => true, 'message' => 'login successfull', 'token' => $token], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false,'message' => $e->getMessage()], 400);
        }
    }


    public function addUserToDo(Request $request)
    {
        try {
            $apiUser = $request->user();

            $validatedData = $request->validate([
                'to_do_title' => 'required',
                'start_date' => 'nullable',
                'end_date' => 'nullable',
                'note' => 'nullable',
                'address' => 'nullable',
            ]);

                UserToDo::create([
                    'added_user_id' => $apiUser->id,
                    'to_do_title' => $validatedData['to_do_title'],
                    'start_date' => $validatedData['start_date'],
                    'end_date' => $validatedData['end_date'],
                    'note' => $validatedData['note'],
                    'to_do_assigned_to' => $apiUser->id,
                    'to_do_address' => $validatedData['address'],
                ]);

            return response()->json(['success' => true, 'message' => 'To Do added!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function addCustomerAndEstimate(Request $request)
    {
        try {
            $apiUser = $request->user(); // Authenticated 3rd-party user
            $po_number = mt_rand(10000000, 99999999);

            // Basic estimate validation (always required)
            $validatedData = $request->validate([
                'customer_id'    => 'nullable|exists:customers,customer_id',
                'email'          => 'nullable|email',
                'phone'          => 'nullable|string',
                'project_name'   => 'nullable|string',
                'project_number' => 'nullable|string',
                'tax_rate'       => 'nullable|numeric',
                'internal_note'  => 'nullable|string',
                'project_type'   => 'nullable|string',
                'building_type'  => 'nullable|string',
                'branch'         => 'required|string',
            ]);

            // Step 1: Find existing customer
            $customer = null;

            if (!empty($validatedData['customer_id'])) {
                $customer = Customer::find($validatedData['customer_id']);
            } elseif (!empty($validatedData['email']) || !empty($validatedData['phone'])) {
                $customer = Customer::where(function ($query) use ($validatedData) {
                    if (!empty($validatedData['email'])) {
                        $query->orWhere('customer_email', $validatedData['email']);
                    }
                    if (!empty($validatedData['phone'])) {
                        $query->orWhere('customer_phone', $validatedData['phone']);
                    }
                })->first();
            }

            // Step 2: If customer not found, validate and create a new one
            if (!$customer) {
                $extraValidation = $request->validate([
                    'first_name'     => 'required|string',
                    'last_name'      => 'nullable|string',
                    'email'          => 'nullable|email',
                    'phone'          => 'required|string',
                    'company_name'   => 'nullable|string',
                    'first_address'  => 'required|string',
                    'second_address' => 'nullable|string',
                    'city'           => 'required|string',
                    'state'          => 'required|string',
                    'zip_code'       => 'required|numeric',
                    'source'         => 'nullable|string',
                    'potential_value' => 'nullable|string',
                ]);

                $customer = Customer::create([
                    'added_user_id'             => $apiUser->id,
                    'customer_first_name'       => $extraValidation['first_name'],
                    'customer_last_name'        => $extraValidation['last_name'] ?? null,
                    'customer_email'            => $extraValidation['email'] ?? null,
                    'customer_phone'            => $extraValidation['phone'],
                    'customer_company_name'     => $extraValidation['company_name'] ?? null,
                    'customer_primary_address'  => $extraValidation['first_address'],
                    'customer_secondary_address' => $extraValidation['second_address'] ?? null,
                    'customer_city'             => $extraValidation['city'],
                    'customer_state'            => $extraValidation['state'],
                    'customer_zip_code'         => $extraValidation['zip_code'],
                    'source'                    => $extraValidation['source'] ?? null,
                    'potential_value'           => $extraValidation['potential_value'] ?? null,
                    'branch'                    => $validatedData['branch'],
                    'tax_rate'                  => $validatedData['tax_rate'] ?? 0,
                ]);

                $isNewCustomer = true;
            } else {
                $isNewCustomer = false;
            }

            // Step 3: Create Estimate
            $estimate = Estimate::create([
                'customer_id'          => $customer->customer_id,
                'added_user_id'        => $apiUser->id,
                'customer_name'        => $customer->customer_first_name,
                'customer_last_name'   => $customer->customer_last_name,
                'customer_phone'       => $customer->customer_phone,
                'customer_address'     => $customer->customer_primary_address,
                'tax_rate'             => $validatedData['tax_rate'] ?? $customer->tax_rate ?? 0,
                'project_name'         => $validatedData['project_name'] ?? null,
                'project_number'       => $validatedData['project_number'] ?? null,
                'project_type'         => $validatedData['project_type'] ?? null,
                'building_type'        => $validatedData['building_type'] ?? null,
                'project_owner'        => $apiUser->name . ' ' . $apiUser->last_name,
                'po_number'            => $po_number,
                'estimate_internal_note' => $validatedData['internal_note'] ?? null,
            ]);

            // Step 4: Send notification
            $notificationMessage = $isNewCustomer
                ? "A new Customer '{$customer->customer_first_name} {$customer->customer_last_name}' was added and an Estimate was created."
                : "A new Estimate has been created for '{$customer->customer_first_name} {$customer->customer_last_name}'.";

            Notifications::create([
                'added_user_id' => $apiUser->id,
                'notification_message' => $notificationMessage,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Estimate created successfully!',
                'estimate_id' => $estimate->estimate_id,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
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
}
