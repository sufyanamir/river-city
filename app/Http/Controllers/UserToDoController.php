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

    public function completeUserToDo($id)
    {
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
            if ($request->input('estimate_schedule_id') != null) {
                $toDoId = $request->input('estimate_schedule_id');
                $validatedData = $request->validate([
                    'start_date' => 'nullable',
                    'end_date' => 'nullable',
                ]);
                $toDo = UserToDo::where('to_do_id', $toDoId)->first();
                $toDo->start_date = $validatedData['start_date'];
                $toDo->end_date = $validatedData['end_date'];
                $toDo->save();
                return response()->json(['success' => true, 'message' => 'To Do updated!'], 200);
            } else {
                $validatedData = $request->validate([
                    'to_do_title' => 'required',
                    'assign_work' => 'nullable',
                    'start_date' => 'nullable',
                    'end_date' => 'nullable',
                    'note' => 'nullable',
                ]);

                $toDo = UserToDo::create([
                    'added_user_id' => isset($request->assign_work) ? $request->assign_work : $userDetails['id'],
                    'to_do_title' => $validatedData['to_do_title'],
                    'start_date' => $validatedData['start_date'],
                    'end_date' => $validatedData['end_date'],
                    'note' => $validatedData['note'],
                ]);

                return response()->json(['success' => true, 'message' => 'To Do added!'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
