<?php

namespace App\Http\Controllers;

use App\Models\EstimateImages;
use Illuminate\Http\Request;

class EstimageImagesController extends Controller
{
    public function uploadImage(Request $request)
    {
        try {
            $userDetails = session('user_details');

            // Validate the form data
            $request->validate([
                'estimate_id' => 'required',
                'upload_image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            ]);

            // Process the form data and handle the file uploads
            $estimateId = $request->input('estimate_id');
            $images = $request->file('upload_image');

            foreach ($images as $image) {
                // Save each file to a specific location
                $path = $image->store('estimate_images', 'public');

                // Create a new record in the database for each file
                $estimateImage = new EstimateImages([
                    'added_user_id' =>  $userDetails['id'],
                    'estimate_id' => $estimateId,
                    'estimate_image' => $path,
                ]);

                $estimateImage->save();
            }

            // Redirect or respond accordingly
            return response()->json(['success' => true, 'message' => 'Images uploaded successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()],  400);
        }
    }
}
