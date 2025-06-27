<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyBranches;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getCustomerDetails($id)
    {
        try {
            $customer = Customer::where('customer_id', $id)->first();
            $branches = CompanyBranches::get();

            if (!$customer) {
                return response()->json(['success' => false, 'message' => 'Customer not found!'], 200);
            }

            $users = User::where('user_role', '<>', 'crew')->where('sts', 'active')->get();

            $estimates = Estimate::with('customer')->where('customer_id', $id)->orderBy('estimate_id', 'desc')->get();
            $estimateFiles = [];
            $estimateNotes = [];
            $estimateEmails = [];
            $estimateContacts = [];

            foreach ($estimates as $estimate) {
                $estimateFiles = array_merge($estimateFiles, $estimate->estimateFiles->toArray());
                $estimateNotes = array_merge($estimateNotes, $estimate->estimateNotes->toArray());
                $estimateEmails = array_merge($estimateEmails, $estimate->estimateEmails->toArray());
                $estimateContacts = array_merge($estimateContacts, $estimate->estimateContacts->toArray());
            }

            return view('viewCustomerDetails', [
                'customer' => $customer,
                'estimates' => $estimates,
                'estimateFiles' => $estimateFiles,
                'estimateNotes' => $estimateNotes,
                'estimateEmails' => $estimateEmails,
                'estimateContacts' => $estimateContacts,
                'users' => $users,
                'branches' => $branches
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function index()
    {
        $userDetails = session('user_details');

        $customers = Customer::with('addedBy')->where('customer_status', '<>', 'deleted')->get();
        $branches = CompanyBranches::get();
        $users = User::where('user_role', '<>', 'crew')->get();

        return view('customers', ['customers' => $customers, 'users' => $users, 'user_details' => $userDetails, 'branches' => $branches]);
    }

    public function getCustomerToEdit($id)
    {
        try {

            $customer = Customer::where('customer_id', $id)->first();

            if (!$customer) {
                return response()->json(['success' => false, 'message' => 'Customer not found!'], 200);
            }

            return response()->json(['success' => true, 'customer' => $customer], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function updateCustomer(Request $request)
    {
        try {
            $userDetails = session('user_details');

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
                $customer->customer_primary_address =  $validatedData['first_address'];
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


   public function deleteCustomer($id){
    try{
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
            'success' => false,
            'message' => "Customer not found or already deleted."
        ], 404);
    } catch (\Exception $e) {

        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

}
