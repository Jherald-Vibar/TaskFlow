<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function register() {
        return view("Auth.register");
    }

    public function store(Request $request) {

        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|min:8|regex:/[0-9]/',
        ]);

        if($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
        ]);

        return redirect()->route('loginForm')->with('success', "Registration Success!");
    }

    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuth() {
        try {
            $google_user = Socialite::driver('google')->user();


            $user = User::where('email', $google_user->getEmail())->first();

            if ($user) {

                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $google_user->getId(),
                    ]);
                }
            } else {

                $user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),
                    'image' => $google_user->getAvatar(),
                ]);
            }

            Auth::login($user);

            return redirect()->route('user-dashboard');

        } catch (\Throwable $e) {
            return redirect()->route('registrationForm')->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }

    public function login() {
        return view('Auth.login');
    }

    public function authenticate(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->route('user-dashboard');
        }
        return redirect()->back()->withErrors($validated)->withInput();
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm')->with('success', 'Logout Success!');
    }

}
