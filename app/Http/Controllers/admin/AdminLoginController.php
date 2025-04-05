<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    //This method show login page

    public function index(){
        return view('Backend.admin.login');
    }

    //This method check admin authontication

    public function login(Request $request){
       $request->validate([
        'email'=>'required|email',
        'password'=>'required'
       ]);

       if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        return redirect()->route('admin.dashboard');
       }else{
        return redirect()->route('admin.index')->with('error','Cedentials not match !')->withInput();
       }
    }

    //This method logout admin
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.index')->with('success','Logout successfully');
    }
}
