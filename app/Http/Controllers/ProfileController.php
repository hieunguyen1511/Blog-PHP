<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller{
    public function index($id) {
        $user = User::find($id);
        $user->makeHidden(['password']);
        return view('profile.index')->with('user', $user);
        
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($request -> id);
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->date = $request->date;
        $user->bio = $request->bio;
        if ($request->profile_picture != null) {
            $user->profile_picture = $request->profile_picture;
        }
        if ($request->cover_photo != null) {
            $user->cover_photo = $request->cover_photo;
        }
        if ($request->new_password) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
            }
            else {
                return response()->json([
                    'status' => '500',
                    'message' => __('language.error_wrong_password'),
                ]);
            }
        }


        try {
            $user->update();
            return response()->json([
                'status' => '200',
                'message' => __('language.success_save_profile')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => '500',
                'message' => __('language.fail_save_profile')
            ]);
        }
    }
}