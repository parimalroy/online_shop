<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\SubCategoryController;

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

        Route::get('admin/categorie',[CategoryController::class,'create'])->name('category.create');
        Route::post('admin/categorie',[CategoryController::class,'store'])->name('category.store');
        Route::get('admin/index',[CategoryController::class,'index'])->name('category.index');
        Route::get('admin/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('admin/category/update',[CategoryController::class,'update'])->name('category.update');
        Route::delete('admin/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

        Route::get('getslug',[CategoryController::class,'slug'])->name('getslug');


        Route::get('admin/sub-category/index',[SubCategoryController::class,'index'])->name('subcategory.index');
        Route::get('admin/sub-category',[SubCategoryController::class,'create'])->name('subcategory.create');
        Route::post('admin/sub-category/store',[SubCategoryController::class,'store'])->name('subcategory.store');
     
        
        
    });
});


