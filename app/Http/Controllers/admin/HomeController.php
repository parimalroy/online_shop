<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //This method show admin dashboard

    public function index(){
        return view('Backend.admin.dashboard');
    }
}
