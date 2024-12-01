<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Redirect
        return redirect()->route('home');
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
            return redirect()->intended();
        } else {
            return back()->withErrors([
                'failed' => 'The provided credentials do not match any user.'
            ]);
        }
    }
}
