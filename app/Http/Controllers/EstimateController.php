<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use Illuminate\Http\Request;

class EstimateController extends Controller
{

    public function viewEstimate($id)
    {
        $userDetails = session('user_details');
        $customer = Customer::where('customer_id', $id)->first();
        $customerId = $customer->customer_id;
        $estimate = Estimate::where('customer_id', $customerId)->first();

        return view('viewEstimates', ['customer' => $customer, 'estimate' => $estimate, 'user_details' => $userDetails]);
    }

    public function index()
    {
        $userDetails = session('user_details');

        $estimates = Estimate::get();

        return view('estimates', ['estimates' => $estimates, 'user_details' => $userDetails]);
    }

    public function addCustomerAndEstimate(Request $request)
    {
        try {

            $userDetails = session('user_details');

            // dd($userDetails);

            $validatedData = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'nullable|string',
                'email' => 'required|string',
                'phone' => 'required|numeric',
                'company_name' => 'nullable|string',
                'project_name' => 'nullable|string',
                'project_number' => 'nullable|numeric',
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

            ]);

            $customer = Customer::create([
                'added_user_id' => $userDetails['id'],
                'customer_first_name' => $validatedData['first_name'],
                'customer_last_name' => $validatedData['last_name'],
                'customer_email' => $validatedData['email'],
                'customer_phone' => $validatedData['phone'],
                'customer_company_name' => $validatedData['company_name'],
                'customer_project_name' => $validatedData['project_name'],
                'customer_project_number' => $validatedData['project_number'],
                'customer_primary_address' => $validatedData['first_address'],
                'customer_secondary_address' => $validatedData['second_address'],
                'customer_city' => $validatedData['city'],
                'customer_state' => $validatedData['state'],
                'customer_zip_code' => $validatedData['zip_code'],
                'tax_rate' => $validatedData['tax_rate'],
                'potential_value' => $validatedData['potential_value'],
                'company_internal_note' => $validatedData['internal_note'],
                'source' => $validatedData['source'],
                'owner' => $validatedData['owner'],
            ]);

            $estimate = Estimate::create([
                'customer_id' => $customer->customer_id,
                'customer_name' => $validatedData['first_name'],
                'customer_phone' => $validatedData['phone'],
                'customer_address' => $validatedData['first_address'],
            ]);

            return response()->json(['success' => true, 'message' => 'Estimate created Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
