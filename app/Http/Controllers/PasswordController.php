<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Password;
use App\Http\Requests\StorePasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Mockery\Generator\StringManipulation\Pass\Pass;

class PasswordController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(['auth', 'verified'], only: ['store','index']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mail::to('mike@email.com')->send(new WelcomeMail(Auth::user()) );

        // $passwords = Auth::user()->passwords;
        $search = request()->search;

        $passwords = Password::where(function($query) use ($search){
            $query->where('loginname', 'like', "%$search%")->where('user_id', Auth::id());
        })->orderBy('loginname')->get();

        // return view('main.home', [ 'passwords' => $passwords ]);
        return view('main.home', compact('passwords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate
        $fields = $request->validate([
            'loginname'=> ['required','max:255'],
            'email'=> ['required','max:255'],
            'password'=> ['required','min:3'],
            'note'=>['max:2000'],
        ]);

        // Add
        Auth::user()->passwords()->create($fields);

        return back()->with('success','Your login was added.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Password $password)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Password $password)
    {
        Gate::authorize('modify', $password);

        return view('ops.edit', [ 'password' => $password]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Password $password)
    {
        Gate::authorize('modify', $password);

        // Validate
        $fields = $request->validate([
            'loginname'=> ['required','max:255'],
            'email'=> ['required','max:255'],
            'password'=> ['required','min:3'],
            'note'=>['max:2000'],
        ]);

        // Update
        $password->update($fields);

        // Redirect
        return redirect()->route('passwords.index')->with('success','Your login was updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Password $password)
    {
        Gate::authorize('modify', $password);

        // Delete password
        $password->delete();

        return back()->with('delete','Your login was deleted.');
    }

}
