<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
  //This method show catagory List
  public function index(Request $request){
    $categories=Category::latest();
    if(!empty($request->keyword)){
      $categories->where('name','like','%'.$request->keyword.'%');
    }
    $categories=$categories->paginate(10);
   return view('Backend.category.index',['categories'=>$categories]);
  }
    //This method create category 
    public function create(){
      return view('Backend.category.create');
    }

    //This metod sote Category
    public function store(Request $request){
      $validator = Validator::make($request->all(),[
        'name'=>'required| min:3|max:255',
        'slug'=>'required| max:255',
        'status'=>'required'
      ]);
      
   
     

      if($validator->passes()){

        $categorys=Category::create([
          'name'=>$request->name,
          'slug'=>$request->slug,
          'status'=>$request->status
        ]);
        return response()->json([
          'status'=>true,
          'message'=>'Category add success'
        ]);

      }else{
        return response()->json([
          'status'=>false,
          'errors'=>$validator->errors(),
        ]);
      }
    }

    public function slug(Request $request){
      $slug='';
      if(!empty($request->title)){
        $slug=Str::slug($request->title);
      }
      return response()->json([
      'status'=>true,
      'slug'=>$slug,
      ]);
    }

    //This method edit category
    public function edit($id){
      $category=Category::find($id);
      return view('Backend.category.edit',['category'=>$category]);
    }


    //This method update cateory
    public function update(Request $request){
      $validator=Validator::make($request->all(),[
        'name'=>'required|min:3|max:255',
        'slug'=>'required|max:255',
        'status'=>'required',
      ]);

      if($validator->passes()){
        Category::find($request->id)->update([
          'name'=>$request->name,
          'slug'=>$request->slug,
          'status'=>$request->status
        ]);
        return response()->json([
          'status'=>true,
          'message'=>'Category Update Success!',
        ]);
      }else{
        return response()->json([
          'status'=>false,
          'errors'=>$validator->errors()
        ]);
      }
    }
}
