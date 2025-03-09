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

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $username = $request->input('username');
        $password = $request->input('password');
        $data = DB::table('user')->where('username', $username)
            ->orWhere('email', $username)
            ->first();

        if ($data) {
            if (Hash::check($password, $data->password)) {
                $user = [
                    'username' => $data->username,
                    'email' => $data->email,
                    'date' => $data->date,
                    'bio' => $data->bio,
                    'full_name' => $data->full_name,
                    'profile_picture' => $data->profile_picture,
                    'cover_photo' => $data->cover_photo,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at
                ];
                $request->session()->put('userid', $data->id);
                $request->session()->put('user', $user);
                if (!session('previous_url') || $request -> role == User::$role_admin) {
                    return redirect()->route('dashboard.index');
                }
                else {
                    return redirect()->to(session('previous_url'));
                }
            } else {
                return redirect()->back()->with('errorLogin1', __('language.error_login'))->withInput($request->except('password'));
            }
        } else {
            return redirect()->back()->with('errorLogin1', __('language.error_login'))->withInput($request->except('password'));
        }
    }
   
}
