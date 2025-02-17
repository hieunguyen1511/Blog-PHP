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

class LoginController extends Controller{
    public function login(){
        return view('login');
    }
    public function loginUser(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $username = $request->input('username');
        $password = $request->input('password');
        $data = DB::table('user')->where('username', $username)
                                ->orWhere('email',$username)
                                ->first();
        
        if($data){
            if(Hash::check($password, $data->password)){
                $request->session()->put('userid', $data->id);
                return redirect('/home');
            }
            else{
                return redirect()->back()->with('errorLogin1', __('language.error_login'));
            }
        }else{
            return redirect()->back()->with('errorLogin1', __('language.error_login'));
        }
    }
   
}