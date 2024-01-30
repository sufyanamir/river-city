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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

class EstimateController extends Controller
{


    public function viewEstimateMaterials($id)
    {
            
            $userDetails = session('user_details');
            $estimate = Estimate::where('estimate_id', $id)->first();
            $materialItems = EstimateItem::where('estimate_id', $id)->where('item_type', 'material')->get();
            $customer = Customer::where('customer_id', $estimate->customer_id)->first();

            return view('viewEstimateMaterials', ['items' => $materialItems, 'customer' => $customer, 'estimate' => $estimate]);

    }

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

    public function getEstimateActivity($id)
    {
        $userDetails = session('user_details');
        $activities = EstimateActivity::with('user')->where('estimate_id', $id)->get();

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

    // get ItemTemplates and Items
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
            ]);

            $estTemplate = EstimateItemTemplates::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'item_template_id' => $validatedData['est_template_id'],
                'item_template_name' => $validatedData['est_template_name'],
                'description' => $validatedData['estimate_template_description'],
                'note' => $validatedData['estimate_template_note'],
            ]);

            if (isset($validatedData['template_item_id'])) {
                foreach ($validatedData['template_item_id'] as $key => $itemId) {
                    $itemQty = $validatedData['template_item_qty'][$key];
                    if ($itemQty > 0) {

                        $item = Items::find($itemId);

                        if ($item) {
                            $itemTotal = $itemQty * $item['item_price'];
                            // Create EstimateItemTemplateItems with item details
                            EstimateItemTemplateItems::create([
                                'added_user_id' => $userDetails['id'],
                                'estimate_id' => $validatedData['estimate_id'],
                                'est_template_id' => $estTemplate->est_template_id,
                                'item_id' => $itemId,
                                'item_qty' => $itemQty,
                                'item_total' => $itemTotal,
                                'labour_expense' => $item->labour_expense,
                                'material_expense' => $item->material_expense,
                                'item_cost' => $item->item_cost,
                                'item_price' => $item->item_price,
                                'item_description' => $item->item_description,
                                'item_note' => $item->item_note,
                                // You can add other item details here if needed
                            ]);
                        } else {
                            // Handle the case where the item with the given item_id is not found
                            return response()->json(['success' => false, 'message' => 'Item not found for item_id ' . $itemId], 404);
                        }
                    }
                }
            }

            return response()->json(['success' => true, 'message' => 'Item Added!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get ItemTemplates and Items

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

    // schedule estimate
    public function setScheduleEstimate(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'assign_estimate_completion' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'note' => 'nullable'
            ]);

            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $estimateSchedule = EstimateSchedule::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
                'estimate_complete_assigned_to' => $validatedData['assign_estimate_completion'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
                'note' => $validatedData['note'],
            ]);

            $estimate->estimate_schedule_assigned = 1;
            $estimate->estimate_schedule_assigned_to = $validatedData['assign_estimate_completion'];
            $estimate->save();
            return response()->json(['success' => true, 'message' => 'Estimate is Scheduled!', 'estimate_id' => $estimate->estimate_id], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // schedule estimate

    // get schedule estimate
    public function getEstimateToSetSchedule($id)
    {
        $userDetails = session('user_details');

        $estimate = Estimate::where('estimate_id', $id)->first();
        $customer = Customer::where('customer_id', $estimate->customer_id)->first();
        $estimates = Estimate::get();
        $users = User::where('added_user_id', $userDetails['id'])->where('user_role', 'schedular')->get();

        return view('calendar', ['estimates' => $estimates, 'estimate' => $estimate, 'customer' => $customer, 'user_details' => $userDetails, 'employees' => $users]);
        // return response()->json(['success' => true, 'estimate' => $estimate]);
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

        $estimate = Estimate::where('estimate_id', $id)->first();
        $customer = Customer::where('customer_id', $estimate->customer_id)->first();
        $estimates = Estimate::get();
        $users = User::where('user_role', 'crew')->get();

        return view('calendar', ['estimates' => $estimates, 'estimate' => $estimate, 'customer' => $customer, 'user_details' => $userDetails, 'employees' => $users]);
        // return response()->json(['success' => true, 'estimate' => $estimate]);
    }
    public function getEstimatesOnCalendar()
    {
        $userDetails = session('user_details');
        if ($userDetails['user_role'] == 'crew') {

            $scheduleEstimates = ScheduleEstimate::where('work_assign_id', $userDetails['id'])->get();
            $estimates = [];
            foreach ($scheduleEstimates as $scheduleEstimate) {
                $estimate = Estimate::where('estimate_id', $scheduleEstimate->estimate_id)->first();
                $estimates[] = $estimate;
            }

            return view('calendar', ['estimates' => $estimates]);
        } else {
            $estimates = Estimate::get();
        }

        return view('calendar', ['estimates' => $estimates]);
    }

    public function index()
    {
        $userDetails = session('user_details');
        if ($userDetails['user_role'] == 'admin') {
            $customers = Customer::get();
            $estimates = Estimate::get();
            $users = User::where('user_role', '<>', 'crew')->get();
        } elseif ($userDetails['user_role'] == 'schedular') {
            $estimates = Estimate::where('estimate_schedule_assigned_to', $userDetails['id'])->get();
            $customers = Customer::get();
            $users = User::where('user_role', '<>', 'crew')->get();
        }

        return view('estimates', ['estimates' => $estimates, 'user_details' => $userDetails, 'customers' => $customers, 'users' => $users]);
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

            $toDo->to_do_status = 'complete';

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

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'To-Do Added', "A new To-Do added in To-Dos Section");

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

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Payment Completed', "Payment has been completed of the Estimate.");

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

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Invoice Created', "A new Invoice has been created for the customer, added in Invoices Section");

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
            ]);
            $estimate = Estimate::find($id);
            $upgrade = EstimateItem::where('estimate_id', $estimate->estimate_id)->where('is_upgrade', 'yes')->first();
            if (isset($validatedData['upgrade_accept_reject'])) {
                $upgrade->upgrade_status = $validatedData['upgrade_accept_reject'];
                $upgrade->save();
            }
            $proposal = EstimateProposal::where('estimate_id', $id)->where('proposal_status', 'pending')->first();

            $proposal->proposal_status = 'accepted';
            $proposal->proposal_accepted = $validatedData['estimate_total'];
            $estimate->estimate_total = $validatedData['estimate_total'];

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
            $items = EstimateItem::where('estimate_id', $estimate->estimate_id)->where('item_type', '<>', 'upgrades')->get();
            $upgrades = EstimateItem::where('estimate_id', $estimate->estimate_id)->where('item_type', 'upgrades')->get();
            $estimateItemTemplates = EstimateItemTemplates::where('estimate_id', $estimate->estimate_id)->get();
            $estimateItemTemplateItems = [];

            foreach ($estimateItemTemplates as $key => $itemTemplate) {
                $templateItems = EstimateItemTemplateItems::where('est_template_id', $itemTemplate->est_template_id)->get();

                // Extract item_qty from the template items
                $itemQuantities = $templateItems->pluck('item_qty')->toArray();
                $itemTotals = $templateItems->pluck('item_total')->toArray();

                // Fetch all data for Items
                $itemss = Items::whereIn('item_id', $templateItems->pluck('item_id')->toArray())->get(); // Replace 'Item' with your actual model name

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
            // return response()->json(['success' => true, 'data' => ['user_details' => $userDetails, 'estimate' => $estimate, 'customer' => $customer, 'items' => $items]], 200);
            return view('accept-proposal', [
                'estimate' => $estimate,
                'customer' => $customer,
                'items' => $items,
                'upgrades' => $upgrades,
                'estimateItemTemplates' => $estimateItemTemplates,
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
                'estimate_total' => 'required',
            ]);

            $emailData = [
                'estimate_id' => $validatedData['estimate_id'],
                'email' => $validatedData['customer_email'],
            ];
            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();

            $existingProposals = EstimateProposal::where('estimate_id', $validatedData['estimate_id'])->get();
            if (!$existingProposals->isEmpty()) {
                $existingProposals->each(function ($proposal) {
                    $proposal->proposal_status = 'canceled';
                    $proposal->save();
                });
            }

            $mail = new ProposalMail($emailData);
            Mail::to($validatedData['customer_email'])->send($mail);
            $estimate->estimate_total = null;
            $estimate->save();
            $proposal = EstimateProposal::create([
                'estimate_id' => $validatedData['estimate_id'],
                'proposal_total' => $validatedData['estimate_total'],
            ]);

            $this->addEstimateActivity($userDetails, $validatedData['estimate_id'], 'Proposal Sent', "A Proposal has been created and sent to the Customer");

            return response()->json(['success' => true, 'message' => 'Proposal Sent Successfully!', 'estimate_id' => $validatedData['estimate_id']], 200);
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
            $items = EstimateItem::where('estimate_id', $estimate->estimate_id)->where('item_type', '<>', 'upgrades')->get();
            $upgrades = EstimateItem::where('estimate_id', $estimate->estimate_id)->where('item_type', 'upgrades')->get();
            $existingProposals = EstimateProposal::where('estimate_id', $id)->get();
            $estimateItemTemplates = EstimateItemTemplates::where('estimate_id', $estimate->estimate_id)->get();
            $estimateItemTemplateItems = [];

            foreach ($estimateItemTemplates as $key => $itemTemplate) {
                $templateItems = EstimateItemTemplateItems::where('est_template_id', $itemTemplate->est_template_id)->get();

                // Extract item_qty from the template items
                $itemQuantities = $templateItems->pluck('item_qty')->toArray();
                $itemTotals = $templateItems->pluck('item_total')->toArray();

                // Fetch all data for Items
                $itemss = Items::whereIn('item_id', $templateItems->pluck('item_id')->toArray())->get(); // Replace 'Item' with your actual model name

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

            // return response()->json(['success' => true, 'data' => ['user_details' => $userDetails, 'estimate' => $estimate, 'customer' => $customer, 'items' => $items]], 200);
            return view('make-proposal', [
                'user_details' => $userDetails,
                'estimate' => $estimate,
                'customer' => $customer,
                'items' => $items,
                'existing_proposals' => $existingProposals,
                'upgrades' => $upgrades,
                'estimateItemTemplates' => $estimateItemTemplates
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
                'assembly_unit_by_item_unit' => 'nullable|array',
                'item_unit_by_assembly_unit' => 'nullable|array',
                // 'selected_items' => 'required|array',
            ]);

            $estimateItem = EstimateItem::where('estimate_item_id', $validatedData['item_id'])->first();
            $estimateItemAssembly = EstimateItemAssembly::where('estimate_item_id', $estimateItem->estimate_item_id)->get();

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

            // Delete EstimateItemAssembly data that is not in the request
            if ($validatedData['assembly_id'] != null) {
                $assemblyIdsInRequest = $validatedData['assembly_id'];
                EstimateItemAssembly::where('estimate_item_id', $validatedData['item_id'])
                    ->whereNotIn('estimate_item_assembly_id', $assemblyIdsInRequest)
                    ->delete();
            }
            // Update or insert EstimateItemAssembly data
            foreach ($validatedData['assembly_name'] as $key => $assemblyName) {
                // Check if assembly ID exists, update if it does, otherwise insert
                if (isset($validatedData['assembly_id'][$key])) {
                    // Update existing record
                    $assemblyId = $validatedData['assembly_id'][$key];
                    $assembly = EstimateItemAssembly::find($assemblyId);
                    $assembly->est_ass_item_name = $validatedData['assembly_name'][$key];
                    $assembly->item_unit_by_ass_unit = $validatedData['assembly_unit_by_item_unit'][$key];
                    $assembly->ass_unit_by_item_unit = $validatedData['item_unit_by_assembly_unit'][$key];
                    $assembly->save();
                } else {
                    // Insert new record
                    $assemblyData = [
                        'added_user_id' => $userDetails['id'],
                        'estimate_id' => $validatedData['estimate_id'],
                        'estimate_item_id' => $validatedData['item_id'],
                        'est_ass_item_name' => $validatedData['assembly_name'][$key],
                        'item_unit_by_ass_unit' => $validatedData['assembly_unit_by_item_unit'][$key],
                        'ass_unit_by_item_unit' => $validatedData['item_unit_by_assembly_unit'][$key],
                    ];
                    EstimateItemAssembly::create($assemblyData);
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
        $estimateItem = EstimateItem::where('estimate_item_id', $id)->first();
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
                'item_units' => 'required',
                'labour_expense' => 'nullable',
                'material_expense' => 'nullable',
                'item_cost' => 'required',
                'item_price' => 'required',
                'item_qty' => 'required',
                'item_total' => 'required',
                'item_description' => 'nullable',
                'item_note' => 'nullable',
                'assembly_name' => 'nullable|array',
                'assembly_unit_by_item_unit' => 'nullable|array',
                'item_unit_by_assembly_unit' => 'nullable|array',
                'is_upgrade' => 'nullable',
                // 'selected_items' => 'required|array',
            ]);

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
            ]);

            if (isset($validatedData['assembly_name'])) {
                // Iterate through each assembly name
                foreach ($validatedData['assembly_name'] as $key => $assemblyName) {
                    // Calculate the sum for 'assembly_unit_by_item_unit' and 'item_unit_by_assembly_unit'
                    $itemUnitByAssUnitSum = $validatedData['assembly_unit_by_item_unit'][$key];
                    $assUnitByItemUnitSum = $validatedData['item_unit_by_assembly_unit'][$key];

                    // Create a new ItemAssembly for each assembly name
                    EstimateItemAssembly::create([
                        'added_user_id' => $userDetails['id'],
                        'estimate_id' => $validatedData['estimate_id'],
                        'estimate_item_id' => $estimateItem->estimate_item_id,
                        'est_ass_item_name' => $assemblyName,
                        'item_unit_by_ass_unit' => $itemUnitByAssUnitSum,
                        'ass_unit_by_item_unit' => $assUnitByItemUnitSum,
                    ]);
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

        $estimates = Estimate::get();
        $customers = Customer::get();

        $estimateData = [];

        foreach ($estimates as $estimate) {
            $images = EstimateImages::where('estimate_id', $estimate->estimate_id)->get();
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
                'phone' => 'required|numeric',
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
            $estimate = Estimate::where('estimate_id', $id)->first();

            if (!$estimate) {
                // Handle the case where the estimate is not found
                // You may want to return a response or redirect to an error page
                return response()->json(['success' => false, 'message' => 'Estimate not found'], 404);
            }

            $customer = Customer::where('customer_id', $estimate->customer_id)->first();


            $additionalContacts = EstimateContact::where('estimate_id', $estimate->estimate_id)->get();
            $estimateItems = EstimateItem::where('estimate_id', $estimate->estimate_id)->get();
            $items = Items::get();
            $itemsForAssemblies = Items::where('item_type', 'labour')->orWhere('item_type', 'material')->get();
            $labourItems = Items::where('item_type', 'labour')->get();
            $materialItems = Items::where('item_type', 'material')->get();
            $assemblyItems = Items::where('item_type', 'assemblies')->get();
            $users = User::get();
            $estimateNotes = EstimateNote::where('estimate_id', $estimate->estimate_id)->get();
            $emailTemplates = Email::get();
            $estimateEmails = EstimateEmail::where('estimate_id', $estimate->estimate_id)->get();
            $proposals = EstimateProposal::where('estimate_id', $estimate->estimate_id)->get();
            $estimator = User::where('id', $estimate->estimated_completed_by)->get();
            $schedule = ScheduleWork::where('estimate_id', $estimate->estimate_id)->get();
            $work = ScheduleEstimate::where('estimate_id', $estimate->estimate_id)->get();
            $invoices = AssignPayment::where('estimate_id', $estimate->estimate_id)->get();
            $invoice = AssignPayment::where('estimate_id', $estimate->estimate_id)->first();
            $payments = EstimatePayments::where('estimate_id', $estimate->estimate_id)->get();
            $toDos = EstimateToDos::where('estimate_id', $estimate->estimate_id)->get();
            $expenses = EstimateExpenses::where('estimate_id', $estimate->estimate_id)->get();
            $expenseTotal = $expenses->sum('expense_total');
            $estimateImages = EstimateImages::where('estimate_id', $estimate->estimate_id)->get();
            $estimateFiles = EstimateFile::where('estimate_id', $estimate->estimate_id)->get();
            $itemTemplates = ItemTemplates::get();
            // $estimateItemTemplates = EstimateItemTemplates::where('estimate_id', $estimate->estimate_id)->get();
            $estimateItemTemplates = EstimateItemTemplates::where('estimate_id', $estimate->estimate_id)->get();
            $estimateItemTemplateItems = [];

            foreach ($estimateItemTemplates as $key => $itemTemplate) {
                $templateItems = EstimateItemTemplateItems::where('est_template_id', $itemTemplate->est_template_id)->get();

                // Extract item_qty from the template items
                $itemQuantities = $templateItems->pluck('item_qty')->toArray();
                $itemTotals = $templateItems->pluck('item_total')->toArray();

                // Fetch all data for Items
                $itemss = Items::whereIn('item_id', $templateItems->pluck('item_id')->toArray())->get(); // Replace 'Item' with your actual model name

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

            $profitItems = $estimateItems->sum('item_total');
            $profitHours = EstimateItem::where('item_type', 'labour')->where('estimate_id', $id)->sum('item_qty');
            $budgetLabour = EstimateItem::where('item_type', 'labour')->where('estimate_id', $id)->sum('item_total');
            $budgetMaterial = EstimateItem::where('item_type', 'Material')->where('estimate_id', $id)->sum('item_total');
            $budgetLabour = $budgetLabour * 38 / 100;
            $budgetMaterial = $budgetMaterial * 15 / 100;
            $budgetProfit = $budgetLabour + $budgetMaterial;
            $budgetProfit = $profitItems - $budgetProfit;
            $profitCost = $estimateItems->sum(function ($itemm) {
                return $itemm->item_cost * $itemm->item_qty;
            });

            $mainProfit = $profitItems - $profitCost;
            if ($profitItems) {
                $budgetMargin = $budgetProfit / $profitItems * 100;
                $profitMargin = $mainProfit / $profitItems * 100;
            } else {
                $profitMargin = 0;
                $budgetMargin = 0;
            }

            // Calculate the sum of item_price for the estimate
            $totalPrice = $estimateItems->sum('item_price');
            // return response()->json(['estimateItemTemplates' => $estimateItemTemplates]);
            return view('viewEstimates', [
                'customer' => $customer,
                'estimate' => $estimate,
                'items' => $items,
                'labour_items' => $labourItems,
                'material_items' => $materialItems,
                'assembly_items' => $assemblyItems,
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
                'expenses' => $expenses,
                'estimate_images' => $estimateImages,
                'estimate_files' => $estimateFiles,
                'invoice' => $invoice,
                'itemsForAssemblies' => $itemsForAssemblies,
                'item_templates' => $itemTemplates,
                'estimateItemTemplates' => $estimateItemTemplates,
                'profitHours' => $profitHours,
                'profitCost' => $profitCost,
                'mainProfit' => $mainProfit,
                'profitMargin' => $profitMargin,
                'budgetLabour' => $budgetLabour,
                'budgetMaterial' => $budgetMaterial,
                'budgetProfit' => $budgetProfit,
                'budgetMargin' => $budgetMargin,
                'expenseTotal' => $expenseTotal,
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

            $validatedData = $request->validate([
                'customer_id' => 'nullable',
                'first_name' => 'required|string',
                'last_name' => 'nullable|string',
                'email' => 'required|string',
                'phone' => 'required|numeric',
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

            ]);

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
                    'company_internal_note' => $validatedData['internal_note'],
                    'source' => $validatedData['source'],
                    'owner' => $validatedData['owner'],
                ]);
            }

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
