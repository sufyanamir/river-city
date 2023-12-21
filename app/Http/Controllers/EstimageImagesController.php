<?php

namespace App\Http\Controllers;

use App\Models\EstimateImages;
use Illuminate\Http\Request;

class EstimageImagesController extends Controller
{
    public function addEstimateImage(Request $request)
    {
        try {
            $userDetails = session('user_details');
            $validatedData = $request->validate([
                'estimate_id' => 'required',
                'upload_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
            ]);

            $estimateImage = EstimateImages::create([
                'added_user_id' => $userDetails['id'],
                'estimate_id' => $validatedData['estimate_id'],
            ]);

            if ($request->hasFile('upload_image')) {
                $image = $request->file('upload_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/estimate_images/', $imageName);
                $estimateImage->estimate_image = 'storage/estimate_images/' . $imageName;
            }

            $estimateImage->save();

            return response()->json(['success' => true, 'message' => 'Image added to estimate!'], 200);

        } catch (\Exception $e) {
            return  response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
