<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendRequestController extends Controller
{
    public function sendFriendRequest($receiver_id)
    {        
        $sender = Auth::user();

        $existedRequest = FriendRequest::with('sender', 'receiver', 'friend')->where('sender_id', Auth::user()->id)->where('receiver_id', $receiver_id)->first();
        if($existedRequest != null && $existedRequest->status == 'Canceled'){
            $existedRequest->status = 'Pending';
            $existedRequest->save();

            return redirect()->back()->with('sent', 'Friend request has been sent.');
        }

        FriendRequest::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver_id,
        ]);

        Notification::create([
            'user_id' => $receiver_id,
            'type' => 'Friend Request',
            'message' => 'You have a new friend request from '.$sender->name
        ]);
        return redirect()->back()->with('sent', (session()->get('locale') === 'en') ? 'Friend request has been sent.' : 'Permintaan teman telah dikirim.');
    }

    public function showFriendRequestPage()
    {
        $sent = User::whereIn('id', function ($query){
            $query->select('receiver_id')
            ->from('friend_requests')
            ->where('sender_id', Auth::user()->id)
            ->where('status', 'Pending');
        })
        ->get();

        $received = User::whereIn('id', function ($query){
            $query->select('sender_id')
            ->from('friend_requests')
            ->where('receiver_id', Auth::user()->id)
            ->where('status', 'Pending');
        })
        ->get();
        
        return view('main.FriendRequestPage', ['sent' => $sent, 'received' => $received]);
    }

    public function unsendFriendRequest($receiver_id)
    {
        $sender = Auth::user();
        $receiver = User::find($receiver_id);

        $sentRequest = FriendRequest::with('sender', 'receiver', 'friend')->where('sender_id', $sender->id)->where('receiver_id', $receiver_id)->first();
        $sentRequest->status = 'Canceled';
        $sentRequest->save();

        Notification::create([
            'user_id' => $receiver->id,
            'type' => 'Friend Request',
            'message' => 'Too bad, so sad! '.$sender->name.' has canceled the friend request'
        ]);

        return redirect()->back()->with('cancel', 'Friend request has been canceled.');
    }

    public function acceptFriendRequest($sender_id)
    {
        $sender = User::find($sender_id);
        $receiver = Auth::user();
        
        $receivedRequest = FriendRequest::with('sender', 'receiver', 'friend')->where('sender_id', $sender_id)->where('receiver_id', $receiver->id)->first();
        $receivedRequest->status = 'Accepted';
        $receivedRequest->save();

        Notification::create([
            'user_id' => $receiver->id,
            'type' => 'Friend Request',
            'message' => 'Congrats! '.$sender->name.' is now your friend.'
        ]);
        
        Notification::create([
            'user_id' => $sender_id,
            'type' => 'Friend Request',
            'message' => 'Congrats! '.$receiver->name.' is now your friend.'
        ]);

        return redirect()->back()->with('accept', 'Congrats! '.$sender->name.' is now your friend.');
    }

    public function showChatPage()
    {
        $user = User::with('friends.sender.hobbies')->find(Auth::user()->id);

        $userId = Auth::user()->id;

        // if(count($user->friends) == 0){
        //     $user = User::with('friends.sender.hobbies')->find(Auth::user()->id);
        // }

        $friends = FriendRequest::with(['sender.hobbies', 'receiver.hobbies'])
        ->where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->get();

        // Format the friends list to show only the other user as a "friend"
        $friendsList = $friends->map(function ($friend) use ($userId) {
            return $friend->sender_id == $userId ? $friend->receiver : $friend->sender;
        });

        // dd($friendsList);
        // dd($friends);

        return view('main.ChatPage', ['friends' => $friendsList]);
    }
}
