<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    //This Method Show Sub Category
    public function index(){
        $subcategories=SubCategory::with('category')->get();
        return view('backend.subcategory.index',['subcategories'=>$subcategories]);
    }
    //This Method Create Sub Category
    public function create(){
        $categories=Category::orderBy('name','asc')->get();
        return view('backend.subcategory.create',['categories'=>$categories]);
    }

    //This Method store Sub Category
   public function store(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required|min:3|max:255',
        'slug'=>'required|min:3|max:255',
        'status'=>'required'
    ]);
    if($validator->passes()){
        SubCategory::create([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'status'=>$request->status,
            'categorie_id'=>$request->categorie_id
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'sub categories created successfully!',

        ]);
    }else{
        return response()->json([
            'status'=>false,
            'errors'=>$validator->errors()
        ]);
    }
   }
}
