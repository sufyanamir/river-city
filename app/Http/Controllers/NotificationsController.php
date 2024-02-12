<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $userDetails = session('user_details');

        $notifications = Notifications::where('added_user_id', $userDetails['id'])->where('notification_type', '<>', 'mention')->orderBy('created_at', 'desc')->get();
        $mentions = Notifications::where('mentioned_user_id', $userDetails['id'])->where('notification_type', 'mention')->orderBy('created_at', 'desc')->get();

        return view('notifications', ['user_details' => $userDetails, 'notifications' => $notifications, 'mentions' => $mentions]);

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
