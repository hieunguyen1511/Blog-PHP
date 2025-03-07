<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationTypeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SeenNotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\changeLanguage;
use App\Http\Middleware\localization;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
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
    Route::get('/register', [RegisterController::class, 'register']) -> name('register');
    Route::post('/register', [RegisterController::class, 'registerUser']) -> name('registerUser');
    
    
    // page Login
    Route::get('/login', [LoginController::class, 'login']) -> name('login');
    Route::post('/login', [LoginController::class, 'loginUser']) -> name('loginUser');
    

    Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    
    Route::middleware(checkLogin::class)->group(function(){
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



        //Route api
        Route::get('/user/edit-profile', [UserController::class, 'partial_edit_profile'])->name('partial_edit_profile');

        Route::post('post/comment', [HomeController::class, 'post_comment'])->name('post_comment');

        //Route::get('/post/{post_id}/like', [HomeController::class, 'like_post'])->name('post_like');

        Route::get('/api/my_post/{query}', [UserController::class, 'api_my_post'])->name('api_my_post');


    });
    Route::get('/post/{post_id}/like', [HomeController::class, 'like_post'])->name('post_like');
    
    Route::get('/post', [PostController::class, 'index'])->name('post');

    
    
    
    // post by category
    Route::get('/category/{link}', [HomeController::class, 'post_category']) -> name('category.post');
    
    Route::get('/lang/{language}', function () {
        $language = request()->language;
        Session::put('language', $language);
        return redirect()->back();
    });


    //Post link
    Route::get('/post/{link}', [HomeController::class, 'post'])->name('post-detail');


    //search key
    Route::post('/search', [HomeController::class, 'search_post'])->name('search');


    //user-profile
    Route::get('/user/v/{username}',[HomeController::class,'get_profile'])-> name('get-profile');
    
    Route::middleware(checkLogin::class) -> prefix('/admin') -> group(function() {
        //Page Dashboard
        Route::get('', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/dashboard/get-total-users', [DashboardController::class, 'getTotalUsers'])->name('dashboard.getTotalUsers');
        Route::get('/dashboard/get-total-posts', [DashboardController::class, 'getTotalPosts'])->name('dashboard.getTotalPosts');
        Route::get('/dashboard/get-total-views', [DashboardController::class, 'getTotalViews'])->name('dashboard.getTotalViews');
    
        Route::get('/dashboard/get-total-comments', [DashboardController::class, 'getTotalComments'])->name('dashboard.getTotalComments');
        Route::get('/dashboard/get-published-posts-statistics', [DashboardController::class, 'getPublishedPostsStatistics'])->name('dashboard.getPublishedPostsStatistics');
        Route::get('/dashboard/get-lastest-posts', [DashboardController::class, 'getLastestPost'])->name('dashboard.getLastestPost');
        Route::post('/dashboard/get-load-more-post', [DashboardController::class, 'getLoadMorePost'])->name('dashboard.getLoadMorePost');
    
        // page Category admin
        Route::get('/category', [CategoryController::class, 'index'])->name('category.indexAdmin');
        Route::get('/category/data', [CategoryController::class, 'getAll']) -> name('category.getAll');
        Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
        Route::post('/category/delete-items', [CategoryController::class, 'deleteItems'])->name('category.deleteItems');
        Route::get('/category/{id}', [CategoryController::class, 'get'])->name('category.get');
        Route::post('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
        
        // page Post admin
        Route::get('/post', [PostController::class, 'indexAdmin'])->name('post.indexAdmin');
        Route::get('/post/data', [PostController::class, 'getAll']) -> name('post.getAll');
        Route::delete('/post/{id}/delete', [PostController::class, 'delete'])->name('post.delete');
        Route::post('/post/delete-items', [PostController::class, 'deleteItems'])->name('post.deleteItems');
        Route::get('/post/{id}', [PostController::class, 'get'])->name('post.get');
        Route::post('/post/get-load-more-comments', [PostController::class, 'getLoadMoreComments'])->name('post.getLoadMoreComments');
        Route::delete('/post/{id}/delete-comment', [PostController::class, 'deleteComment'])->name('post.deleteComment');
        
        //page User admin
        Route::get('/user', [UserController::class, 'indexAdmin'])->name('user.indexAdmin');
        Route::get('/user/data', [UserController::class, 'getAll']) -> name('user.getAll');
        Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::post('/user/delete-items', [UserController::class, 'deleteItems'])->name('user.deleteItems');
        Route::get('/user/{id}', [UserController::class, 'get'])->name('user.get');
        
        //Page Setting admin
        
        Route::get('/setting', [SettingController::class, 'setting'])->name('setting.index');
        Route::post('/setting/update', [SettingController::class, 'update'])->name('setting.update');

        //Page Profile
        Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
        

    });

    Route::get('/logout', function () {
        session()->forget('userid');
        session()->forget('user');
        session()->forget('previous_url');
        return redirect()->route('home');
    })->name('logout');
    
    Route::get('/lang/{language}', function () {
        $language = request()->language;
        Session::put('language', $language);
        return redirect()->back();
    }) -> name('change-language');

});


//api
Route::get('/api/search/{key}', [HomeController::class, 'search']);