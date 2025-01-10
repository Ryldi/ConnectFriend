<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avatar;
use App\Models\User;
use App\Models\UserAvatar;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{
    public function index()
    {
        $avatars = Avatar::whereNotIn('id', UserAvatar::where('user_id', Auth::user()->id)->pluck('avatar_id'))->get();
        $user_avatars = Avatar::whereIn('id', UserAvatar::where('user_id', Auth::user()->id)->pluck('avatar_id'))->get();
        return view('main.AvatarPage', compact('avatars', 'user_avatars'));
    }

    public function buy($avatar_id)
    {
        $avatar = Avatar::find($avatar_id);

        if($avatar->price > Auth::user()->coins) {
            return redirect()->back()->with('fail', (session('locale') == 'en') ? 'You don\'t have enough coins!' : 'Anda tidak memiliki cukup coin!');
        }

        $user = User::find(Auth::user()->id);
        $user->coins -= $avatar->price;
        $user->save();
        
        UserAvatar::create([
            'user_id' => Auth::user()->id,
            'avatar_id' => $avatar_id
        ]);

        return redirect()->back()->with('sent', (session('locale') == 'en') ? 'Avatar purchased!' : 'Avatar berhasil dibeli!');
    }

    public function use($avatar_id)
    {
        $avatar = Avatar::find($avatar_id);

        $user = User::find(Auth::user()->id);
        $user->avatar = $avatar->url;
        $user->save();

        $user_avatar = UserAvatar::where('user_id', Auth::user()->id)->where('avatar_id', $avatar_id)->first();

        return redirect()->back()->with('sent', (session('locale') == 'en') ? 'Avatar used!' : 'Avatar digunakan!');
    }
}
