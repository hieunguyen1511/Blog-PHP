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

class LoginController extends Controller{
    public function login(){
        return view('login');
    }
   
}