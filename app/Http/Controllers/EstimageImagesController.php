<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateActivity;
use App\Models\EstimateImages;
use Illuminate\Http\Request;

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
            }else{
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
        // return response()->json(['success' => true, 'data' => ['estimate_with_images' => $estimateData]], 200);
        return view('viewGallery', ['estimate' => $estimate, 'estimate_images' => $estimateImages, 'customer' => $customer]);

        // return response()->json(['customers' => $customers, 'estimates_with_images' => $estimateData, 'user_details' => $userDetails], 200);
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
            }else{
                $image->attachment = 0;
                $image->save();
                return response()->json(['success' => true, 'message' => 'Image removed from attachment'], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

}
