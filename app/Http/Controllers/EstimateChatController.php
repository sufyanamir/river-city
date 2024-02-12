<?php

namespace App\Http\Controllers;

use App\Models\EstimateChat;
use App\Models\Notifications;
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
                'mentioned_user_ids' => 'nullable|array',
            ]);
    
            $message = EstimateChat::create([
                'estimate_id' => $validatedData['estimate_id'],
                'added_user_id' => $userDetails['id'],
                'added_user_name' => $userDetails['name'],
                'chat_message' => $validatedData['chat_message'],
            ]);
    
            if (isset($validatedData['mentioned_user_ids'])) {
                foreach ($validatedData['mentioned_user_ids'] as $mentionedId) {
                    $message->mentioned_user_ids = $mentionedId;
                    $message->save();
    
                    // Extract mentioned_user_ids from the newly created EstimateChat
                    $mentionedUserIds = explode(',', $message->mentioned_user_ids);
    
                    // Loop through each mentioned user ID and create a separate notification
                    foreach ($mentionedUserIds as $singleMentionedId) {
                        $notificationMessage = $userDetails['name'] . " mentioned you in the chat of this estimate " . $validatedData['estimate_id'] . ".";
                        $notification = Notifications::create([
                            'added_user_id' => $userDetails['id'],
                            'notification_message' => $notificationMessage,
                            'mentioned_user_id' => $singleMentionedId,
                            'notification_type' => 'mention',
                        ]);
                    }
                }
            }
    
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
