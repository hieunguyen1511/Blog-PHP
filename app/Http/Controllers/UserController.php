<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLikes;
use App\Models\User;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('info');
    }
    
    //trang chủ cho quản trị (bảng dữ liệu)
    public function indexAdmin(){
        return view('user.index');
    }

    public function create_post()
    {
        return view('create_post');
    }
    public function create_post_submit(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'description' => 'required'
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->user_id = session('userid');
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->description = $request->description;
        $post->like_count = 0;
        $post->view_count = 0;

        $link = Str::slug($request->title);
        $link = $link . '-' . Str::random(10);
        $post->link = $link;

        $post->save();

        return redirect()->route('post-detail', ['link' => $link]);
    }

    public function edit_post($id)
    {
        $post = Post::find($id);
        return view('edit_post', ['post' => $post]);
    }
    public function edit_post_submit($id,Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'description' => 'required'
        ]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('my_post')->with('edit_post_success', __('language.setting_edit_post_alert_success'));
    }

    public function delete_post(Request $request)
    {
        $id = $request->post_id;
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('my_post')->with('delete_post_success', __('language.setting_my_post_alert_delete_success'));
    }

    //API lấy bảng dữ liệu
    public function getAll(){
        $users = User::where('role', '!=', User::$role_admin)->get();
        return response()->json([
            'status' => '200',
            'users' => $users
        ]
        );
    }

    //API lấy dữ liệu cụ thể
    public function get(Request $request){
        $user = User::find($request->id);
        return response()->json([
            'status' => '200',
            'user' => $user
        ]
        );
    }

    //Cập nhật dữ liệu
    public function update(Request $request){
        
        $request->validate([
            'full_name' => 'required',
        ]);

        $user = User::find($request->id);
        if (!$user) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }
        if ($request->new_password != null) {
            $user->password = Hash::make($request->new_password);
        }
        $user -> full_name = $request->full_name;
        $user->date = $request -> date;
        
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        if ($request->profile_picture != null) {
            $user->profile_picture = $request->profile_picture;
        }
        if ($request->cover_photo != null) {
            $user->cover_photo = $request->cover_photo;
        }
        $user->full_name = $request->full_name;
        try {
            
            $user->save();
            return response()->json([
                'status' => '200',
                'message' => __('language.updated_item_success')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __($e)
            ], 500);
        }
    }

    //Xóa 1 dòng dữ liệu
    public function delete(Request $request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return response()->json([
                'status' => '400',
                'message' => __('language.error_no_item_selected')
            ], 400);
        }

        try {
            $user->delete();
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
            User::whereIn('id', $request->ids)->delete();

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

    public function setting()
    {
        $user = User::withCount('posts')->find(session('userid'));
        return view('user_setting.setting', ['user' => $user]);
    }

    public function partial_edit_profile()
    {
        return view('user_setting.partial_edit_profile');
    }
    public function edit_profile()
    {
        $user = User::find(session('userid'));
        session()->forget('user');
        session()->put('user', $user);
        return view('user_setting.setting', [
            'user' => $user,
            'section' => 'partial_edit_profile'
        ]);
    }

    public function edit_profile_submit(Request $request)
    {
        $user = User::find(session('userid'));
        $user->full_name = $request->full_name;
        $user->bio = $request->bio;
        $user->phone = $request->phone;
        $user->profile_picture = $request->profile_photo_url;
        $user->cover_photo = $request->cover_photo_url;

        $date = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');
        $user->date = $date;

        $user->save();

        return redirect()->route('edit_profile')->with('edit_profile_success', __('language.setting_edit_profile_success_noti'));
    }


    public function change_password()
    {
        return view('user_setting.setting', [
            'user' => User::find(session('userid')),
            'section' => 'partial_change_password'
        ]);
    }
    public function change_password_submit(Request $request)
    {
        $new_password = $request->new_password;
        $old_password = $request->current_password;
        $user = User::find(session('userid'));
        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
            $user->save();
            session()->forget('user');
            session()->forget('userid');
            return redirect()->route('login')->with('change_password_success', __('language.setting_change_password_success_noti'));
        } else {
            return redirect()->route('change_password')->with('change_password_error', __('language.setting_change_password_alert_current_password'));
        }
    }

    public function media_resource()
    {
        return view('user_setting.setting', [
            'section' => 'partial_media_resource',
        ]);
    }

    public function my_post(Request $request)
    {
        $posts = Post::where('user_id', session('userid'))->paginate(20);
        $total_like = 0;
        foreach ($posts as $post) {
            $total_like += $post->likes->count();
        }
        $total_category = [];
        foreach ($posts as $post) {
            if (!in_array($post->category->id, array_column($total_category, 'id'))) {
                array_push($total_category, [
                    'id' => $post->category->id,
                    'name' => $post->category->name
                ]);
            }
        }
        $total_post = $posts->count();
        $total_view = $posts->sum('view_count');
        if($request->has('searchInput')){
            $posts = Post::where('user_id', session('userid'))->where('title', 'like', '%'.$request->searchInput.'%')->paginate(20);
        }
        
        return view('user_setting.setting', [
            'section' => 'partial_post_management',
            'posts' => $posts,
            'total_like' => $total_like,
            'total_category' => $total_category,
            'total_post' => $total_post,
            'total_view' => $total_view
        ]);
    }

    public function api_my_post($query)
    {
        $posts = Post::where('user_id', session('userid'))->where('title', 'like', '%'.$query.'%')->get();
        return response()->json(
            [
                'status' => '200',
                'posts' => $posts
            ]
        );
    }

    public function favorite_post(){
        $user = User::find(session('userid'));
        $like_posts = PostLikes::with('post')->where('user_id', session('userid'))->paginate(20);
        $total_category = [];
        foreach ($like_posts as $item) {
            $post = Post::with('category')->find($item->post_id);
            if (!in_array($post->category->id, array_column($total_category, 'id'))) {
                array_push($total_category, [
                    'id' => $post->category->id,
                    'name' => $post->category->name
                ]);
            }
        }
        return view('user_setting.setting', [
            'section' => 'partial_favorite_post',
            'like_posts' => $like_posts,
            'total_category' => $total_category
        ]);
    }


    public function post_notification(Request $request)
    {
        $noti_comments_seen = Comment::with('post')->with('user')->whereHas('post', function ($query) {
            $query->where('user_id', session('userid'));
        })->paginate(25);
        $noti_likes_seen = PostLikes::with('post')->with('user')->whereHas('post', function ($query) {
            $query->where('user_id', session('userid'));
        })->paginate(25);
     
        if($request->ajax()){
            return response()->json([
                'status' => '200',
                'noti_comments_seen' => $noti_comments_seen,
                'noti_likes_seen' => $noti_likes_seen
            ]);
        }

        return view('user_setting.setting', [
            'section' => 'partial_post_noti',
            'noti_comments_seen' => $noti_comments_seen,
            'noti_likes_seen' => $noti_likes_seen
        ]);
    }


    public function process_noti_comment(Request $request){
        $comment = Comment::find($request->cmt_id);
        $comment->is_seen = 1;
        $comment->save();
        return redirect()->route('post-detail', ['link' => $comment->post->link]);

    }

    public function process_noti_like(Request $request){
        $likePost = PostLikes::find($request->like_id);
        $likePost->is_seen = 1;
        $likePost->save();
        return redirect()->route('post-detail', ['link' => $likePost->post->link]);
    }

    
}
?>
