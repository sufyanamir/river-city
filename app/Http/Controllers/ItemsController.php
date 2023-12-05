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
    protected $userDetails;

    public function __construct()
    {
        // Retrieve user details from session and store it in $userDetails
        $this->userDetails = Session::get('user_details');
    }

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
    public function getItems()
    {
        $items = Items::get();

        return view('items', ['items' => $items, 'user_details' => $this->userDetails]);
    }
    public function getGroupsWithItems()
    {
        $items = Items::get();
        $groups = Groups::get();

        return view('group', ['items' => $items, 'groups' => $groups, 'user_details' => $this->userDetails]);
    }
    // get item

    // add item
    public function addItem(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'item_name' => 'required|string',
                'item_type' => 'required|string',
                'item_units' => 'required|string',
                'item_cost' => 'required|numeric',
                'item_price' => 'required|numeric',
                'labour_expense' => 'nullable|numeric',
                'item_description' => 'required|string',
                'assembly_name' => 'nullable|array',
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

            if (isset($validatedData['assembly_name'])) {
                // Iterate through each assembly name
                foreach ($validatedData['assembly_name'] as $assemblyName) {
                    // Create a new ItemAssembly for each assembly name
                    ItemAssembly::create([
                        'item_id' => $item->item_id,
                        'assembly_name' => $assemblyName,
                    ]);
                }
            }

            return response()->json(['success' => true, 'message' => 'Item added successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add item

}
