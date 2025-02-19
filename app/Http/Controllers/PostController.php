<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller{
    public function index(){
        $post = DB::table('post')->where('id', 1)->first();
        return view('post', ['post' => $post]);
    }
    
    public function indexAdmin(){
        return view('post.index');
    }

    public function getAll(){
        $posts = Post::all();
        return response()->json([
            'status' => '200',
            'posts' => $posts
        ]);
    }

    public function get($id){
        $post = Post::find($id);
        return response()->json([
            'status' => '200',
            'post' => $post
        ]
        );
    }

    public function delete(Request $request)
    {
        $post = Post::find($request->id);

        if (!$post) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            $post->delete();
            return response()->json([
                'status' => '200',
                'message' => __('language.deleted_item_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.delete_item_fail')
            ], 500);
        }
    }


    public function deleteItems(Request $request)
    {
        if (!isset($request->ids) || count($request->ids) === 0) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            Post::whereIn('id', $request->ids)->delete();

            return response()->json([
                'status' => '200',
                'message' => __('language.deleted_items_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.delete_items_fail')
            ], 500);
        }
    }
}
?>