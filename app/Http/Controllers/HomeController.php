<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
class HomeController extends Controller
{

    public function index(){
        $posts = Post::with('user')->with('category')->paginate(10);
        //take 5 most popular category
        $popular_category = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $suggested_post = Post::with('user')->with('category')->orderBy('view_count', 'desc')->take(5)->get();
        return view('home', ['posts' => $posts, 
                             'popular_category' => $popular_category,
                             'suggested_post' => $suggested_post]);
    }


    public function post_category($link){
        $category = Category::where('link', $link)->first();
        $posts = Post::with('user')->with('category')->where('category_id',$category->id)->paginate(10);
        $popular_category = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $suggested_post = Post::with('user')->with('category')->orderBy('view_count', 'desc')->take(5)->get();
        return view('home', ['posts' => $posts, 
                             'popular_category' => $popular_category,
                             'suggested_post' => $suggested_post]);
    }


    public function post($link){
        $post = Post::where('link', $link)->first();
        if(session('userid') != null){
            $post->view_count = $post->view_count + 1;
            $post->save();
        }
        return view('post', ['post' => $post]);
    }


    public function search_post(Request $request){
        $search = $request->search;
        $posts = Post::with('user')->with('category')->where('title', 'like', '%'.$search.'%')->paginate(10);
        $popular_category = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $suggested_post = Post::with('user')->with('category')->orderBy('view_count', 'desc')->take(5)->get();
        return view('home', ['posts' => $posts, 
                             'popular_category' => $popular_category,
                             'suggested_post' => $suggested_post]);
    }

    public function search($key){
        $search = $key;
        $posts = Post::select('title','link','description')->where('title', 'like', '%'.$search.'%')->take(5)->get();
        $categories = Category::select('name','link')->where('name', 'like', '%'.$search.'%')->take(5)->get();
        return response()->json([
            'status' => '200',
            'posts' => $posts,
            'categories' => $categories
        ]);
    }


}
