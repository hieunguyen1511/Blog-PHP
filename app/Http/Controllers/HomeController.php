<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
class HomeController extends Controller
{
    public function index(){
        return view('home', ['posts' => Post::with('user')->with('category')->paginate(10)]);
    }


    public function post_category($name){
        $category = Category::where('name', $name)->first();
        $posts = DB::table('post')->where('id', $category->id)->first();
        return view('post', ['post' => $posts]);
    }


    public function post($link){
        $post = Post::where('link', $link)->first();
        if(session('userid') != null){
            $post->view_count = $post->view_count + 1;
            $post->save();
        }
        return view('post', ['post' => $post]);
    }


}
