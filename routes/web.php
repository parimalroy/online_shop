<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\BrandController;
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

        // category route
        Route::get('admin/categorie',[CategoryController::class,'create'])->name('category.create');
        Route::post('admin/categorie',[CategoryController::class,'store'])->name('category.store');
        Route::get('admin/index',[CategoryController::class,'index'])->name('category.index');
        Route::get('admin/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::post('admin/category/update',[CategoryController::class,'update'])->name('category.update');
        Route::delete('admin/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

        Route::get('getslug',[CategoryController::class,'slug'])->name('getslug');

        // subcategory route
        Route::get('admin/sub-category/index',[SubCategoryController::class,'index'])->name('subcategory.index');
        Route::get('admin/sub-category',[SubCategoryController::class,'create'])->name('subcategory.create');
        Route::post('admin/sub-category/store',[SubCategoryController::class,'store'])->name('subcategory.store');
        Route::get('admin/sub-category/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
        Route::post('admin/sub-category/update',[SubCategoryController::class,'update'])->name('subcategory.update');
        Route::delete('admin/sub-category/delete/{id}',[SubCategoryController::class,'delete'])->name('subcategory.delete');


        Route::get('admin/brand/index',[BrandController::class,'index'])->name('brand.index');
        Route::get('admin/brand/create',[BrandController::class,'create'])->name('brand.create');
        Route::post('admin/brand/store',[BrandController::class,'store'])->name('brand.store');
        Route::get('admin/brand/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
        Route::post('admin/brand/update',[BrandController::class,'update'])->name('brand.update');
        Route::delete('admin/brand/delete/{id}',[BrandController::class,'delete'])->name('brand.delete');
     
        
        
    });
});


