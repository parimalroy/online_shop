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
    public function index(Request $request){
        $subcategories=SubCategory::with('category')->latest();
        if(!empty($request->keyword)){
            $subcategories->where('name','like','%'.$request->keyword.'%');
        }
        $subcategories=$subcategories->paginate(8);
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
        'slug'=>'required|unique:sub_categories|min:3|max:255',
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

   //This method Edit sub category
   public function edit($id){
    $categorieList=SubCategory::with('category')->get();
    $subcategory=SubCategory::findOrFail($id);
    return view('backend.subcategory.edit',['subcategory'=>$subcategory,'categorieList'=>$categorieList]);
   }

   //This Method update subcategory

   public function update(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required|min:3|max:255',
        'slug'=>'required|unique:sub_categories|min:3|max:255',
        'status'=>'required'
    ]);

    if($validator->passes()){
        SubCategory::find($request->id)->update([
            'name'=>$request->name,
            'slug'=>$request->slug,
            'status'=>$request->status,
            'categorie_id'=>$request->categorie_id,
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'sub-category update successfully !'
        ]);
    }else{
        return response()->json([
            'status'=>false,
            'errors'=>$validator->errors(),
        ]);
    }
   }

   //This method delete subcategory
   public function delete($id){
    $subcategory=SubCategory::find($id)->delete();
    if($subcategory){
        return response()->json([
            'status'=>true,
            'message'=>'sub-category deleted!'
        ]);
    }
   }
}
