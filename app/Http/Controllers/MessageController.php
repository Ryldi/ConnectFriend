<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function showChatDetailPage($receiver_id)
    {
        $receiver = User::find($receiver_id);

        $messages = Message::whereIn('sender_id', [Auth::user()->id, $receiver_id])
        ->whereIn('receiver_id', [Auth::user()->id, $receiver_id])
        ->orderBy('created_at', 'asc')
        ->get();

        return view('main.ChatDetailPage', compact('receiver', 'messages'));
    }

    public function sendMessage(Request $request, $receiver_id)
    {
        $request->validate([
            'message' => 'required|max:1000',
        ]);

        Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $receiver_id,
            'message' => $request->message
        ]);

        Notification::create([
            'user_id' => $receiver_id,
            'type' => 'Message',
            'message' => 'You have a new message from '.Auth::user()->name.'!'
        ]);

        return redirect()->back();
    }
}
