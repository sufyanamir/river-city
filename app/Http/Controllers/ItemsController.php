<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\Groups;
use App\Models\ItemAssembly;
use App\Models\Items;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

    // get item date
    public function getItemData($id)
{
    $item = Items::with('group', 'assemblies')->find($id);
    
    foreach ($item->assemblies as $assembly) {
        $assemblyItem = Items::where('item_id', $assembly->ass_item_id)->first();
        $assembly->assemblyItemData = $assemblyItem;
    }

    return response()->json(['success' => true, 'item' => $item], 200);
}


    // get item date

    // delete item
    public function deleteItem($id)
    {
        try {
            $item = Items::find($id);

            $item->assemblies()->delete();
            $item->delete();

            return response()->json(['success' => true, 'message' => 'Item deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // delete item

    // get item
    public function getItems($type = null)
    {
        $userDetails = session('user_details');
        if ($type === 'material' || $type === 'labour' || $type === 'assemblies') {
            $items = Items::with('group')->where('item_type', $type)->get();
            $itemsForAssemblis = Items::where('item_type', 'labour')->orWhere('item_type', 'material')->get();
        } else {
            $items = Items::with('group')->get();
            $itemsForAssemblis = Items::where('item_type', 'labour')->orWhere('item_type', 'material')->get();
        }
        $groups = Groups::get();

        return view('items', ['items' => $items, 'groups' => $groups, 'user_details' => $userDetails, 'itemsForAssemblies' => $itemsForAssemblis]);
    }
    public function getGroupsWithItems()
    {
        $userDetails = session('user_details');
        $items = Items::get();
        $groups = Groups::get();

        return view('group', ['items' => $items, 'groups' => $groups, 'user_details' => $userDetails]);
    }
    // get item

    // get item to edit
    public function updateItem(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'item_id' => 'required',
                'item_type' => 'required|string',
                'item_name' => 'required|string',
                'item_units' => 'nullable|string',
                'item_cost' => 'required|numeric',
                'item_price' => 'required|numeric',
                'labour_expense' => 'nullable|numeric',
                'material_expense' => 'nullable|numeric',
                'item_description' => 'nullable|string',
                'assembly_name' => 'nullable|array',
                'ass_item_id' => 'nullable|array',
                'item_unit_by_ass_unit' => 'nullable|array',
                'ass_unit_by_item_unit' => 'nullable|array',
                'item_group' => 'nullable',
            ]);

            $item = Items::with('assemblies')->where('item_id', $validatedData['item_id'])->first();

            $item->item_type = $validatedData['item_type'];
            $item->item_name = $validatedData['item_name'];
            $item->item_units = $validatedData['item_units'];
            $item->item_cost = $validatedData['item_cost'];
            $item->item_price = $validatedData['item_price'];
            $item->labour_expense = $validatedData['labour_expense'];
            $item->material_expense = $validatedData['material_expense'];
            $item->item_description = $validatedData['item_description'];
            $item->group_ids = $validatedData['item_group'];

            $item->save();

            $item->assemblies()->delete();

            if (!empty($validatedData['assembly_name'])) {
                foreach ($validatedData['assembly_name'] as $key => $assemblyName) {
                    if (!empty($assemblyName)) {
                        $assItemIds = $validatedData['ass_item_id'][$key];
                        $itemUnitByAssUnitSum = $validatedData['item_unit_by_ass_unit'][$key];
                        $assUnitByItemUnitSum = $validatedData['ass_unit_by_item_unit'][$key];

                        // Create a new ItemAssembly for each assembly name
                        ItemAssembly::create([
                            'item_id' => $item->item_id,
                            'assembly_name' => $assemblyName,
                            'item_unit_by_ass_unit' => $itemUnitByAssUnitSum,
                            'ass_unit_by_item_unit' => $assUnitByItemUnitSum,
                            'ass_item_id' => $assItemIds,
                        ]);
                    }
                }
            }

            return response()->json(['success' => true, 'message' => 'Item Updated!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // get item to edit

    // get item to edit
    public function getItemToEdit($id)
    {
        $userDetails = session('user_details');

        $item = Items::with('assemblies')->where('item_id', $id)->first();

        return response()->json(['success' => true, 'data' => ['item' => $item]], 200);
    }
    // get item to edit

    // add item
    public function addItem(Request $request)
    {
        // dd($request);
        try {
            $validatedData = $request->validate([
                'item_type' => 'required|string',
                'item_name' => 'required|string',
                'item_units' => 'nullable|string',
                'item_cost' => 'required|numeric',
                'item_price' => 'required|numeric',
                'labour_expense' => 'nullable|numeric',
                'material_expense' => 'nullable|numeric',
                'item_description' => 'nullable|string',
                'assembly_name' => 'nullable|array',
                'ass_item_id' => 'nullable|array',
                'item_unit_by_ass_unit' => 'nullable|array',
                'ass_unit_by_item_unit' => 'nullable|array',
                'item_group' => 'nullable',
            ]);

            $item = Items::create([
                'item_name' => $validatedData['item_name'],
                'item_type' => $validatedData['item_type'],
                'item_units' => $validatedData['item_units'],
                'item_cost' => $validatedData['item_cost'],
                'item_price' => $validatedData['item_price'],
                'labour_expense' => $validatedData['labour_expense'],
                'material_expense' => $validatedData['material_expense'],
                'item_description' => $validatedData['item_description'],
                'group_ids' => $validatedData['item_group'],
            ]);

            if (isset($validatedData['assembly_name'])) {
                // Iterate through each assembly name
                foreach ($validatedData['assembly_name'] as $key => $assemblyName) {
                    // Calculate the sum for 'item_unit_by_ass_unit' and 'ass_unit_by_item_unit'
                    if (!empty($assemblyName)) {
                        $assItemIds = $validatedData['ass_item_id'][$key];
                        $itemUnitByAssUnitSum = $validatedData['item_unit_by_ass_unit'][$key];
                        $assUnitByItemUnitSum = $validatedData['ass_unit_by_item_unit'][$key];

                        // Create a new ItemAssembly for each assembly name
                        ItemAssembly::create([
                            'item_id' => $item->item_id,
                            'assembly_name' => $assemblyName,
                            'item_unit_by_ass_unit' => $itemUnitByAssUnitSum,
                            'ass_unit_by_item_unit' => $assUnitByItemUnitSum,
                            'ass_item_id' => $assItemIds,
                        ]);
                    }
                }
            }

            return response()->json(['success' => true, 'message' => 'Item added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add item

}
