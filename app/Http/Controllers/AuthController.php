<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Register User function
    public function register(Request $request) {
        // Validate
        $fields = $request->validate([
            'username' => ['required', 'min:5', 'max:255'],
            'email' => ['required','email','max:255', 'unique:users'],
            'password'=> ['required','min:3','confirmed'],
        ]);


        // Register
        $user = User::create($fields);

        // Login
        Auth::login($user);

        event(new Registered($user));

        // Redirect
        return redirect()->route('passwords.index');
    }

    // Verify Email Notice Handler
    public function verifyNotice() {
        return view('auth.verify-email');
    }

    // Email Verification Handler
    public function verifyEmail (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('passwords.index');
    }

    // Resend Verification Email Handler
    public function verifyHandler (Request $request){
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success','Verification email resent.');
    }

    // Login User
    public function login(Request $request) {
        // Validate
        $fields = $request->validate([
            'email' => ['required','email','max:255'],
            'password'=> ['required'],
        ]);

        // Attempt Login
        if(Auth::attempt($fields, $request->remember)) {
            return redirect()->intended('passwords');
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match any user.'
            ]);
        }
    }

    // Logout User
    public function logout(Request $request) {
        // Attempt Logout
        Auth::logout();

        // Invalidate user token
        $request->session()->invalidate();

        // Regenerate user token
        $request->session()->regenerate();

        // Redirect to home
        return redirect()->route('passwords.index');
    }

    public function settings(){

        return view('auth.settings');
    }

    public function updatePassword(Request $request) {
        // Validate
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:3'
        ]);

        // Check old password
        if(Hash::check($request->old_password, Auth::user()->password) == false){
            return back()->withErrors([
                'failed' => 'The provided password do not match the user.'
            ]);
        }

        // Update with new password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success','Master password changed successfully.');
    }
}
