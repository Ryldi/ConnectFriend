<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use App\Models\UserHobby;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'name' => 'required|string',
                'gender' => 'required|string|in:Male,Female',
                //                                   http: / /www .instagram .com /username
                'instagram' => 'required|url|regex:/^https:\/\/www\.instagram\.com\/[a-zA-Z0-9._]+$/',
                'mobile_number' => 'required|digits_between:7, 15|unique:users',
                'dob' => 'required|date|before:13 years ago',
                'hobby' => 'required|array|min:3',
                'password' => 'required|string|min:8|confirmed',
            ],
            [
                'hobby.min' => 'You must select at least 3 hobbies.',
                'instagram.regex' => 'URL must be http://www.instagram.com/username',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'mobile_number' => $request->mobile_number,
            'instagram' => $request->instagram,
            'password' => Hash::make($request->password)
        ]);

        

        $hobbyIds = $request->hobby;
        for ($i=0; $i < count($hobbyIds); $i++) { 
            UserHobby::create([
                'user_id' => $user->id,
                'hobby_id' => $hobbyIds[$i]
            ]);
        }

        $amount = rand(100000, 125000);

        Payment::create([
            'user_id' => $user->id,
            'amount' => $amount,
        ]);

        return redirect()->route('registrationPaymentPage.view', ['user_id' => $user->id]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|digits_between:7, 15',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('mobile_number', 'password');
        $remember = $request->has('remember_me');

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('homePage.view')->with('user', Auth::user());
        }
        return back()->with('fail', 'These credentials do not match our records.');
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('homePage.view');
    }

    public function showHomePage()
    {
        $users = collect();
        if(Auth::check()){
            $users = User::where('id', '!=', Auth::user()->id)
            ->whereNotIn('id', function ($query) {
                $query->select('receiver_id')
                    ->from('friend_requests')
                    ->where('sender_id', Auth::user()->id)
                    ->whereIn('status', ['Pending', 'Accepted']);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('sender_id')
                    ->from('friend_requests')
                    ->where('receiver_id', Auth::user()->id)
                    ->whereIn('status', ['Accepted']);
            })
            ->get();
        }
        else{
            $users = User::all();
        }
        return view('main.HomePage', ['users' => $users]);
    }

    public function showUserProfilePage($user_id)
    {
        $user = User::find($user_id);
        $friend_request = FriendRequest::where('receiver_id', $user_id)->where('sender_id', Auth::user()->id)->first();
        return view('main.ProfilePage', compact('user', 'friend_request'));
    }

    public function showMyProfilePage()
    {
        return view('main.MyProfilePage');
    }


    public function search(Request $request)
    {
        $users = collect();
        if(Auth::check() && $request->search != null && $request->gender != null){
            $users = User::where('id', '!=', Auth::user()->id)
                    ->whereNotIn('id', function ($query) {
                        $query->select('receiver_id')
                            ->from('friend_requests')
                            ->where('sender_id', Auth::user()->id)
                            ->whereIn('status', ['Pending', 'Accepted']);
                    })
                    ->whereNotIn('id', function ($query) {
                        $query->select('sender_id')
                            ->from('friend_requests')
                            ->where('receiver_id', Auth::user()->id)
                            ->whereIn('status', ['Accepted']);
                    })
                    ->whereHas('hobbies', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->where('gender', $request->gender)
                    ->get();
        }
        else if(Auth::check() && $request->search != null && $request->gender == null){
            $users = User::where('id', '!=', Auth::user()->id)
                    ->whereNotIn('id', function ($query) {
                        $query->select('receiver_id')
                            ->from('friend_requests')
                            ->where('sender_id', Auth::user()->id)
                            ->whereIn('status', ['Pending', 'Accepted']);
                    })
                    ->whereNotIn('id', function ($query) {
                        $query->select('sender_id')
                            ->from('friend_requests')
                            ->where('receiver_id', Auth::user()->id)
                            ->whereIn('status', ['Accepted']);
                    })
                    ->whereHas('hobbies', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->search . '%');
                    })
                    ->get();
        }
        else if(Auth::check() && $request->search == null && $request->gender != null){
            $users = User::where('id', '!=', Auth::user()->id)
                    ->whereNotIn('id', function ($query) {
                        $query->select('receiver_id')
                            ->from('friend_requests')
                            ->where('sender_id', Auth::user()->id)
                            ->whereIn('status', ['Pending', 'Accepted']);
                    })
                    ->whereNotIn('id', function ($query) {
                        $query->select('sender_id')
                            ->from('friend_requests')
                            ->where('receiver_id', Auth::user()->id)
                            ->whereIn('status', ['Accepted']);
                    })
                    ->where('gender', $request->gender)
                    ->get();
        }
        else if(Auth::check() && $request->search == null && $request->gender == null){
            $users = User::where('id', '!=', Auth::user()->id)
            ->whereNotIn('id', function ($query) {
                $query->select('receiver_id')
                    ->from('friend_requests')
                    ->where('sender_id', Auth::user()->id)
                    ->whereIn('status', ['Pending', 'Accepted']);
            })
            ->whereNotIn('id', function ($query) {
                $query->select('sender_id')
                    ->from('friend_requests')
                    ->where('receiver_id', Auth::user()->id)
                    ->whereIn('status', ['Accepted']);
            })
            ->get();
        }
        else{
            $users = User::all();
        }
        return view('main.HomePage', ['users' => $users]);
    }
}
