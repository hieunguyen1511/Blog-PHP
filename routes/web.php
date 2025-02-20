<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkLogin;
use App\Http\Middleware\localization;
use Illuminate\Support\Facades\Session;



Route::middleware(localization::class)->group(function(){
    Route::get('/', [HomeController::class, 'index']);

    // page Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    
    Route::get('/about', function () {
        return view('about');
    });
    
    Route::get('/test', function () {
        return view('test');
    });
    
    
    // page Register
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'registerUser'])->name('registerUser');
    
    
    // page Login
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'loginUser'])->name('loginUser');
    
    
    
    // Route::get('/{test}', function ($test) {
    //     return view('test');
    // });
    
    
    
    Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    
    
    
    Route::get('/create-post', [UserController::class, 'create_post'])->middleware(checkLogin::class)->name('create_post');
    
    Route::post('/create-post', [UserController::class, 'create_post_submit'])->name('create_post_submit');
    
    
    
    Route::get('/post', [PostController::class, 'index'])->name('post');
    
    
    
    Route::get('/logout', function () {
        session()->forget('userid');
        session()->forget('user');
        return redirect()->route('home');
    })->name('logout');
    
    
    
    Route::get('/test2', function () {
        return view('test2');
    });
    
    
    Route::get('/test3', function () {
        return view('test3');
    });
    
    
    
    // post by category
    Route::get('/category/{name}', [HomeController::class, 'post_category']);
    
    Route::get('/lang/{language}', function () {
        $language = request()->language;
        Session::put('language', $language);
        return redirect()->back();
    });
});

