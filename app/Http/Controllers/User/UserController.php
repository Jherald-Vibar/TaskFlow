<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard() {

        if(!Auth::check()) {
            return redirect()->route('loginForm')->with('error', 'Need to Login');
        }
        return view('Users.dashboard');
    }

    public function test() {
        return view('Auth.try');
    }
}
