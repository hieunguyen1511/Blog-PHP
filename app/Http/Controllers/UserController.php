<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller{
    public function index(){
        return view('info');
    }

    public function create_post(){
        return view('create_post');
    }
    public function create_post_submit(Request $request){
        $request->validate([
            'title' => 'required',
        ]);
        $post = new Post();

        $post->title = $request->title;
        $post->user_id = session('userid');
        $post->content = $request->content;
        $post->category_id = 1;
        $post->description = $request->title;
        $post->like_count = 0;
        $post->view_count = 0;
        $post->save();

        return redirect()->route('post');
    }


    public function getAll(){
        $users = User::all();
        return response()->json([
            'status' => '200',
            'users' => $users
        ]
        );
    }

    public function get(Request $request){
        $user = User::find($request->id);
        return response()->json([
            'status' => '200',
            'user' => $user
        ]
        );
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->date = $request->date;
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        $user->profile_picture = $request->profile_picture;
        $user->cover_photo = $request->cover_photo;
        $user->full_name = $request->full_name;
        $user->save();
        return response()->json([
            'status' => '200',
            'message' => 'User updated successfully'
        ]
        );
    }

    public function delete(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return response()->json([
            'status' => '200',
            'message' => 'User deleted successfully'
        ]
        );
    }





}
?>