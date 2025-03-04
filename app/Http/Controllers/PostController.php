<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller{
    
    public function index(){
        $post = DB::table('post')->where('id', 1)->first();
        return view('post', ['post' => $post]);
    }
    
    //Trang chủ cho quản trị (bảng dữ liệu)
    public function indexAdmin(){
        return view('post.index');
    }

    //API lấy bảng dữ liệu
    public function getAll(){
        $posts = Post::with('user', 'category') -> get();
        return response()->json([
            'status' => '200',
            'posts' => $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'user' => $post->user,
                    'category_name' => $post->category->name,
                    'title' => $post->title,
                    'content' => $post->content,
                    'description' => $post->description,
                    'created_at' => $post->created_at->diffForHumans(),
                ];
            }),
        ]);
    }

    //API lấy dữ liệu cụ thể của bài đăng, kèm theo các comment với limit 4
    public function get($id){
        $limit = 4;
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)
                    ->with('user')
                    -> latest()->take($limit)->get();
        $comment_count = $post->comments()->count();
        return response()->json([
            'status' => '200',
            'post' => [
                'id' => $post->id,
                'link' => $post->link,
                'user' => $post->user,
                'category' => $post->category,
                'title' => $post->title,
                'content' => $post->content,
                'description' => $post->description,
                'like_count' => $post->like_count,
                'view_count' => $post->view_count,
                'comment_count' => $comment_count,
                'comments' => $comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'user'=>$comment->user,
                        'content' => $comment->content,
                        'created_at' => $comment->created_at->diffForHumans(),
                    ];
                }),
                'created_at' => $post->created_at->diffForHumans(),
            ],
            'has_more' => $comments->count() < $comment_count,
        ]);
    }

    //API lấy thêm các bình luận tiếp theo với limit 4
    public function getLoadMoreComments(Request $request){
        $limit = 4;
        $offset = $request->input('offset', 0);
        $comments = Comment::where('post_id', $request->postId)
                    ->with('user')
                    ->latest()
                    ->skip($offset)
                    ->take($limit)
                    ->get();
        $count = Comment::where('post_id', $request->postId)
                        ->count();
        return response()->json([
            'status' => '200',
            'comments' => $comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'user'=>$comment->user,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                ];
            }),
            'has_more' => $offset + $comments->count() < $count
        ]);
    }

    //xóa 1 dòng dữ liệu
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


    //Xóa nhiều dòng dữ liệu
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
    //Xóa 1 dòng dữ liệu bình luận
    public function deleteComment(Request $request)
    {
        $comment = Comment::find($request->id);

        if (!$comment) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            $comment->delete();
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
}
?>