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

class GroupController extends Controller
{
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
    // edit group

    // delete group
    public function deleteGroup($id)
    {
        try {
            $group = Groups::find($id);

            $group->delete();

            return response()->json(['success' => true, 'message' => 'Group deleted successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // delete group

    // get groups
    public function getGroups()
    {
        $userDetails = session('user_details');
        $groups = Groups::with('items')->withCount('items')->get();
        $items = Items::get();
        return view('group', ['groups' => $groups, 'items' => $items, 'user_details' => $userDetails]);
    }
    // get groups

    // add group
    public function addGroup(Request $request)
    {
        // dd($request);
        try {
            $validatedData = $request->validate([
                'group_name' => 'required|string',
                'group_type' => 'required|string',
                'group_description' => 'nullable|string',
                'show_unit_price' => 'nullable',
                'show_quantity' => 'nullable',
                'show_total' => 'nullable',
                'show_group_total' => 'nullable',
                'include_est_total' => 'nullable',
            ]);

            $groupData = [
                'group_name' => $validatedData['group_name'],
                'group_type' => $validatedData['group_type'],
                'group_description' => $validatedData['group_description'],
            ];

            if (isset($validatedData['show_unit_price'])) {
                $groupData['show_unit_price'] = $validatedData['show_unit_price'];
            }
            if (isset($validatedData['show_quantity'])) {
                $groupData['show_quantity'] = $validatedData['show_quantity'];
            }
            if (isset($validatedData['show_total'])) {
                $groupData['show_total'] = $validatedData['show_total'];
            }
            if (isset($validatedData['show_group_total'])) {
                $groupData['show_group_total'] = $validatedData['show_group_total'];
            }
            if (isset($validatedData['include_est_total'])) {
                $groupData['include_est_total'] = $validatedData['include_est_total'];
            }

            $group = Groups::create($groupData);

            // foreach ($validatedData['group_item_ids'] as $key => $itemIds) {
            //     $items = Items::where('item_id', $itemIds)->first();

            //     $items->group_ids = $group->group_id;

            //     $items->save();
            // }

            return response()->json(['success' => true, 'message' => 'group created successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add group
}
