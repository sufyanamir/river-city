<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use App\Models\EstimateChat;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstimateChatController extends Controller
{

    public function getLatestMessages($estimate_id)
    {
        $chatMessages = EstimateChat::with('addedUser')->where('estimate_id', $estimate_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => view('partials.chat-messages', compact('chatMessages'))->render()
        ]);
    }

    public function sendChat(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'chat_message' => 'nullable|string',
                'mentioned_user_ids' => 'nullable|array',
                'audio_data' => 'nullable|string',
            ]);

            // dd($validatedData);
            $estimate = Estimate::where('estimate_id', $validatedData['estimate_id'])->first();
            $messageContent = null;

            if (!empty($validatedData['chat_message'])) {
                $messageContent = $validatedData['chat_message']; // Store text message
            } elseif (!empty($validatedData['audio_data'])) {
                // Decode the Base64 audio data
                $audioData = base64_decode(preg_replace('#^data:audio/\w+;base64,#i', '', $validatedData['audio_data']));

                // Generate unique filename
                $filename = 'voice_messages/' . uniqid() . '.wav';

                // Store the audio file
                Storage::disk('public')->put($filename, $audioData);

                $messageContent = $filename;
            }

            $message = EstimateChat::create([
                'estimate_id' => $validatedData['estimate_id'],
                'added_user_id' => $userDetails['id'],
                'added_user_name' => $userDetails['name'],
                'chat_message' => $messageContent,
            ]);

            if (isset($validatedData['mentioned_user_ids']) && !empty($validatedData['mentioned_user_ids'])) {
                foreach ($validatedData['mentioned_user_ids'] as $mentionedId) {
                    $message->mentioned_user_ids = $mentionedId;
                    $message->save();

                    // Extract mentioned_user_ids from the newly created EstimateChat
                    $mentionedUserIds = explode(',', $message->mentioned_user_ids);

                    // Loop through each mentioned user ID and create a separate notification
                    foreach ($mentionedUserIds as $singleMentionedId) {
                        if ($singleMentionedId != null) {
                            $notificationMessage = $userDetails['name'] . " mentioned you in the chat of " . $estimate->customer_name . " " . $estimate->customer_last_name . " estimate " . $validatedData['estimate_id'] . ".";
                            $notification = Notifications::create([
                                'added_user_id' => $userDetails['id'],
                                'estimate_id' => $validatedData['estimate_id'],
                                'notification_message' => $notificationMessage,
                                'mentioned_user_id' => $singleMentionedId,
                                'notification_type' => 'mention',
                            ]);
                        }
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
        $userDetails = session('user_details');
        $estimate = Estimate::where('estimate_id', $id)->first();
        $customer = Estimate::where('customer_id', $estimate->customer_id)->first();
        $chatMessages = EstimateChat::with('addedUser')->where('estimate_id', $id)->orderBy('estimate_chat_id', 'asc')->get();
        $users = User::where('id', '<>', $userDetails['id'])->where('sts', 'active')->get();

        // Assuming you have a Blade view named 'chat_messages.blade.php' for formatting the messages
        // $html = view('chat_messages', compact('chatMessages'))->render();

        return view('estimateChat', ['chatMessages' => $chatMessages, 'estimate' => $estimate, 'customer' => $customer, 'users' => $users]);
    }
}
