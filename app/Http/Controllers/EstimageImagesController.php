<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateActivity;
use App\Models\EstimateChat;
use App\Models\EstimateImageChat;
use App\Models\EstimateImages;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstimageImagesController extends Controller
{

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
    // estimate activity

    public function addImageChat(Request $request)
    {
        try {
            $userDetails = session('user_details');

            // Validate the request
            $validatedData = $request->validate([
                'estimate_image_id' => 'required',
                'message' => 'nullable|string',
                'audio_data' => 'nullable|string',
                'mentioned_users' => 'nullable|array',
            ]);

            // Fetch the related estimate image
            $image = EstimateImages::where('estimate_image_id', $validatedData['estimate_image_id'])->first();

            // Determine message content: either text or audio
            $messageContent = null;

            if (!empty($validatedData['message'])) {
                $messageContent = $validatedData['message']; // Store text message
            } elseif (!empty($validatedData['audio_data'])) {
                // Decode the Base64 audio data
                $audioData = base64_decode(preg_replace('#^data:audio/\w+;base64,#i', '', $validatedData['audio_data']));

                // Generate unique filename
                $filename = 'voice_messages/' . uniqid() . '.wav';

                // Store the audio file
                Storage::disk('public')->put($filename, $audioData);

                // Store the audio file path in the message column
                $messageContent = $filename;
            }

            // Create the chat entry
            $chat = new EstimateImageChat([
                'estimate_image_id' => $validatedData['estimate_image_id'],
                'user_id' => $userDetails['id'],
                'user_name' => $userDetails['name'],
                'message' => $messageContent, // Store either text or audio file path
            ]);

            if (isset($validatedData['mentioned_users']) && !empty($validatedData['mentioned_users'])) {
                foreach ($validatedData['mentioned_users'] as $mentionedId) {
                    $chat->mentioned_users = $mentionedId;
                    $chat->save();

                    // Extract mentioned_user_ids from the newly created EstimateChat
                    $mentionedUserIds = explode(',', $chat->mentioned_users);
                    foreach ($mentionedUserIds as $singleMentionedId) {
                        if ($singleMentionedId != null) {
                            $notification = new Notifications([
                                'added_user_id' => $userDetails['id'],
                                'estimate_id' => $image->estimate_id,
                                'notification_message' => $userDetails['name'] . " mentioned you in the chat of this estimate's image " . $image->estimate_id . ".",
                                'mentioned_user_id' => $singleMentionedId,
                                'notification_type' => 'mentionGallery',
                            ]);
                            $notification->save();
                        }
                    }
                }
            }

            // Add activity log
            $this->addEstimateActivity($userDetails, $image->estimate_id, 'Image Chat Sent', "New Chat has been sent in Photos Section");

            return response()->json(['success' => true, 'message' => 'Chat sent successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }


    public function getImageDetails($id)
    {
        $image = EstimateImages::with('chat')->where('estimate_image_id', $id)->first();
        return response()->json(['success' => true, 'data' => $image], 200);
    }

    public function deleteEstimateImage($id)
    {
        try {
            $estimateImage = EstimateImages::where('estimate_image_id', $id)->first();
            // Check if the image exists
            if ($estimateImage) {
                // Delete the image file from the file system
                $imagePath = public_path($estimateImage->estimate_image); // Adjust this based on your file storage configuration
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // Delete the record from the database
                $estimateImage->delete();

                // Optionally, you may also delete the image from the estimate_images folder
                // Assuming that the estimate_images folder is located in the public directory
                $imageFileName = basename($estimateImage->estimate_image);
                $estimateImagesFolder = public_path('estimate_images');

                $imageFilePath = $estimateImagesFolder . '/' . $imageFileName;
                if (file_exists($imageFilePath)) {
                    unlink($imageFilePath);
                }
                return response()->json(['success' => true, 'message' => 'Image deleted successfully!'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Image not found!'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()], 400);
        }
    }

    public function viewGallery($id)
    {
        $userDetails = session('user_details');

        $estimate = Estimate::where('estimate_id', $id)->first();
        $estimateImages = EstimateImages::where('estimate_id', $estimate->estimate_id)->get();
        $customer = Customer::where('customer_id', $estimate->customer_id)->first();
        $users = User::where('id', '<>', $userDetails['id'])->get();
        $chatMessages = EstimateChat::with('addedUser')->where('estimate_id', $id)->orderby('estimate_chat_id', 'desc')->get();
        // return response()->json(['success' => true, 'data' => ['estimate_with_images' => $estimateData]], 200);
        return view('viewGallery', ['chatMessages' => $chatMessages, 'estimate' => $estimate, 'estimate_images' => $estimateImages, 'customer' => $customer, 'users' => $users, 'user_details' => $userDetails]);

        // return response()->json(['customers' => $customers, 'estimates_with_images' => $estimateData, 'user_details' => $userDetails], 200);
    }

    public function addImageCaption(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'estimate_image_id' => 'required',
                'image_caption' => 'required',
            ]);

            $image = EstimateImages::where('estimate_image_id', $validatedData['estimate_image_id'])->first();
            $image->image_caption = $validatedData['image_caption'];
            $image->save();

            return response()->json(['success' => true, 'message' => 'Image caption added successfully'], 200);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function uploadImage(Request $request)
    {
        try {
            $userDetails = session('user_details');

            // Validate the form data
            $request->validate([
                'estimate_id' => 'required',
                'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            ]);

            // Process the form data and handle the file uploads
            $estimateId = $request->input('estimate_id');
            $image = $request->file('file');

            $path = $image->store('estimate_images', 'public');

            // Create a new record in the database for each file
            $estimateImage = new EstimateImages([
                'added_user_id' =>  $userDetails['id'],
                'estimate_id' => $estimateId,
                'estimate_image' => $path,
            ]);

            $estimateImage->save();

            $this->addEstimateActivity($userDetails, $estimateId, 'Image Uploaded', "New Images has been uploaded in Photos Section");

            // Redirect or respond accordingly
            return response()->json(['success' => true, 'message' => 'Images uploaded successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()],  400);
        }
    }

    public function addAsAttachment(Request $request)
    {
        try {
            $userDetails = session('user_details');

            $validatedData = $request->validate([
                'estimate_img_id' => 'required',
                'add_not_add' => 'required',
            ]);

            $image = EstimateImages::where('estimate_image_id', $validatedData['estimate_img_id'])->first();

            if ($validatedData['add_not_add'] == 1) {
                $image->attachment = 1;
                $image->save();
                return response()->json(['success' => true, 'message' => 'Image added as attachment'], 200);
            } else {
                $image->attachment = 0;
                $image->save();
                return response()->json(['success' => true, 'message' => 'Image removed from attachment'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
