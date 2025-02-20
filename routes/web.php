<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\changeLanguage;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('home');
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


// page Home
Route::get('/home', function () {
    return view('home');
});

Route::get('/create-post', [UserController::class, 'create_post']) ->middleware(checkLogin::class) -> name('create_post');

Route::post('/create-post', [UserController::class, 'create_post_submit']) -> name('create_post_submit');



Route::get('/post', [PostController::class, 'index']) -> name('post');



Route::get('/logout', function(){
    session()->forget('userid');
    return redirect()->route('home');
}) -> name('logout');    



Route::get('/test2', function () {
    return view('test2');
});


// page Category admin
Route::get('/admin/category', [CategoryController::class, 'index'])->name('category.indexAdmin');
Route::get('/category/data', [CategoryController::class, 'getAll']) -> name('category.getAll');
Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::delete('/category/{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
Route::post('/category/delete-items', [CategoryController::class, 'deleteItems'])->name('category.deleteItems');
Route::get('/category/{id}', [CategoryController::class, 'get'])->name('category.get');
Route::post('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');


// page Post admin
Route::get('/admin/post', [PostController::class, 'indexAdmin'])->name('post.indexAdmin');
Route::get('/post/data', [PostController::class, 'getAll']) -> name('post.getAll');
Route::delete('/post/{id}/delete', [PostController::class, 'delete'])->name('post.delete');
Route::post('/post/delete-items', [PostController::class, 'deleteItems'])->name('post.deleteItems');


Route::get('admin/user', [UserController::class, 'indexAdmin'])->name('user.indexAdmin');
Route::get('/user/data', [UserController::class, 'getAll']) -> name('user.getAll');
Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
Route::post('/user/delete-items', [UserController::class, 'deleteItems'])->name('user.deleteItems');
Route::get('/user/{id}', [UserController::class, 'get'])->name('user.get');


Route::post('/change-language', [LanguageController::class, 'changeLanguage']);
