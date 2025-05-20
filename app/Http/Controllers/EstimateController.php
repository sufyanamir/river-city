<?php

namespace App\Http\Controllers;

use App\Mail\ProposalAcceptedMail;
use App\Mail\ProposalMail;
use App\Mail\sendMailToClient;
use App\Mail\SendPaymentReceiptMail;
use App\Models\AdvancePayment;
use App\Models\AssignPayment;
use App\Models\Company;
use App\Models\CompanyBranches;
use App\Models\CompleteEstimate;
use App\Models\CompleteEstimateInvoiceWork;
use App\Models\Customer;
use App\Models\Email;
use App\Models\Estimate;
use App\Models\EstimateActivity;
use App\Models\EstimateContact;
use App\Models\EstimateEmail;
use App\Models\EstimateExpenses;
use App\Models\EstimateFile;
use App\Models\EstimateImage;
use App\Models\EstimateImages;
use App\Models\EstimateItem;
use App\Models\EstimateItemAssembly;
use App\Models\EstimateItemTemplateItems;
use App\Models\EstimateItemTemplates;
use App\Models\EstimateNote;
use App\Models\EstimatePayments;
use App\Models\EstimateProposal;
use App\Models\EstimateSchedule;
use App\Models\EstimateToDos;
use App\Models\Groups;
use App\Models\ItemAssembly;
use App\Models\Items;
use App\Models\ItemTemplateItems;
use App\Models\ItemTemplates;
use App\Models\Notifications;
use App\Models\ScheduleEstimate;
use App\Models\ScheduleWork;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\UserToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Symfony\Contracts\Service\Attribute\Required;

use function PHPSTORM_META\map;

class EstimateController extends Controller
{

    // estimate activity
    private function addEstimateActivity($userDetails, $estimateId, $activityTitle, $activityDescription)
    {
        EstimateActivity::create([
            'added_user_id' => $userDetails['id'],
            'estimate_id' => $estimateId,
            'activity_title' => $activityTitle,
            'activity_description' => $activityDescription,
        ]);
    }
    // estimate activity

    // send invoice or payment mail to client
    public function sendInvoiceOrPaymentMail(Request $request)
    {
        try {
            $userDetails = session('user_details');
            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'email_title' => 'required',
                'email_body' => 'required',
                'email_subject' => 'required',
                'email_to' => 'required',
            ]);
            $emailTo = explode(',', $validatedData['email_to']);

            $estimate = Estimate::with('customer')->where('estimate_id', $request->estimate_id)->first();

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

            return response()->json(['success' => true, 'message' => 'Email sent successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // send invoice or payment mail to client

    // viewPayment
    public function viewPayment($id)
    {
        try {
            $userDetails = session('user_details');
            $estimate = Estimate::with('customer')->where('estimate_id', $id)->first();
            $payment = EstimatePayments::where('estimate_payment_id', $id)->first();
            // dd($payment);

            return view('viewInvoice', ['user_details' => $userDetails, 'payment' => $payment, 'estimate' => $estimate, 'type' => 'Payment']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // viewPayment

    // viewInvoice
    public function viewInvoice($id)
    {
        try {
            $userDetails = session('user_details');
            $estimate = Estimate::with('customer')->where('estimate_id', $id)->first();
            $invoice = AssignPayment::where('estimate_complete_invoice_id', $id)->first();
            // dd($invoice);

            return view('viewInvoice', ['user_details' => $userDetails, 'invoice' => $invoice, 'estimate' => $estimate, 'type' => 'Invoice']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // viewInvoice

    // save rearrange items
    public function saveRearrangeItems(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'estimate_id' => 'required|exists:estimates,estimate_id',
                'items' => 'required|array',
                'items.*.id' => 'required|exists:estimate_items,estimate_item_id',
                'items.*.position' => 'required|integer',
            ]);

            // Loop through the sorted items and update their positions
            foreach ($validatedData['items'] as $item) {
                EstimateItem::where('estimate_id', $validatedData['estimate_id'])->where('estimate_item_id', $item['id'])
                    ->update(['sort_order' => $item['position']]);
            }

            return response()->json(['success' => true, 'message' => 'Items reordered successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // save rearrange items

    // rearrange items
    public function rearrangeItems($id)
    {
        try {
            $estimate = Estimate::where('estimate_id', $id)->first();

            $estimateItems = EstimateItem::with('group')
                ->where('estimate_id', $id)
                ->get()
                ->sortBy(function ($item) {
                    return [
                        // $item->group->group_name, // Sort by group name first
                        $item->sort_order == 0 ? PHP_INT_MAX : $item->sort_order // Sort order (0 goes last)
                    ];
                });

            return view('partials.rearrange-items', [
                'estimate' => $estimate,
                'estimateItems' => $estimateItems
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // rearrange items

    // get Estimates
    public function getCustomerEstimateProposals($id)
    {
        try {
            $estimate = Estimate::with('customer')->where('estimate_id', $id)->first();
            $estimateProposals = EstimateProposal::where('estimate_id', $id)->get();
            $estimateInvoices = AssignPayment::where('estimate_id', $id)->get();
            $estimatePayments = EstimatePayments::with('invoice')->where('estimate_id', $id)->get();

            return view('customer-portal', ['estimate' => $estimate, 'proposals' => $estimateProposals, 'invoices' => $estimateInvoices, 'payments' => $estimatePayments]);
            // return response()->json(['success' => true, 'data' => ['estimate' => $estimate, 'proposals' => $estimateProposals]], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get Estimates

    // deleteEstimateGroupItems
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
    // deleteEstimateGroupItems

    // acceptRejectEstimateItems
    public function acceptRejectEstimateItems(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'group_id' => 'required',
                'type' => 'required',
                'item_status' => 'required',
                'proposal_id' => 'required',
            ]);

            $proposal = EstimateProposal::where('estimate_proposal_id', $validatedData['proposal_id'])->first();

            if (!$proposal) {
                return response()->json(['success' => false, 'message' => 'Proposal not found'], 404);
            }

            $proposalData = json_decode($proposal->proposal_data, true);

            if (isset($proposalData['estimate_items'])) {
                foreach ($proposalData['estimate_items'] as &$item) { // Use reference (&) to modify the array
                    if ($item['estimate_id'] == $validatedData['estimate_id'] && $item['group_id'] == $validatedData['group_id']) {

                        // Update upgrade_status in array
                        $item['upgrade_status'] = $validatedData['item_status'];

                        // Update upgrade_status in database
                        $dbItem = EstimateItem::find($item['estimate_item_id']);
                        if ($dbItem) {
                            $dbItem->upgrade_status = $validatedData['item_status'];
                            $dbItem->save();
                        }
                    }
                }
                // dd($proposalData);
                // Save the updated array back to the proposal
                $proposal->proposal_data = json_encode($proposalData);
                $proposal->save();
            }

            if ($validatedData['type'] === 'acceptAll' || $validatedData['type'] === 'rejectAll') {
                $group = Groups::where('group_id', $validatedData['group_id'])->first();
                if ($group) {
                    $group->include_est_total = $validatedData['type'] === 'acceptAll' ? 1 : 0;
                    $group->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Items status updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // acceptRejectEstimateItems

    // update estimate detail
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
    // update estimate detail

    // get estimate detail
    public function getEstimateDetail($id)
    {
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
    // get estimate detail

    // apply discount on estimates
    public function applyDiscount(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'percentage' => 'nullable',
                'price' => 'nullable',
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->percentage_discount = $validatedData['percentage'];
            $estimate->price_discount = $validatedData['price'];

            if ($validatedData['percentage'] != null)
                $estimate->discounted_total = $estimate->estimate_total - ($estimate->estimate_total * ($validatedData['percentage'] / 100));
            else {
                $estimate->discounted_total = $estimate->estimate_total - $validatedData['price'];
            }

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Discount applied on total'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // apply discount on estimates

    // get invoice details on estimates
    public function getInvoiceDetails($id)
    {
        $userDetails = session('user_details');

        $estimate = Estimate::with('invoices')->where('estimate_id', $id)->first();

        return response()->json(['success' => true, 'estimateDetails' => $estimate], 200);
    }
    // get invoice details on estimates

    // send invoice to QB

    public function sendInvoiceToQB(Request $request)
    {

        try {

            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'total_amount' => 'nullable',
                'customer_first_name' => 'nullable',
                'customer_last_name' => 'nullable',
                'customer_email' => 'required',
            ]);

            $estimateSending = Http::post('https://hooks.zapier.com/hooks/catch/7921384/3ethsdd/', [
                'amount' => $validatedData['total_amount'],
                'first_name' => $validatedData['customer_first_name'],
                'last_name' => $validatedData['customer_last_name'],
                'customer_email' => $validatedData['customer_email'],
            ]);

            return response()->json(['success' => true, 'message' => 'Invoice sent to QB!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // update item status
    public function includeexcludeEstimateItem(Request $request)
    {
        try {

            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'estimate_item_id' => 'nullable',
                'item_status' => 'required',
                'group_id' => 'nullable',
            ]);

            if (isset($validatedData['group_id']) && $validatedData['group_id'] != null) {

                $estimateItems = EstimateItem::where('group_id', $validatedData['group_id'])->get();

                foreach ($estimateItems as $item) {
                    $item->item_status = $validatedData['item_status'];
                    $item->save();
                }
            } else {
                $estimateItem = EstimateItem::where('estimate_item_id', $validatedData['estimate_item_id'])->first();
                $estimateItem->item_status = $validatedData['item_status'];

                $estimateItem->save();
            }


            return response()->json(['success' => true, 'message' => 'Item status changed to ' . $validatedData['item_status']], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // update item status

    // view Estimate Materials
    public function viewEstimateMaterials($id)
    {

        $userDetails = session('user_details');
        $estimate = Estimate::where('estimate_id', $id)->first();
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
        $customer = Customer::where('customer_id', $estimate->customer_id)->first();
        $estimateAdditionalItems = EstimateItem::with('group', 'assemblies')->where('estimate_id', $estimate->estimate_id)->where('additional_item', 'yes')->get();
        return view('viewEstimateMaterials', ['estimate_items' => $materialItems, 'estimateAdditionalItems' => $estimateAdditionalItems, 'assemblies' => $estimateAssemblyItems, 'upgrades' => $upgrades, 'templates' => $itemTemplates, 'customer' => $customer, 'estimate' => $estimate]);
    }
    // view Estimate Materials

    // delete estimate item
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

    // delete estimate item

    // ==============================================================private functions=========================================================

    public function getEstimateActivity($id)
    {
        $userDetails = session('user_details');
        $activities = EstimateActivity::with('user')->where('estimate_id', $id)->orderBy('estimate_activity_id', 'desc')->get();

        return view('estimate_activity', ['user_details' => $userDetails, 'activities' => $activities]);
    }
    // estimate activity

    // ==============================================================private functions=========================================================

    // ==============================================================item template functions=========================================================
    // get ItemTemplates and Items
    public function updateEstimateTemplateItem(Request $request)
    {
        // dd($request);
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'item_id' => 'required',
                'item_qty' => 'nullable',
                'item_total' => 'nullable',
                'labour_expense' => 'nullable',
                'material_expense' => 'nullable',
                'item_cost' => 'nullable',
                'item_price' => 'nullable',
                'item_description' => 'nullable',
                'item_note' => 'nullable',
            ]);

            $templateItem = EstimateItemTemplateItems::where('est_template_item_id', $validatedData['item_id'])->first();

            $templateItem->item_qty = $validatedData['item_qty'];
            $templateItem->item_total = $validatedData['item_total'];
            $templateItem->labour_expense = $validatedData['labour_expense'];
            $templateItem->material_expense = $validatedData['material_expense'];
            $templateItem->item_cost = $validatedData['item_cost'];
            $templateItem->item_price = $validatedData['item_price'];
            $templateItem->item_description = $validatedData['item_description'];
            $templateItem->item_note = $validatedData['item_note'];

            $templateItem->save();

            return response()->json(['success' => true, 'message' => 'Item updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get ItemTemplates and Items

    // get ItemTemplates and Items
    public function getEstimateTemplateItem($id)
    {
        try {

            $userDetails = session('user_details');

            $templateItem = EstimateItemTemplateItems::where('est_template_item_id', $id)->first();
            $item = Items::where('item_id', $templateItem->item_id)->first();

            return response(['success' => true, 'data' => ['template_item' => $templateItem, 'item_detail' => $item]], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get ItemTemplates and Items

    // get ItemTemplates and Items
    public function updateEstimateItemTemplate(Request $request)
    {
        // dd($request);
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'est_template_id' => 'required',
                'est_template_item_id' => 'required|array',
                'template_item_qty' => 'nullable|array',
                'estimate_template_description' => 'nullable',
                'estimate_template_note' => 'nullable',
            ]);

            $itemTemplate = EstimateItemTemplates::where('est_template_id', $validatedData['est_template_id'])->first();
            $itemTemplate->description = $validatedData['estimate_template_description'];
            $itemTemplate->note = $validatedData['estimate_template_note'];

            foreach ($validatedData['est_template_item_id'] as $key => $tempItemId) {
                $templateItem = EstimateItemTemplateItems::where('est_template_item_id', $tempItemId)->first();

                if ($templateItem) {
                    // Retrieve the related item
                    $relatedItem = Items::find($templateItem->item_id);

                    if ($relatedItem) {
                        // Update template item properties based on related item information
                        $templateItem->item_qty = $validatedData['template_item_qty'][$key];
                        // $templateItem->item_price = $relatedItem->item_price;

                        // Calculate item_total by multiplying item_qty with item_price
                        $templateItem->item_total = $templateItem->item_qty * $relatedItem->item_price;

                        // Save the changes to the template item
                        $templateItem->save();
                    }
                }
            }

            $itemTemplate->save();

            return response()->json(['success' => true, 'message' => 'Item updated successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get ItemTemplates and Items

    // get ItemTemplates and Items
    public function getEstItemTemplateToEdit($id)
    {
        try {

            $userDetails = session('user_details');
            $estItemTemplate = EstimateItemTemplates::where('est_template_id', $id)->first();
            $estItemTemplateItems = EstimateItemTemplateItems::where('est_template_id', $id)->get();

            $itemIds = $estItemTemplateItems->pluck('item_id')->toArray();

            $itemsData = Items::whereIn('item_id', $itemIds)->get();

            $responseData = [
                'estimate_template' => $estItemTemplate,
                'estimate_item_template_items' => $estItemTemplateItems,
                'item_data' => $itemsData,
            ];

            return response()->json(['success' => true, 'data' => $responseData], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get ItemTemplates and Items

    // delete ItemTemplates and Items
    public function deleteEstimateTemplate($id)
    {
        try {

            $itemTemplate = EstimateItemTemplates::where('est_template_id', $id)->first();
            $templateItems = EstimateItemTemplateItems::where('est_template_id', $id)->get();

            $itemTemplate->delete();
            foreach ($templateItems as $item) {
                $item->delete();
            }

            return response()->json(['success' => true, 'message' => 'Template Deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' =>  $e->getMessage()], 400);
        }
    }
    // delete ItemTemplates and Items

    // add ItemTemplates and Items
    public function addEstimateItemTemplate(Request $request)
    {
        // dd($request);
        try {
            $userDetails = session('user_details');

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

            // $estTemplate = EstimateItemTemplates::create([
            //     'added_user_id' => $userDetails['id'],
            //     'estimate_id' => $validatedData['estimate_id'],
            //     'item_template_id' => $validatedData['est_template_id'],
            //     'item_template_name' => $validatedData['est_template_name'],
            //     'description' => $validatedData['estimate_template_description'],
            //     'note' => $validatedData['estimate_template_note'],
            // ]);

            if (isset($validatedData['template_item_id'])) {
                foreach ($validatedData['template_item_id'] as $key => $itemId) {
                    $itemQty = $validatedData['template_item_qty'][$key];
                    if ($itemQty != null) {

                        $item = Items::with('assemblies')->find($itemId);

                        if ($item) {
                            $itemTotal = $itemQty * $item['item_price'];
                            // Create EstimateItemTemplateItems with item details
                            // EstimateItemTemplateItems::create([
                            //     'added_user_id' => $userDetails['id'],
                            //     'estimate_id' => $validatedData['estimate_id'],
                            //     'est_template_id' => $estTemplate->est_template_id,
                            //     'item_id' => $itemId,
                            //     'item_qty' => $itemQty,
                            //     'item_total' => $itemTotal,
                            //     'labour_expense' => $item->labour_expense,
                            //     'material_expense' => $item->material_expense,
                            //     'item_cost' => $item->item_cost,
                            //     'item_price' => $item->item_price,
                            //     'item_description' => $item->item_description,
                            //     'item_note' => $item->item_note,
                            //     'item_type' => $item->item_type,
                            //     // You can add other item details here if needed
                            // ]);

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
    // add ItemTemplates and Items

    // get ItemTemplates and Items
    public function getItemTemplateItems($id)
    {
        try {
            $itemTemplate = ItemTemplates::where('item_template_id', $id)->first();

            $itemTemplateItems = ItemTemplateItems::where('item_template_id', $itemTemplate->item_template_id)->get();

            // Extracting item_ids from itemTemplateItems
            $itemIds = $itemTemplateItems->pluck('item_id')->toArray();

            // Fetching data from Items model based on item_ids
            $itemsData = Items::whereIn('item_id', $itemIds)->get();

            // Combining the data and returning the response
            $responseData = [
                'item_template' => $itemTemplate,
                'item_template_items' => $itemTemplateItems,
                'items_data' => $itemsData,
            ];

            return response()->json(['success' => true, 'data' => $responseData], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // get ItemTemplates and Items
    // ==============================================================item template functions=========================================================

    // ==============================================================Jobs Portion=========================================================
    // get estimate on jobs
    public function getEstimateOnJobs()
    {
        $userDetails = session('user_details');

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

        return view('jobs', ['schedule_estimates_with_estimates' => $scheduleEstimatesWithEstimates]);
        // return response()->json(['success' => true, 'schedule_estimates_with_estimates' => $scheduleEstimatesWithEstimates], 200);
    }
    // get estimate on jobs
    // ==============================================================Jobs Portion=========================================================

    // delete schedule estimate
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
    // delete schedule estimate

    // schedule estimate
    public function setScheduleEstimate(Request $request)
    {
        try {
            if ($request->input('estimate_schedule_id') != null) {
                $validatedData = $request->validate([
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'assign_work' => 'required|array',
                    'note' => 'nullable',
                ]);

                $estimateSchedule = EstimateSchedule::where('estimate_schedule_id', $request->input('estimate_schedule_id'))->first();
                $estimate = Estimate::where('estimate_id', $estimateSchedule->estimate_id)->first();

                $estimateSchedule->start_date = $validatedData['start_date'];
                $estimateSchedule->end_date = $validatedData['end_date'];
                $estimateSchedule->estimate_complete_assigned_to = json_encode($validatedData['assign_work']);
                $estimateSchedule->note = $validatedData['note'];
                $estimate->scheduled_end_date = $validatedData['end_date'];
                $estimate->scheduled_start_date = $validatedData['start_date'];
                $estimate->estimate_schedule_assigned_to = json_encode($validatedData['assign_work']);

                $estimateSchedule->save();
                $estimate->save();

                return response()->json(['success' => true, 'message' => 'Estimate Schedule Updated!', 'estimate_id' => $estimate->estimate_id], 200);
            } else {
                $userDetails = session('user_details');

                $validatedData = $request->validate([
                    'estimate_id' => 'required',
                    'assign_estimate_completion' => 'required|array',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'note' => 'nullable'
                ]);

                $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

                $estimateSchedule = EstimateSchedule::create([
                    'added_user_id' => $userDetails['id'],
                    'estimate_id' => $validatedData['estimate_id'],
                    'estimate_complete_assigned_to' => json_encode($validatedData['assign_estimate_completion']),
                    'start_date' => $validatedData['start_date'],
                    'end_date' => $validatedData['end_date'],
                    'note' => $validatedData['note'],
                ]);

                $estimate->estimate_schedule_assigned = 1;
                $estimate->estimate_schedule_assigned_to = json_encode($validatedData['assign_estimate_completion']);
                $estimate->scheduled_start_date = $validatedData['start_date'];
                $estimate->scheduled_end_date = $validatedData['end_date'];
                $estimate->save();
                return response()->json(['success' => true, 'message' => 'Estimate is Scheduled!', 'estimate_id' => $estimate->estimate_id], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // schedule estimate

    // get schedule estimate
    public function getEstimateToSetSchedule($id)
    {
        $userDetails = session('user_details');
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

        return view('calendar', [
            'filterId' => $filterId, 
            'estimates' => $estimates, 
            'estimate' => $eventEstimate, 
            'customer' => $customer, 
            'user_details' => $userDetails, 
            'employees' => $users, 
            'allEmployees' => $allEmployees, 
            'userToDos' => $userToDos, 
            'estimateToDos' => $estimateToDos,
            'branches' => $branches
        ]);
    }
    // get schedule estimate

    public function addItemInEstimateAndItems(Request $request)
    {
        try {

            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'item_name' => 'required|string',
                'item_type' => 'required|string',
                'item_units' => 'required|string',
                'item_cost' => 'required|numeric',
                'item_price' => 'required|numeric',
                'labour_expense' => 'nullable|numeric',
                'item_description' => 'required|string',
                'estimate_id' => 'required',
            ]);

            $item = Items::create([
                'item_name' => $validatedData['item_name'],
                'item_type' => $validatedData['item_type'],
                'item_units' => $validatedData['item_units'],
                'item_cost' => $validatedData['item_cost'],
                'item_price' => $validatedData['item_price'],
                'labour_expense' => $validatedData['labour_expense'],
                'item_description' => $validatedData['item_description'],
            ]);

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

            return response()->json(['success' => true, 'message' => 'Item successfully added into estimate and Items!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getEstimateToSetScheduleWork($id)
    {
        $userDetails = session('user_details');
        $crewSchedule = 1;
        $branch = request()->query('branch');
        $branches = CompanyBranches::get();

        $estimate = Estimate::where('estimate_id', $id)->first();
        $customer = Customer::where('customer_id', $estimate->customer_id)->first();
        
        $query = ScheduleEstimate::with(['estimate', 'assigenedUser']);
        
        if ($branch) {
            $query->whereHas('estimate.customer', function($q) use ($branch) {
                $q->where('branch', $branch);
            });
        }
        
        $estimates = $query->get();
        $users = User::where('user_role', 'crew')->where('sts', 'active')->get();
        $allEmployees = User::where('sts', 'active')->get();
        $crew = User::where('user_role', 'crew')->get();

        return view('crewCalendar', [
            'estimates' => $estimates, 
            'crew' => $crew, 
            'estimate' => $estimate, 
            'customer' => $customer, 
            'user_details' => $userDetails, 
            'employees' => $users, 
            'crewSchedule' => $crewSchedule, 
            'allEmployees' => $allEmployees,
            'branches' => $branches
        ]);
    }

    public function getEventDetailOnCalendar(Request $request)
    {
        try {
            $type = $request->query('type');
            $id = $request->query('id');

            $event = null;
            switch ($type) {
                case 'userToDo':
                    $event = UserToDo::with('assigned_to')->find($id);
                    break;
                case 'estimate':
                    $event = Estimate::with('estimateSchedule', 'customer')->find($id);
                    break;
                case 'estimateToDo':
                    $event = EstimateToDos::with('assigned_to')->find($id);
                    break;
                default:
                    return response()->json(['error' => 'Invalid event type'], 400);
            }

            if (!$event) {
                return response()->json(['error' => 'Event not found'], 404);
            }

            return response()->json($event);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function getEstimatesOnCalendar($id = null)
    {
        $userDetails = session('user_details');
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
            $query = Estimate::with(['scheduler', 'crew']);
            
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
        return view('calendar', ['filterId' => $id, 'estimates' => $estimates, 'allEmployees' => $allEmployees, 'userToDos' => $userToDos, 'estimateToDos' => $estimateToDos, 'branches' => $branches]);
    }

    public function getSchedulesOnScheduleCalendar($user = null)
    {
        if ($user != null) {
            $userDetails = User::where('id', $user)->first();
        } else {
            $userDetails = session('user_details');
        }
        
        $branch = request()->query('branch');
        $branches = CompanyBranches::get();

        $userToDosQuery = UserToDo::where('added_user_id', $userDetails['id']);
        $estimateToDosQuery = EstimateToDos::where('to_do_assigned_to', $userDetails['id']);
        
        // Apply branch filter if provided, though it might require additional JOIN with estimates table
        // This is a placeholder and may need modification based on your database structure
        if ($branch) {
            // If these models have relationships with estimates and customers, add filter
            // This is hypothetical and would need to be adjusted to match actual relationships
            // $userToDosQuery->whereHas('estimate.customer', function($q) use ($branch) {
            //     $q->where('branch', $branch);
            // });
            // $estimateToDosQuery->whereHas('estimate.customer', function($q) use ($branch) {
            //     $q->where('branch', $branch);
            // });
        }
        
        $userToDos = $userToDosQuery->get();
        $estimateToDos = $estimateToDosQuery->get();
        
        $allEmployees = User::where('sts', 'active')->get();

        return view('schedulesCalendar', [
            'userToDos' => $userToDos, 
            'estimateToDos' => $estimateToDos, 
            'allEmployees' => $allEmployees,
            'branches' => $branches
        ]);
    }

    public function viewDataOnCrewCalendar($id)
    {
        $userDetails = session('user_details');

        $estimate = Estimate::with('customer', 'crew')->where('estimate_id', $id)->first();
        $estimateSchedule = ScheduleEstimate::where('estimate_id', $id)->first();
        $user = User::where('id', $estimateSchedule->work_assign_id)->first();

        return response()->json(['success' => true, 'estimate' => $estimate, 'estimateSchedule' => $estimateSchedule, 'crew' => $user], 200);
    }

    public function getEstimatesOnCrewCalendar()
    {
        $userDetails = session('user_details');
        $branch = request()->query('branch');
        $branches = CompanyBranches::get();

        $crew = User::where('user_role', 'crew')->get();
        
        $query = ScheduleEstimate::with(['estimate', 'estimate.customer']);
        
        if ($branch) {
            $query->whereHas('estimate.customer', function($q) use ($branch) {
                $q->where('branch', $branch);
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

        return view('crewCalendar', [
            'estimates' => $estimates, 
            'crew' => $crew, 
            'employees' => $employees,
            'branches' => $branches
        ]);
    }


    public function cancelEstimate($id)
    {
        try {

            $userDetails = session('user_detalis');

            $estimate = Estimate::where('estimate_id', $id)->first();

            $estimate->estimate_status = 'cancel';

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Estimate Canceled!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function index(Request $request, $type = null)
    {
        $userDetails = session('user_details');

        $status = $request->query('status');
        $branch = $request->query('branch');

        $branches = CompanyBranches::get();

        if ($userDetails['user_role'] == 'admin') {
            $customers = Customer::get();
            $query = Estimate::with('scheduler', 'assigned_work', 'customer', 'crew')
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
                $query->where('estimate_schedule_assigned_to', $userDetails['id']);
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
        return view('estimates', ['estimates' => $estimates, 'user_details' => $userDetails, 'customers' => $customers, 'users' => $users, 'branches' => $branches]);
    }


    // ==============================================================Estimate additional functions=========================================================
    // delete files
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
    // delete files

    // add files
    public function uploadFile(Request $request)
    {
        try {
            $userDetails = session('user_details');

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
    // add files

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
    // delete estimate expenses

    // delete to do
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
    // delete to do

    // update to do
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
    // update to do

    // edit estimate expenses
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

    // edit estimate expenses
    public function updateEstimateExpense(Request $request)
    {
        try {
            $userDetails = session('user_details');

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
    // edit estimate expenses

    // estimate expenses
    public function addEstimateExpense(Request $request)
    {
        try {
            $userDetails = session('user_details');

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
                'added_user_id' =>  $userDetails['id'],
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
    // estimate expenses

    // add to do
    public function addToDos(Request  $request)
    {
        try {
            $userDetails = session('user_details');

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

    // add advance payment
    public function advancePayment(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'estimate_total_amount' => 'required',
                'advance_payment' => 'required',
                'note' => 'nullable',
            ]);

            $advancePayment = AdvancePayment::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'estimate_total' => $validatedData['estimate_total_amount'],
                'advance_payment' => $validatedData['advance_payment'],
                'note' => $validatedData['note'],
            ]);

            return response()->json(['success' => true, 'message' => 'Advance payment has been added!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add advance payment

    // delete payment
    public function deletePayment($id)
    {
        try {
            $userDetails = session('user_details');
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
    // delete payment

    // update payment
    public function updatePayment(Request $request)
    {
        try {
            $userDetails = session('user_details');
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
    // update payment

    // get payment
    public function getPayment($id)
    {
        try {
            $invoice = AssignPayment::where('estimate_complete_invoice_id', $id)->first();
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
    // get payment

    // send payment
    public function sendPayment(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'estimate_id' => 'required',
            ]);

            $estimate = Estimate::with('invoices')->where('estimate_id', $validatedData['estimate_id'])->first();
            $customer = Customer::where('customer_id', $estimate->customer_id)->first();

            try {
                $mail = new SendPaymentReceiptMail($estimate);

                Mail::to($customer->customer_email)->send($mail);

                return response()->json(['success' => true, 'message' => 'Payment receipt sent!'], 200);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'messagae' => $e->getMessage()], 400);
        }
    }
    // send payment

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
                'po_number' => 'required',
            ]);

            $estimateCompleteInvoices = AssignPayment::where('estimate_id', $validatedData['estimate_id'])->where('invoice_status', 'unpaid')->first();

            $estimateCompleteInvoices->invoice_status = 'paid';

            $estimateCompleteInvoices->save();

            $estimate = Estimate::with('invoices')->where('estimate_id', $validatedData['estimate_id'])->first();
            $customer = Customer::where('customer_id', $estimate->customer_id)->first();

            $estimate->invoice_paid = 1;
            $estimate->invoice_paid_total = $estimate->invoice_paid_total + $validatedData['invoice_amount'];
            $estimate->estimate_status = 'paid';

            $estimate->save();

            $estimatePayment = EstimatePayments::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $estimate->estimate_id,
                'estimate_complete_invoice_id' => $estimateCompleteInvoices->estimate_complete_invoice_id,
                'complete_invoice_date' => $validatedData['invoice_date'],
                'invoice_total'  => $validatedData['invoice_amount'],
                'note' => $validatedData['note'],
            ]);


            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Payment Completed', "Payment has been completed of the Estimate.");

            return response()->json(['success' => true, 'message' => 'Payment has been completed!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add payment

    // update invoice
    public function updateInvoice(Request $request)
    {
        try {
            $userDetails = session('user_details');
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
    // update invoice

    // get invoice
    public function getInvoice($id)
    {
        try {

            $invoice = AssignPayment::where('estimate_complete_invoice_id', $id)->first();

            if (!$invoice) {
                return response()->json(['success' => false, 'message' => 'Invoice not found!'], 404);
            }

            return response()->json(['success' => true, 'invoice' => $invoice], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get invoice

    // delete Invoice
    public function deleteInvoice($id)
    {
        try {
            $userDetails = session('user_details');

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
    // delete Invoice

    // complete invoice and assign payment
    public function completeInvoiceAndAssignPayment(Request $request)
    {
        try {
            $userDetails = session('user_details');

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

            // Send data to Zapier
            $estimateSending = Http::post('https://hooks.zapier.com/hooks/catch/7921384/3vr65z8/', [
                'amount' => $totalInput,
                'first_name' => $estimate->customer_name . ' ',
                'last_name' => $estimate->customer_last_name,
                'customer_email' => $estimate->customer->customer_email,
                'po_number' => $estimate->po_number,
            ]);

            // Save the estimate
            $estimate->save();

            // Log the activity
            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Invoice Created', "A new Invoice has been created for the customer, added in Invoices Section");

            return response()->json(['success' => true, 'message' => 'Invoice Completed and Payment assigned!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
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
    // Complete work  and assign invoice

    // update schedule
    public function updateScheuleWork(Request $request)
    {
        try {

            $userDetails = session('user_details');

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
    // update schedule

    // delete schedule
    public function deleteSchedule($id)
    {
        try {
            $userDetails = session('user_details');

            $schedule = ScheduleEstimate::where('schedule_estimate_id', $id)->first();

            if (!$schedule) {
                return response()->json(['success' => false, 'message' => 'Schedule not found!'], 404);
            }

            $estimate = Estimate::where('estimate_id', $schedule->estimate_id)->first();
            $estimate->work_assigned = 0;
            $estimate->work_assigned_to = null;
            $estimate->scheduled_start_date = null;
            $estimate->scheduled_end_date = null;

            $estimate->save();
            $schedule->delete();

            return response()->json(['success' => true, 'message' => 'Schedule deleted!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // delete schedule

    // set schedule
    public function setScheduleWork(Request $request)
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
            $estimate->work_assigned_to = $validatedData['assign_work'];

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'The work is scheduled!', 'estimate_id' => $estimate->estimate_id], 200);
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

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimate->schedule_assigned = 1;
            $estimate->schedule_assigned_to = $validatedData['schedule_work'];

            $estimate->save();

            return response()->json(['success' => true, 'message' => 'Work is assigned for schedule!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' =>  false, 'message' => $e->getMessage()], 400);
        }
    }
    // Schedule estimate

    // get completed Estimate
    public function getCompletedEstimate($id)
    {
        $completedEstimate = CompleteEstimate::where('estimate_id', $id)->first();

        return response()->json(['success' => true, 'estimateDetails' => $completedEstimate], 200);
    }
    // get completed Estimate

    // Reassign Complete Estimate
    public function reassignCompleteEstimate(Request $request)
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
    // Complete Estimate

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
    public function acceptProposal(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'estimate_total' => 'required',
                'upgrade_accept_reject' => 'nullable',
                'customer_signature' => 'nullable',
                'proposal_id' => 'nullable',
                'proposal_group_id' => 'nullable',
                'group_statuses' => 'nullable|array',
                'group_statuses.*.status' => 'nullable|in:accepted,rejected',
                'group_statuses.*.proposal_id' => 'nullable',
                'group_statuses.*.type' => 'nullable|in:acceptAll,rejectAll',
            ]);

            $estimate = Estimate::find($id);
            if (!$estimate) {
                return response()->json(['success' => false, 'message' => 'Estimate not found'], 404);
            }

            $upgrade = EstimateItem::where('estimate_id', $estimate->estimate_id)
                ->where('is_upgrade', 'yes')
                ->first();
            $estimator = User::where('id', $estimate->added_user_id)->first();

            // Handle individual upgrade status
            if (isset($validatedData['upgrade_accept_reject'])) {
                if ($upgrade) {
                    $upgrade->upgrade_status = $validatedData['upgrade_accept_reject'];
                    $upgrade->save();
                }
            }

            // Load and update proposal signature regardless of group_statuses
            $proposal = EstimateProposal::where('estimate_proposal_id', $validatedData['proposal_id'])->first();
            if (!$proposal) {
                return response()->json(['success' => false, 'message' => 'Proposal not found'], 404);
            }

            $proposalData = json_decode($proposal->proposal_data, true);

            // ✅ Always update customer_signature in proposal_data
            if (isset($validatedData['customer_signature']) && isset($proposalData['estimate'])) {
                $proposalData['estimate']['customer_signature'] = $validatedData['customer_signature'];
            }

            // Handle group_statuses only if provided
            if (isset($validatedData['group_statuses']) && !empty($validatedData['group_statuses'])) {
                if (isset($proposalData['estimate_items'])) {
                    foreach ($validatedData['group_statuses'] as $groupId => $groupData) {
                        $status = $groupData['status'];
                        $type = $groupData['type'];
                        $proposalId = $groupData['proposal_id'];

                        // Update estimate items in proposal data
                        foreach ($proposalData['estimate_items'] as &$item) {
                            if ($item['estimate_id'] == $id && $item['group_id'] == $groupId) {
                                $item['upgrade_status'] = $status;

                                // Update upgrade_status in DB
                                $dbItem = EstimateItem::find($item['estimate_item_id']);
                                if ($dbItem) {
                                    $dbItem->upgrade_status = $status;
                                    $dbItem->save();
                                }
                            }
                        }

                        // Update include_est_total
                        if ($type === 'acceptAll' || $type === 'rejectAll') {
                            $group = Groups::where('group_id', $groupId)->first();
                            if ($group) {
                                $group->include_est_total = $type === 'acceptAll' ? 1 : 0;
                                $group->save();
                            }
                        }
                    }
                }
            }

            // ✅ Save updated proposal data with customer_signature
            $proposal->proposal_data = json_encode($proposalData);
            $proposal->save();

            // Email notification
            $emailData = [
                'customer_name' => $estimate->customer_name . ' ' . $estimate->customer_last_name,
                'estimate_id' => $validatedData['proposal_id'],
            ];
            try {
                $mail = new ProposalAcceptedMail($emailData);
                Mail::to('office@rivercitypaintinginc.com')->send($mail);
                if ($estimator) {
                    Mail::to($estimator->email)->send($mail);
                }
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Email sending failed: ' . $e->getMessage()], 400);
            }

            // Update proposal status
            $proposal = EstimateProposal::where('estimate_proposal_id', $validatedData['proposal_id'])
                ->when($validatedData['proposal_group_id'], function ($query, $groupId) {
                    return $query->where('group_id', $groupId);
                })
                ->where('proposal_status', 'pending')
                ->first();

            if (!$proposal) {
                return response()->json(['success' => false, 'message' => 'Pending proposal not found'], 404);
            }

            $proposal->proposal_status = 'accepted';
            $proposal->proposal_accepted += $validatedData['estimate_total'];

            // ✅ Save customer_signature in main estimate
            if (isset($validatedData['customer_signature'])) {
                $estimate->customer_signature = $validatedData['customer_signature'];
            }

            $estimate->estimate_total += $validatedData['estimate_total'];
            $estimate->save();
            $proposal->save();

            return response()->json(['success' => true, 'message' => 'You accepted the proposal. Thank You!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // accept proposal

    // view proposal
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
                    // return response()->json(['success' => false, 'message' => 'No valid proposal found'], 404);
                    return view('accept-proposal', ['success' => false, 'message' => 'No valid Estimate found', 'sts' => 404]);
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
                    // return response()->json(['success' => false, 'message' => 'No valid proposal found'], 404);
                    return view('accept-proposal', ['success' => false, 'message' => 'No valid Estimate found', 'sts' => 404]);
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
                return view('previousProposal', $data);
            } else {
                // return response()->json(['success' => false, 'message' => 'No valid ID provided'], 400);
                return view('accept-proposal', ['success' => false, 'message' => 'No valid ID provided', 'sts' => 400]);
            }

            return view('accept-proposal', $data);
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


    // send proposal

    // make proposal
    public function makeProposal($id, Request $request)
    {
        try {

            $preview = $request->query('preview');
            $group_id = $request->query('group_id');

            $data = $this->prepareProposalData($id, $preview, $group_id);

            return view('make-proposal', $data);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    private function prepareProposalData($id, $preview = null, $group_id = null)
    {
        $userDetails = session('user_details');

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
                'email_body' => $validatedData['email_body'], // Use the modified email body
            ]);

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Email Sent', "An Email has been sent to the Customer. The Subject of the email is " . $validatedData['email_subject'] . ".");

            return response()->json(['success' => true, 'message' => 'Email sent to the client!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // estimate emails

    // delete estimate note
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
    // delete estimate note

    // edit estimate note
    public function editEstimateNote(Request $request)
    {
        try {

            $userDetails = session('user_details');
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
    // edit estimate note

    // estimate note
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

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Note Added', "A new Note added in Notes Section");

            return response()->json(['success' => true, 'message' => 'Note added!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // estimate note

    // update estimate item
    public function updateEstimateItem(Request $request)
    {
        try {
            // dd($request);
            $userDetails = session('user_details');
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
                            'added_user_id' => $userDetails['id'],
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
    // update estimate item

    // get estimate item details for edit
    public function getEstimateItem($id)
    {
        $estimateItem = EstimateItem::with('group')->where('estimate_item_id', $id)->first();
        $estimateItemAssembly = EstimateItemAssembly::where('estimate_item_id', $estimateItem->estimate_item_id)->get();

        return response()->json(['success' => true, 'item_detail' => $estimateItem, 'assembly_items' => $estimateItemAssembly], 200);
    }
    // get estimate item details for edit

    // estimate items
    public function estimateItems(Request $request)
    {
        try {
            $userDetails = session('user_details');

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
            // dd($validatedData);
            // Fetch the selected items from the database
            // $selectedItems = Items::whereIn('item_id', $validatedData['selected_items'])->get();

            // $itemsData = [];
            // foreach ($selectedItems as $item) {
            //     $itemsData[] = [
            //         'item_id' => $item->item_id,
            //         'item_name' => $item->item_name,
            //         'item_type' => $item->item_type,
            //         'item_unit' => $item->item_units,
            //         'item_cost' => $item->item_cost,
            //         'item_price' => $item->item_price,
            //     ];
            // }
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
                'added_user_id' => $userDetails['id'],
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
                        // Calculate the sum for 'assembly_unit_by_item_unit' and 'item_unit_by_assembly_unit'
                        $itemUnitByAssUnitSum = $validatedData['item_unit_by_assembly_unit'][$key];
                        $assUnitByItemUnitSum = $validatedData['assembly_unit_by_item_unit'][$key];
                        $assItemQty = $validatedData['item_qty'] * $assUnitByItemUnitSum;
                        $assItemPrice = $assItems->item_price * $assItemQty;
                        // Create a new ItemAssembly for each assembly name
                        EstimateItemAssembly::create([
                            'added_user_id' => $userDetails['id'],
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

            // foreach ($itemsData as $item) {
            //     EstimateItem::create([
            //         'added_user_id' => $userDetails['id'],
            //         'estimate_id' => $validatedData['estimate_id'],
            //         'item_id' => $item['item_id'],
            //         'item_name' => $item['item_name'],
            //         'item_type' => $item['item_type'],
            //         'item_unit' => $item['item_unit'],
            //         'item_cost' => $item['item_cost'],
            //         'item_price' => $item['item_price'],
            //         // Add other fields as needed
            //     ]);
            // }
            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Line Item Added', "A new Line Item added in Items Section. The name of the Line Item is " . $validatedData['item_name'] . ".");

            return response()->json(['success' => true, 'message' => 'Items added to estimate'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // estimate items

    // get images
    public function getEstimateWithImages()
    {
        $userDetails = session('user_details');

        $estimates = Estimate::where('estimate_status', 'pending')->get();
        $customers = Customer::get();

        $estimateData = [];

        foreach ($estimates as $estimate) {
            $images = EstimateImages::where('estimate_id', $estimate->estimate_id)->limit(2)->get();
            $estimateData[] = [
                'estimate' => $estimate,
                'images' => $images,
            ];
        }
        // return response()->json(['success' => true, 'data' => ['estimate_with_images' => $estimateData]], 200);
        return view('feedGallery', ['estimates_with_images' => $estimateData, 'user_details' => $userDetails]);

        // return response()->json(['customers' => $customers, 'estimates_with_images' => $estimateData, 'user_details' => $userDetails], 200);
    }
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

    // update additional contact
    public function updateAdditionalContact(Request $request)
    {
        try {
            $userDetails = session('user_details');
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
    // update additional contact

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
                'phone' => 'required|string',
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

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Contact Added', "A new Contact added in Contacts Section");

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
            $estimate = Estimate::with(
                'customer',
                'estimateContacts',
                'estimateFiles',
                'images',
                'proposals',
                'notes',
                'estimateEmails',
                'invoices',
                'invoice',
            )
                ->where('estimate_id', $id)
                ->first();

            $company = Company::first();

            if (!$estimate) {
                // Handle the case where the estimate is not found
                // You may want to return a response or redirect to an error page
                return response()->json(['success' => false, 'message' => 'Estimate not found'], 404);
            }

            // Process proposals to extract customer_signature from proposal_data JSON
            foreach ($estimate->proposals as $proposal) {
                if (!empty($proposal->proposal_data)) {
                    $proposalData = json_decode($proposal->proposal_data, true);
                    if (isset($proposalData['estimate']['customer_signature'])) {
                        $proposal->customer_signature = $proposalData['estimate']['customer_signature'];
                    } else {
                        $proposal->customer_signature = null;
                    }
                } else {
                    $proposal->customer_signature = null;
                }
            }

            $estimateItems = EstimateItem::with('group', 'assemblies')
                ->where('estimate_id', $estimate->estimate_id)
                ->where('additional_item', '<>', 'yes')
                ->get()
                ->sortBy(function ($item) {
                    // Push sort_order == 0 to the end
                    return $item->sort_order == 0 ? PHP_INT_MAX : $item->sort_order;
                });


            $estimateAdditionalItems = EstimateItem::with('group', 'assemblies')->where('estimate_id', $estimate->estimate_id)->where('additional_item', 'yes')->get();

            $profitHours = EstimateItem::where('item_type', 'labour')->where('estimate_id', $id)->where('additional_item', '<>', 'yes')->sum('item_qty');
            $estimateAssemblyItems = EstimateItem::with('assemblies')->where('estimate_id', $estimate->estimate_id)->where('item_type', 'assemblies')->where('additional_item', '<>', 'yes')->get();

            $assemblyLabourTotalHours = 0;
            $assemblyLabourTotal = 0;
            $assemblyMaterialTotal = 0;
            foreach ($estimateAssemblyItems as $estimateAssemblyItem) {
                $labourAssemblyItems = $estimateAssemblyItem->assemblies->filter(function ($assembly) {
                    return $assembly->ass_item_type === 'labour';
                });
                $MaterialAssemblyItems = $estimateAssemblyItem->assemblies->filter(function ($assembly) {
                    return $assembly->ass_item_type === 'material';
                });
                $assemblyLabourTotalHours += $labourAssemblyItems->sum('ass_item_qty');
                $assemblyLabourTotal += $labourAssemblyItems->sum('ass_item_total');
                $assemblyMaterialTotal += $MaterialAssemblyItems->sum('ass_item_total');
            }

            $profitHours += $assemblyLabourTotalHours;

            $items = Items::get();
            $groups = Groups::get();
            $itemsForAssemblies = Items::where('item_type', 'labour')->orWhere('item_type', 'material')->get();
            $labourItems = Items::where('item_type', 'labour')->get();
            $materialItems = Items::where('item_type', 'material')->get();
            $assemblyItems = Items::where('item_type', 'assemblies')->get();
            $users = User::where('sts', 'active')->get();
            $emailTemplates = Email::get();
            $payments = EstimatePayments::with('invoice')->where('estimate_id', $estimate->estimate_id)->get();
            $toDos = EstimateToDos::with('assigned_to', 'assigned_by')->where('estimate_id', $estimate->estimate_id)->get();
            $advancePayment = AdvancePayment::where('estimate_id', $id)->first();
            //$expenses = EstimateExpenses::where('estimate_id', $estimate->estimate_id)->get();

            $estimateId = $estimate->estimate_id;
            $expenses = EstimateExpenses::where('estimate_id', $estimateId)->get();

            // Initialize an array to store vendor-wise totals
            $vendorTotals = [];

            foreach ($expenses as $expense) {
                $vendorId = $expense->expense_vendor;

                // If vendorId is not set in the array, initialize it
                if (!isset($vendorTotals[$vendorId])) {
                    $vendorTotals[$vendorId] = 0;
                }

                // Add the expense total to the vendor's total
                $vendorTotals[$vendorId] += $expense->expense_total;
            }
            
            $expenseTotal = $expenses->sum('expense_total');
            $itemTemplates = ItemTemplates::orderByRaw('CASE WHEN template_order IS NULL OR template_order = 0 THEN 1 ELSE 0 END, template_order ASC')->get();

            $sumEstimateItems = EstimateItem::where('estimate_id', $id)->where('additional_item', '<>', 'yes')->get();
            $profitFromEstimateItems = $sumEstimateItems->sum('item_total');

            $profitCostEstimateItems = $sumEstimateItems->sum(function ($itemm) {
                return $itemm->item_cost * $itemm->item_qty;
            });

            $profitCost = $profitCostEstimateItems;
            $profitItems = $profitFromEstimateItems;

            $budgetLabour = $profitItems;
            $budgetLabour = $budgetLabour * (1 - $company->company_labor_budget);

            $budgetMaterial = $profitItems;
            $budgetMaterial = $budgetMaterial * (1 - $company->company_material_budget);

            $budgetProfit = $budgetLabour + $budgetMaterial;
            $budgetProfit = $profitItems - $budgetProfit - $expenseTotal;

            $mainProfit = $profitItems - $profitCost - $expenseTotal;
            if ($profitItems) {
                $budgetMargin = $budgetProfit / $profitItems * 100;
                $profitMargin = $mainProfit / $profitItems * 100;
            } else {
                $profitMargin = 0;
                $budgetMargin = 0;
            }

            // Calculate the sum of item_price for the estimate
            $totalPrice = $sumEstimateItems->sum('item_price');
            
            return view('viewEstimates', [
                'estimate' => $estimate,
                'items' => $items,
                'labour_items' => $labourItems,
                'material_items' => $materialItems,
                'assembly_items' => $assemblyItems,
                'estimate_items' => $estimateItems,
                'estimate_assembly_items' => $estimateAssemblyItems,
                'user_details' => $userDetails,
                'item_total' => $totalPrice, // Pass the total price to the view
                'employees' => $users,
                'groups' => $groups,
                'email_templates' => $emailTemplates,
                'payments' => $payments,
                'toDos' => $toDos,
                'expenses' => $expenses,
                'itemsForAssemblies' => $itemsForAssemblies,
                'item_templates' => $itemTemplates,
                'profitHours' => $profitHours,
                'profitCost' => $profitCost,
                'mainProfit' => $mainProfit,
                'profitMargin' => $profitMargin,
                'budgetLabour' => $budgetLabour,
                'budgetMaterial' => $budgetMaterial,
                'budgetProfit' => $budgetProfit,
                'budgetMargin' => $budgetMargin,
                'expenseTotal' => $expenseTotal,
                'vendorTotals' => $vendorTotals,
                'advancePayment' => $advancePayment,
                'estimateAdditionalItems' => $estimateAdditionalItems,
            ]);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // view estimate

    // get Customer details on estimate modal when selecting customer
    public function getCustomerDetails($id)
    {
        try {
            $customer = Customer::find($id);

            return response()->json(['success' => true, 'customer' => $customer], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get Customer details on estimate modal when selecting customer

    // add  estimate
    public function addCustomerAndEstimate(Request $request)
    {
        try {

            $userDetails = session('user_details');

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
            ]);

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
                ]);
            }

            $estimate = Estimate::create([
                'customer_id' => $customer->customer_id,
                'added_user_id' => $user->id,
                'customer_name' => $validatedData['first_name'],
                'customer_phone' => $validatedData['phone'],
                'customer_address' => $validatedData['first_address'],
                'customer_last_name' => $validatedData['last_name'],
                'tax_rate' => $validatedData['tax_rate'],
                'project_name' => $validatedData['project_name'],
                'project_number' => $validatedData['project_number'],
                'project_type' => $validatedData['project_type'],
                'building_type' => $validatedData['building_type'],
                'project_owner' => $user->name . ' ' . $user->last_name,
                'po_number' => $po_number,
                'estimate_internal_note' => $validatedData['internal_note'],
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
    // add  estimate

    // ==============================================================Estimates functions==================================================================
}
