<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
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
use App\Http\Middleware\EnsureAdmin;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(['auth', 'verified', EnsureAdmin::class], only: ['store','index']),
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

        $users = User::where(function($query) use ($search){
            $query->where('username', 'like', "%$search%");
        })->orderBy('id')->get();

        // return view('main.home', [ 'passwords' => $passwords ]);
        return view('admin.dashboard', compact('users'));
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

    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Gate::authorize('modify', $user);

        // Delete password

        if(Auth::id() === 1){
            $user->delete();

            return back()->with('delete','Account was deleted.');
        }

        return back()->with('failed', 'Action not authorized');
    }

}
