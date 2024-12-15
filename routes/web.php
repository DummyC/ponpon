<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Route;





// Auth Group
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->middleware('verified')->name('dashboard');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::redirect("/","passwords");
    Route::redirect("/dashboard","passwords");

    Route::redirect('/admin', 'admin/dashboard');

    Route::resource('passwords', PasswordController::class);
    Route::resource('admin/users', UserController::class);

    Route::get('/settings', [AuthController::class, 'settings'])->name('settings');

    Route::post('/settings/update-password', [AuthController::class, 'updatePassword'])->name('auth.update-password');

    // Operations
    Route::view('/add','ops.add')->name('add');

    // Email Verification Notice
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');

    // Email Verification Handler route
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');

    // Resend Verification Email
    Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])->middleware('throttle:6,1')->name('verification.send');

    Route::get('/admin/dashboard', [UserController::class, 'index'])->middleware(EnsureAdmin::class)->name('admin.dashboard');
});

// Guest Group
Route::middleware('guest')->group(function () {
    Route::view('/', 'main.landing')->name('landing');

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class,'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class,'login']);

    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');

    Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail']);

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});



