<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\App;

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
        $fullname = $request->input('fullname');
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        
        if(DB::insert('insert into users (fullname, username, email, password) values(?, ?, ?, ?)', [$fullname, $username, $email, $password])){
            return redirect()->route('registerUser')->with('success', 'Registered successfully');
        }
        //session()->put('testSession', $request->input('fullname'));
        return view ('register');
    }
}