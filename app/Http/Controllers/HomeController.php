<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }


    public function post_category($name){
        $category = Category::where('name', $name)->first();
        $post = DB::table('post')->where('id', $category->id)->first();
        return view('post', ['post' => $post]);
    }

}
