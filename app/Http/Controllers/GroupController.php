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

    protected $userDetails;

    public function __construct()
    {
        // Retrieve user details from session and store it in $userDetails
        $this->userDetails = Session::get('user_details');
    }

    // get groups
    public function getGroups()
    {
        $groups = Groups::get();

        return view('group', ['groups' => $groups, 'user_details' => $this->userDetails]);
    }
    // get groups

    // add group
    public function addGroup(Request $request)
    {
        dd($request);
        try {
            $validatedData = $request->validate([
                'group_name' => 'required|string',
                'total_items' => 'required|numeric',
                'group_type' => 'required|string',
                'group_items' => 'required|array',
                'group_description' => 'nullable|string',
            ]);

            $group = Groups::create([
                'group_name' => $validatedData['group_name'],
                'total_items' => $validatedData['total_items'],
                'group_type' => $validatedData['group_type'],
                'group_items' => $validatedData['group_items'],
                'group_description' => $validatedData['group_description'],
            ]);

            return response()->json(['success' => true, 'message' => 'group created successfully!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // add group
}
