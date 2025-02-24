<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\PostLikes;

class HomeController extends Controller
{

    public function index(){
        $posts = Post::with('user')->with('category')->paginate(1);
        //take 5 most popular category
        $popular_category = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $suggested_post = Post::with('user')->with('category')->orderBy('view_count', 'desc')->take(5)->get();
        $recommended_users = User::with('posts')->withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        return view('home', ['posts' => $posts, 
                             'popular_category' => $popular_category,
                             'suggested_post' => $suggested_post,
                             'recommended_users' => $recommended_users]);
                            
    }


    public function post_category($link){
        $category = Category::where('link', $link)->first();
        $posts = Post::with('user')->with('category')->where('category_id',$category->id)->paginate(10);
        $popular_category = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $suggested_post = Post::with('user')->with('category')->orderBy('view_count', 'desc')->take(5)->get();
        $recommended_users = User::with('posts')->withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        return view('home', ['posts' => $posts, 
                             'popular_category' => $popular_category,
                             'suggested_post' => $suggested_post,
                             'recommended_users' => $recommended_users]);
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


    public function get_profile($username){
        $user = User::with('posts')->where('username',$username)->first();
        $posts = Post::where('user_id',$user->id)->paginate(10);
        return view('userprofile',['user'=>$user,'posts'=>$posts]);
    }



    //Post
    public function post($link,Request $request){
       
        $post = Post::where('link', $link)->first();
        $comments = Comment::with('user')->where('post_id', $post->id)->orderBy('created_at','desc')->paginate(10);
        
        if($request->ajax()){
            return response()->json([
                'status' => '200',
                'comments' => $comments,
            ]);
        }

        $is_like = false;

        if(session('userid') != null){
            $post->view_count = $post->view_count + 1;
            $post->save();
            $like = PostLikes::where('user_id', session('userid'))->where('post_id', $post->id)->first();
            if($like != null){
                $is_like = true;
            }
        }

        
        $related_posts = Post::with('user')->with('category')->with('comments')->where('category_id', $post->category_id)->where('id', '!=', $post->id)->orderBy('view_count', 'desc')->take(5)->get();
        return view('post', ['post' => $post,'comments' => $comments, 'related_posts' => $related_posts, 'is_like' => $is_like]);
    }

    public function post_comment(Request $request){
        $request->validate([
            'content' => 'required',
        ]);
        $comment = new Comment();
        $comment->user_id = session('userid');
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->save();
        return redirect()->back();
    }


    public function search_post(Request $request){
        $search = $request->search;
        $posts = Post::with('user')->with('category')->where('title', 'like', '%'.$search.'%')->paginate(10);
        $popular_category = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $suggested_post = Post::with('user')->with('category')->orderBy('view_count', 'desc')->take(5)->get();
        $recommended_users = User::with('posts')->withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        return view('home', ['posts' => $posts, 
                             'popular_category' => $popular_category,
                             'suggested_post' => $suggested_post,
                             'recommended_users' => $recommended_users]);   
    }



}
