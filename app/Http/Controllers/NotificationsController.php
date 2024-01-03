<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $userDetails = session('user_details');
        if ($userDetails == 'admin') {
            $notifications = Notifications::get();
        }else{
            $notifications = Notifications::where('added_user_id', $userDetails['id'])->get();
        }

        return view('notifications', ['user_details' => $userDetails, 'notifications' => $notifications]);

    }
}
