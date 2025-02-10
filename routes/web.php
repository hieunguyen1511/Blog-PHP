<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

// page Register
Route::get('/register', [RegisterController::class, 'register']) -> name('register');
Route::post('/register', [RegisterController::class, 'registerUser']) -> name('registerUser');


// page Login
Route::get('/login', [LoginController::class, 'login']) -> name('login');
Route::post('/login', [LoginController::class, 'loginUser']) -> name('loginUser');
