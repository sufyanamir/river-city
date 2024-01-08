<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $userDetails = session('user_details');

        $notifications = Notifications::where('added_user_id', $userDetails['id'])->get();

        return view('notifications', ['user_details' => $userDetails, 'notifications' => $notifications]);

    }

    public function markNotifications(Request $request)
    {
        try {
            $userDetails = session('user_details');
    
            $notifications = Notifications::where('added_user_id', $userDetails['id'])->get();
    
            foreach ($notifications as $notification) {
                $notification->notification_status = 'read';
        
                $notification->save();
            }
    
            return response()->json(['success' => true, 'message' => 'Marked as Read!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
        
    }
}
