<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller{
    public function index(){
        $post = DB::table('post')->where('id', 1)->first();
        return view('post', ['post' => $post]);
    }
    public function getAll(){
        $posts = Post::all();
        return response()->json([
            'status' => '200',
            'posts' => $posts
        ]);
    }
}
?>