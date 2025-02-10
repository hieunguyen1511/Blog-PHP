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

class RegisterController extends Controller{
    public function register(){
        $category = new Category();
        return view('register', ['category' => Category::all()]);
    }
    public function registerUser(Request $request){
        $request->validate([
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->full_name = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        try {
            $user->save();
            return redirect()->route('login')->with('successCreateAccount', __('language.success_register'));
        } catch (\Exception $e) {
            return redirect()->back()->with('errorAccount1', __('language.error_user_email'));
        }
    }
}