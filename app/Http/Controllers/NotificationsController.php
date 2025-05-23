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
        $mentions = Notifications::where('mentioned_user_id', $userDetails['id'])
            ->whereIn('notification_type', ['mention', 'mentionGallery'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('notifications', ['user_details' => $userDetails, 'notifications' => $notifications, 'mentions' => $mentions]);

    }

    public function markNotification($id)
    {
        try{
            $notification = Notifications::find($id);
            $notification->notification_status = 'read';
            $notification->save();
            return redirect()->back()->with('success', 'Notification marked as read!');
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function markNotifications(Request $request)
    {
        try {
            $userDetails = session('user_details');
    
            $notifications = Notifications::where('added_user_id', $userDetails['id'])->where('notification_type', '<>', 'mention')->get();
            $mentions = Notifications::where('mentioned_user_id', $userDetails['id'])
                ->whereIn('notification_type', ['mention', 'mentionGallery'])
                ->get();
    
            foreach ($notifications as $notification) {
                $notification->notification_status = 'read';
        
                $notification->save();
            }
            foreach ($mentions as $mention) {
                $mention->notification_status = 'read';
        
                $mention->save();
            }

            // Update the session value for notifications
            $userDetails['notifications'] = 0;
            session(['user_details' => $userDetails]);
    
            return response()->json(['success' => true, 'message' => 'Marked as Read!'], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
        
    }

    public function deleteNotification($id)
    {
        try{
            $notification = Notifications::find($id);
            $notification->delete();
            return redirect()->back()->with('success', 'Notification deleted!');
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        } 
    }

    public function clearNotifications(Request $request)
    {
        try{
            $userDetails = session('user_details');

            $notifications = Notifications::where('added_user_id', $userDetails['id'])->where('notification_type', '<>', 'mention')->get();
            $mentions = Notifications::where('mentioned_user_id', $userDetails['id'])
                ->whereIn('notification_type', ['mention', 'mentionGallery'])
                ->get();

                foreach ($notifications as $notification) {
            
                    $notification->delete();
                }
                foreach ($mentions as $mention) {
            
                    $mention->delete();
                }

                return response()->json(['success' => true, 'message' => 'All notification have been cleared!'], 200);

        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

}
