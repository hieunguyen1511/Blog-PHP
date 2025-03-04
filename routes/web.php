<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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
    Route::get('/', function () {
        return view('home');
    }) -> name('home');
    
    Route::get('/about', function () {
        return view('about');
    });
    
    // page Register
    Route::get('/register', [RegisterController::class, 'register']) -> name('register');
    Route::post('/register', [RegisterController::class, 'registerUser']) -> name('registerUser');
    
    
    // page Login
    Route::get('/login', [LoginController::class, 'login']) -> name('login');
    Route::post('/login', [LoginController::class, 'loginUser']) -> name('loginUser');
    
    
    // page Home
    Route::get('/home', function () {
        return view('home');
    });

    Route::group(['prefix' => 'laravel-filemanager', 'middleware'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    
    Route::get('/create-post', [UserController::class, 'create_post']) ->middleware(checkLogin::class) -> name('create_post');
    
    Route::post('/create-post', [UserController::class, 'create_post_submit']) -> name('create_post_submit');
    
    
    Route::get('/post', [PostController::class, 'index']) -> name('post');
    
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