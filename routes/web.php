<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\AdminLoginController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('account/login',[AdminLoginController::class,'index'])->name('admin.index');
// Route::post('account/admin/login',[AdminLoginController::class,'login'])->name('admin.login');
// Route::get('account/admin/dashboard',[HomeController::class,'index'])->name('admin.dashboard');

Route::group(['prefix'=>'account'],function(){
    Route::group(['middleware'=>'guest'],function(){
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.index');
        Route::post('admin/login',[AdminLoginController::class,'login'])->name('admin.login');
    });

    Route::group(['middleware'=>'auth'],function(){
        Route::get('dashboard',[HomeController::class,'index'])->name('admin.dashboard');

        Route::get('admin/logout',[AdminLoginController::class,'logout'])->name('admin.logout');
    });
});


