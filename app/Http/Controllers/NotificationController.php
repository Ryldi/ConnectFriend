<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function showNotificationPage()
    {
        $notifications = Notification::where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('main.NotificationPage', ['notifications' => $notifications]);
    }
}
