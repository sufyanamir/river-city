<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Email;
use App\Models\Estimate;
use App\Models\EstimateContact;
use App\Models\EstimateImage;
use App\Models\EstimateItem;
use App\Models\EstimateNote;
use App\Models\Items;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class EstimateController extends Controller
{

    public function getEmailDetails($id)
    {
        $email = Email::find($id);

        return response()->json(['success' => true, 'email_detail' => $email], 200);
    }

    public function sendEmail(Request$request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'email_id' => 'required|integer',
                'email_name' => 'required|string',
                'email_to' => 'required|string',
                'email_subject' => 'nullable|string',
                'email_body' => 'required|string',
            ]);

            

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function index()
    {
        $userDetails = session('user_details');

        $estimates = Estimate::get();

        return view('estimates', ['estimates' => $estimates, 'user_details' => $userDetails]);
    }
    // ==============================================================Estimate additional functions=========================================================

    // estimate items
    public function addEstimateNote(Request $request)
    {
        try {
            
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'estimate_note' => 'required|string',
            ]);

            $estimateNote = EstimateNote::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'estimate_note' => $validatedData['estimate_note'],
            ]);

            return response()->json(['success' => true, 'message' => 'Note added!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // estimate items

    // estimate items
    public function estimateItems(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'selected_items' => 'required|array',
                'selected_item_names' => 'nullable|array', // Use plural for consistency
                'selected_item_types' => 'nullable|array',
                'selected_item_units' => 'nullable|array',
                'selected_item_costs' => 'nullable|array',
                'selected_item_prices' => 'required|array',
            ]);

            $itemsData = [];
            foreach ($validatedData['selected_items'] as $index => $itemId) {
                $itemsData[] = [
                    'item_id' => $itemId,
                    'item_name' => $validatedData['selected_item_names'][$index],
                    'item_type' => $validatedData['selected_item_types'][$index],
                    'item_unit' => $validatedData['selected_item_units'][$index],
                    'item_cost' => $validatedData['selected_item_costs'][$index],
                    'item_price' => $validatedData['selected_item_prices'][$index],
                ];
            }

            foreach ($itemsData as $item) {
                EstimateItem::create([
                    'added_user_id' => $userDetails['id'],
                    'estimate_id' => $validatedData['estimate_id'],
                    'item_id' => $item['item_id'],
                    'item_name' => $item['item_name'],
                    'item_type' => $item['item_type'],
                    'item_unit' => $item['item_unit'],
                    'item_cost' => $item['item_cost'],
                    'item_price' => $item['item_price'],
                    // Add other fields as needed
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Items added to estimate'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // estimate items

    // delete additional  images
    public function deleteAdditionalImage($id)
    {
        try {
            $additionalImage = EstimateImage::find($id);

            if (!$additionalImage) {
                return response()->json(['success' => false, 'message' => 'No image found!'],  404);
            }

            if (Storage::exists($additionalImage->estimate_image)) {
                Storage::delete($additionalImage->estimate_image);
            }

            $additionalImage->delete();

            return response()->json(['success' => true, 'message' => 'Image deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // delete additional  images

    // add image
    public function additionalImage(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'estimate_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);

            $additionalImage = EstimateImage::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
            ]);

            if ($request->hasFile('estimate_image')) {
                $image = $request->file('estimate_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/estimate_images', $imageName); // Adjust storage path as needed
                $additionalImage->estimate_image = 'storage/estimate_images/' . $imageName;
            }

            $additionalImage->save();

            return response()->json(['success' => true, 'message' => 'image added!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add image

    // delete contact
    public function deleteAdditionalContact($id)
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
    // delete contact

    // add contact
    public function additionalContacts(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'contact_title' => 'required|string',
                'first_name' => 'required|string',
                'last_name' => 'nullable|string',
                'email' => 'required|string',
                'phone' => 'required|numeric',
                'estimate_id' => 'required',
            ]);

            $additionalContact = EstimateContact::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'contact_title' => $validatedData['contact_title'],
                'contact_first_name' => $validatedData['first_name'],
                'contact_last_name' => $validatedData['last_name'],
                'contact_email' => $validatedData['email'],
                'contact_phone' => $validatedData['phone'],
            ]);

            return  response()->json(['success' => true, 'message' => 'Addtitional contact added'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add contact

    // ==============================================================Estimates additional functions==================================================================

    // ==============================================================Estimates functions==================================================================

    // view estimate
    public function viewEstimate($id)
    {
        try {
            $userDetails = session('user_details');
            $customer = Customer::where('customer_id', $id)->first();

            if (!$customer) {
                // Handle the case where the customer is not found
                // You may want to return a response or redirect to an error page
                return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
            }

            $customerId = $customer->customer_id;
            $estimate = Estimate::where('customer_id', $customerId)->first();

            if (!$estimate) {
                // Handle the case where the estimate is not found
                // You may want to return a response or redirect to an error page
                return response()->json(['success' => false, 'message' => 'Estimate not found'], 404);
            }

            $additionalContacts = EstimateContact::where('estimate_id', $estimate->estimate_id)->get();
            $estimateItems = EstimateItem::where('estimate_id', $estimate->estimate_id)->get();
            $items = Items::get();
            $users = User::get();
            $estimateNotes = EstimateNote::where('estimate_id', $estimate->estimate_id)->get();
            $emailTemplates = Email::get();

            // Calculate the sum of item_price for the estimate
            $totalPrice = $estimateItems->sum('item_price');

            return view('viewEstimates', [
                'customer' => $customer,
                'estimate' => $estimate,
                'items' => $items,
                'estimate_items' => $estimateItems,
                'additional_contacts' => $additionalContacts,
                'user_details' => $userDetails,
                'item_total' => $totalPrice, // Pass the total price to the view
                'employees' => $users,
                'estimate_notes' => $estimateNotes,
                'email_templates' => $emailTemplates,
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // view estimate

    // add  estimate
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
    // add  estimate

    // ==============================================================Estimates functions==================================================================
}
