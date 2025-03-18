<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email not found.'])->withInput();
        }

        if (!Auth::attempt($validated)) {
            return redirect()->back()->withErrors(['password' => 'Invalid credentials.'])->withInput();
        }
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('user-dashboard');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginForm')->with('success', 'Logout Success!');
    }

    public function forgotPassword() {
        return view('Auth.forget-password');
    }

    public function forgotPasswordPost(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('emails.forgot-password', ['token' => $token], function($message) use ($request) {
            $message->to($request->email);
            $message->subject("Reset Password");
        });

        return redirect()->route('forgotpassForm')->with('success', "Sending Email To Reset Password Success!");
    }

    public function resetPasswordForm($token) {
        return view("Auth.new-password", compact('token'));
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if(!$updatePassword) {
            return redirect()->route('reset')->with('error', "Password Reset Error!")->withInput();
        }

        User::where("email", $request->email)->update(["password" => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(["email" => $request->email])->delete();

        return redirect()->route('loginForm')->with('success', 'Password reset success!');
    }


}
