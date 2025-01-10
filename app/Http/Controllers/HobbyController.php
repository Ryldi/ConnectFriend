<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function showRegisterPage()
    {
        $hobbies = Hobby::with('users')->get();
        return view('main.RegisterPage', ['hobbies' => $hobbies]);
    }
}
