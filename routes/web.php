<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkLogin;
use App\Http\Middleware\getNoti;
use App\Http\Middleware\localization;
use Illuminate\Support\Facades\Session;



Route::middleware(localization::class)->group(function () {






    Route::middleware(getNoti::class)->group(function () {
        Route::get('/', [HomeController::class, 'index']);
        // page Home
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        // post by category
        Route::get('/category/{link}', [HomeController::class, 'post_category'])->name('category.post');
        //Post link
        Route::get('/post/{link}', [HomeController::class, 'post'])->name('post-detail');
        //search key
        Route::post('/search', [HomeController::class, 'search_post'])->name('search');
         //user-profile
        Route::get('/user/v/{username}', [HomeController::class, 'get_profile'])->name('get-profile');

        Route::middleware(checkLogin::class)->group(function () {
            Route::get('/create-post', [UserController::class, 'create_post'])->name('create_post');
            Route::post('/create-post', [UserController::class, 'create_post_submit'])->name('create_post_submit');
            Route::get('/edit-post/{id}', [UserController::class, 'edit_post'])->name('edit_post');
            Route::post('/edit-post/{id}', [UserController::class, 'edit_post_submit'])->name('edit_post_submit');
            Route::post('/delete-post', [UserController::class, 'delete_post'])->name('delete_post');

            //User setting
            Route::get('/user/settings', [UserController::class, 'setting'])->name('setting');
            //Route web
            Route::get('/user/settings/edit-profile', [UserController::class, 'edit_profile'])->name('edit_profile');
            Route::post('/user/settings/edit-profile', [UserController::class, 'edit_profile_submit'])->name('edit_profile_submit');
            Route::get('/user/settings/change-password', [UserController::class, 'change_password'])->name('change_password');
            Route::post('/user/settings/change-password', [UserController::class, 'change_password_submit'])->name('change_password_submit');
            Route::get('/user/settings/media-resource', [UserController::class, 'media_resource'])->name('media_resource');
            Route::get('/user/settings/my-post', [UserController::class, 'my_post'])->name('my_post');
            Route::post('/user/settings/my-post', [UserController::class, 'my_post'])->name('my_post_submit');

            Route::get('/user/settings/favorite-post', [UserController::class, 'favorite_post'])->name('favorite_post');
            Route::get('/user/settings/notifications', [UserController::class, 'post_notification'])->name('post_notification');

            //Route api
            Route::get('/user/edit-profile', [UserController::class, 'partial_edit_profile'])->name('partial_edit_profile');
            Route::post('post/comment', [HomeController::class, 'post_comment'])->name('post_comment');
            //Route::get('/post/{post_id}/like', [HomeController::class, 'like_post'])->name('post_like');
            Route::get('/api/my_post/{query}', [UserController::class, 'api_my_post'])->name('api_my_post');


            //process notification
            Route::post('/process_noti_comment', [UserController::class, 'process_noti_comment'])->name('process_noti_comment');
            Route::post('/process_noti_like', [UserController::class, 'process_noti_like'])->name('process_noti_like');
        });

       
        Route::get('/post/{post_id}/like', [HomeController::class, 'like_post'])->name('post_like');
        Route::get('/post', [PostController::class, 'index'])->name('post');
    });



    Route::get('/about', function () {
        return view('about');
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




    Route::get('/logout', function () {
        session()->forget('userid');
        session()->forget('user');
        session()->forget('previous_url');
        return redirect()->route('home');
    })->name('logout');



   
    // change language
    Route::get('/lang/{language}', function () {
        $language = request()->language;
        Session::put('language', $language);
        return redirect()->back();
    });
});
//api
Route::get('/api/search/{key}', [HomeController::class, 'search']);
