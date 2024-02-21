<?php

namespace App\Http\Controllers;

use App\Models\UserToDo;
use Illuminate\Http\Request;

class UserToDoController extends Controller
{

    public function deleteUserToDo($id)
    {
        try {
            
            $toDo = UserToDo::where('to_do_id', $id)->first();

            $toDo->delete();

            return response()->json(['success' => true, 'message' => 'To Do deleeted!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function completeUserToDo($id){
        try {
            
            $toDo = UserToDo::where('to_do_id', $id)->first();

            $toDo->to_do_status = 'completed';

            $toDo->save();

            return response()->json(['success' => true, 'message' => 'To Do Completed!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function addUserToDo(Request $request)
    {
        try {

            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'to_do_title' => 'required',
            ]);

            $toDo = UserToDo::create([
                'added_user_id' => $userDetails['id'],
                'to_do_title' => $validatedData['to_do_title'],
            ]);

            return response()->json(['success' => true, 'message' => 'To Do added!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
