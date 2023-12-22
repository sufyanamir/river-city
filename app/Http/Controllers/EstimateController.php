<?php

namespace App\Http\Controllers;

use App\Mail\ProposalMail;
use App\Mail\sendMailToClient;
use App\Models\AssignPayment;
use App\Models\CompleteEstimate;
use App\Models\CompleteEstimateInvoiceWork;
use App\Models\Customer;
use App\Models\Email;
use App\Models\Estimate;
use App\Models\EstimateContact;
use App\Models\EstimateEmail;
use App\Models\EstimateImage;
use App\Models\EstimateItem;
use App\Models\EstimateNote;
use App\Models\EstimatePayments;
use App\Models\EstimateProposal;
use App\Models\EstimateToDos;
use App\Models\Items;
use App\Models\ScheduleEstimate;
use App\Models\ScheduleWork;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class EstimateController extends Controller
{

    public function getEstimatesOnCalendar()
    {
        $estimates = Estimate::get();

        return view('calendar', ['estimates' => $estimates]);
    }

    public function index()
    {
        $userDetails = session('user_details');

        $estimates = Estimate::get();

        return view('estimates', ['estimates' => $estimates, 'user_details' => $userDetails]);
    }
    // ==============================================================Estimate additional functions=========================================================
    // add to do
    public function addToDos(Request  $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'task_name' =>  'required',
                'assign_work' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'note' => 'nullable',
            ]);

            $toDo = EstimateToDos::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'to_do_title' => $validatedData['task_name'],
                'to_do_assigned_to' => $validatedData['assign_work'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'note' => $validatedData['note'],
            ]);

            return response()->json(['success' => true, 'message' => 'To Do Added!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add to do
    
    // complete project
    public function completeProject(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->estimate_status = 'complete';

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'The project has been completed'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // complete project

    // add payment
    public function addPayment(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'invoice_id' => 'required',
                'invoice_date' => 'required',
                'invoice_amount' => 'nullable',
                'note' => 'nullable',

            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->invoice_paid = 1;
            $estimate->invoice_paid_total = $validatedData['invoice_amount'];
            $estimate->estimate_status = 'paid';

            $estimate->save();

            $estimateCompleteInvoices = AssignPayment::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimateCompleteInvoices->invoice_status = 'paid';

            $estimateCompleteInvoices->save();
            
            $estimatePayment = EstimatePayments::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'estimate_complete_invoice_id' => $validatedData['invoice_id'],
                'complete_invoice_date' => $validatedData['invoice_date'],
                'invoice_total'  => $validatedData['invoice_amount'],
                'note' => $validatedData['note'],
            ]);


            return response()->json(['success' => true, 'message' => 'Payment has been completed!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add payment
    
    // complete invoice and assign payment
    public function completeInvoiceAndAssignPayment(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'complete_invoice_date' => 'required',
                'assign_payment' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'note' => 'nullable',
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();
            $estimate->payment_assigned = 1;
            $estimate->payment_assigned_to = $validatedData['assign_payment'];
            $estimate->invoiced_payment = $estimate->estimate_total;

            $assignPayment = AssignPayment::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'payment_assigned_to' => $validatedData['assign_payment'],
                'start_date' =>   $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'note' => $validatedData['note'],
                'complete_invoice_date' => $validatedData['complete_invoice_date'],
                'invoice_name' => 'final invoice',
                'tax_rate' => $estimate->tax_rate,
                'invoice_total' => $estimate->estimate_total,
                'invoice_due' => $estimate->estimate_total,
            ]);

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Invoice Completed and Payment assigned!'], 200);

        } catch (\Exception $e) {
            return  response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // complete invoice and assign payment
    
    // Complete work  and assign invoice
    public function completeWorkAndAssignInvoice(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'work_completed_by' => 'required',
                'complete_work_date' => 'required',
                'assign_invoice' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);

            $work = CompleteEstimateInvoiceWork::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'invoice_assigned_to' => $validatedData['assign_invoice'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->work_completed_by = $userDetails['id'];
            $estimate->invoice_assigned = $validatedData['complete_work_date'];
            $estimate->invoice_assigned = 1;
            $estimate->invoice_assigned_to = $validatedData['assign_invoice'];

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Invoice work has Assigned!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // Complete work  and assign invoice

    // set schedule
    public function setSchedule(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'assign_work' => 'required|string',
                'note' => 'nullable',
            ]);

            $schedule = ScheduleEstimate::create([
                'added_user_id' => $userDetails['id'],
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

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'The work is scheduled!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // set schedule

    // Schedule estimate
    public function scheduleEstimate(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'schedule_work' => 'required|string',
                'start_date' => 'required',
                'end_date' => 'required',
                'note' => 'nullable',
            ]);

            $schedluleEstimate = ScheduleWork::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'schedule_assign_id' => $validatedData['schedule_work'],
                'schedule_start_date' => $validatedData['start_date'],
                'schedule_end_date' => $validatedData['end_date'],
                'note' => $validatedData['note'],
                'schedule_assigned' => 1,
            ]);

            return response()->json(['success' => true, 'message' => 'Work is assigned for schedule!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' =>  false, 'message' => $e->getMessage()], 400);
        }
    }
    // Schedule estimate

    // Complete Estimate
    public function completeEstimate(Request $request)
    {
        try {
            $userDetails = session('user_details');


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
                'added_user_id' => $userDetails['id'],
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
    // Complete Estimate

    // accept proposal
    public function acceptProposal($id)
    {
        try {
            $estimate = Estimate::find($id);
            $proposal = EstimateProposal::where('estimate_id', $id)->first();

            $proposal->proposal_status = 'accepted';
            $proposal->proposal_accepted = $proposal->proposal_total;
            $estimate->estimate_total = $proposal->proposal_total;

            $estimate->save();
            $proposal->save();

            return response()->json(['success' => true, 'message' => 'You accepted the proposal. Thank You!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // accept proposal

    // view proposal
    public function viewProposal($id)
    {
        try {

            $estimate = Estimate::where('estimate_id', $id)->first();
            $customer = Customer::where('customer_id', $estimate->customer_id)->first();
            $items = EstimateItem::where('estimate_id', $estimate->estimate_id)->get();

            // return response()->json(['success' => true, 'data' => ['user_details' => $userDetails, 'estimate' => $estimate, 'customer' => $customer, 'items' => $items]], 200);
            return view('accept-proposal', [
                'estimate' => $estimate,
                'customer' => $customer,
                'items' => $items,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // view proposal

    // send proposal
    public function sendProposal(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'customer_email' => 'required|string',
                'estimate_total' => 'required|numeric',
            ]);

            $emailData = [
                'estimate_id' => $validatedData['estimate_id'],
                'email' => $validatedData['customer_email'],
            ];

            $mail = new ProposalMail($emailData);
            Mail::to($validatedData['customer_email'])->send($mail);

            $proposal = EstimateProposal::create([
                'estimate_id' => $validatedData['estimate_id'],
                'proposal_total' => $validatedData['estimate_total'],
            ]);

            return response()->json(['success' => true, 'message' => 'Proposal Sent Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // send proposal

    // make proposal
    public function makeProposal($id)
    {
        try {
            $userDetails = session('user_details');

            $estimate = Estimate::where('estimate_id', $id)->first();
            $customer = Customer::where('customer_id', $estimate->customer_id)->first();
            $items = EstimateItem::where('estimate_id', $estimate->estimate_id)->get();

            // return response()->json(['success' => true, 'data' => ['user_details' => $userDetails, 'estimate' => $estimate, 'customer' => $customer, 'items' => $items]], 200);
            return view('make-proposal', [
                'user_details' => $userDetails,
                'estimate' => $estimate,
                'customer' => $customer,
                'items' => $items,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // make proposal

    // estimate emails
    public function getEmailDetails($id)
    {
        $email = Email::find($id);

        return response()->json(['success' => true, 'email_detail' => $email], 200);
    }

    public function sendEmail(Request $request)
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

            $emailData = [
                'estimate_id' => $validatedData['estimate_id'],
                'email_id' => $validatedData['email_id'],
                'email_name' => $validatedData['email_name'],
                'email_to' => $validatedData['email_to'],
                'email_subject' => $validatedData['email_subject'],
                'email_body' => $validatedData['email_body'],
            ];

            // Create an instance of the Mailable class
            $mail = new sendMailToClient($emailData);

            // Send the email using the Mail facade
            Mail::to($validatedData['email_to'])
                ->send($mail);

            // Assuming you want to save the email data in the database
            $mail = EstimateEmail::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'email_id' => $validatedData['email_id'],
                'email_name' => $validatedData['email_name'],
                'email_to' => $validatedData['email_to'],
                'email_subject' => $validatedData['email_subject'],
                'email_body' => $validatedData['email_body'],
            ]);

            return response()->json(['success' => true, 'message' => 'Email sent to the client!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // estimate emails

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

    // get images
    // public function getEstimateWithImages()
    // {
    //     $userDetails = session('user_details');

    //     $estimates = Estimate::get();
    //     $customers = Customer::get();

    //     $estimateData = [];

    //     foreach ($estimates as $estimate) {
    //         $images = EstimateImage::where('estimate_id', $estimate->estimate_id)->get();
    //         $estimateData[] = [
    //             'estimate' => $estimate,
    //             'images' => $images,
    //         ];
    //     }

    //     return view('feedGallery', ['customers' => $customers, 'estimates_with_images' => $estimateData, 'user_details' => $userDetails]);

    //     // return response()->json(['customers' => $customers, 'estimates_with_images' => $estimateData, 'user_details' => $userDetails], 200);
    // }
    // get images

    // delete additional  images
    // public function deleteAdditionalImage($id)
    // {
    //     try {
    //         $additionalImage = EstimateImage::find($id);

    //         if (!$additionalImage) {
    //             return response()->json(['success' => false, 'message' => 'No image found!'],  404);
    //         }

    //         if (Storage::exists($additionalImage->estimate_image)) {
    //             Storage::delete($additionalImage->estimate_image);
    //         }

    //         $additionalImage->delete();

    //         return response()->json(['success' => true, 'message' => 'Image deleted!'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
    //     }
    // }
    // delete additional  images

    // add image

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
            $users = User::where('added_user_id', $userDetails['id'])->get();
            $estimateNotes = EstimateNote::where('estimate_id', $estimate->estimate_id)->get();
            $emailTemplates = Email::get();
            $estimateEmails = EstimateEmail::where('estimate_id', $estimate->estimate_id)->get();
            $proposals = EstimateProposal::where('estimate_id', $estimate->estimate_id)->get();
            $estimator = User::where('id', $estimate->estimated_completed_by)->first();
            $schedule = ScheduleWork::where('estimate_id', $estimate->estimate_id)->first();
            $work = ScheduleEstimate::where('estimate_id', $estimate->estimate_id)->first();
            $invoices = AssignPayment::where('estimate_id', $estimate->estimate_id)->first();
            $payments = EstimatePayments::where('estimate_id', $estimate->estimate_id)->first();
            $toDos = EstimateToDos::where('estimate_id', $estimate->estimate_id)->get();

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
                'estimate_emails' => $estimateEmails,
                'proposals' => $proposals,
                'estimator' => $estimator,
                'schedule' => $schedule,
                'work' => $work,
                'invoices' => $invoices,
                'payments' => $payments,
                'toDos' => $toDos,
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
                'customer_last_name' => $validatedData['last_name'],
                'tax_rate' => $validatedData['tax_rate'],
                'project_name' => $validatedData['project_name'],
                'project_number' => $validatedData['project_number'],
            ]);

            return response()->json(['success' => true, 'message' => 'Estimate created Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add  estimate

    // ==============================================================Estimates functions==================================================================
}
