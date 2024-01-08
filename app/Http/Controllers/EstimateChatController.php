<?php

namespace App\Http\Controllers;

use App\Models\EstimateChat;
use Illuminate\Http\Request;

class EstimateChatController extends Controller
{
    public function sendChat(Request $request)
    {
        try {

            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'chat_message' => 'required',
            ]);

            $message = EstimateChat::create([
                'estimate_id' => $validatedData['estimate_id'],
                'added_user_id' => $userDetails['id'],
                'added_user_name' => $userDetails['name'],
                'chat_message' => $validatedData['chat_message'],
            ]);

            return response()->json(['success' => true, 'message' => 'message sent!'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getChatMessage($id)
    {
        try {
            $userDetails = session('user_details');
            $chatMessages = EstimateChat::where('estimate_id', $id)->get();

            // Assuming you have a Blade view named 'chat_messages.blade.php' for formatting the messages
            $html = view('chat_messages', compact('chatMessages'))->render();

            return response()->json(['success' => true, 'html' => $html], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
