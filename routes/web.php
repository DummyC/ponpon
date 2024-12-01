<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'main.home')->name('home');

Route::view('/register', 'auth.register')->name('register');

Route::view('/login', 'auth.login')->name('login');
