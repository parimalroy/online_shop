<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    //This method show Brand list
    public function index(Request $request){
        $brands=Brand::orderBy('name','ASC');
        if(!empty($request->keyword)){
            $brands->where('name','like','%'.$request->keyword.'%');
        }
        $brands=$brands->paginate(2);
        return view('backend.brand.index',['brands'=>$brands]);
    }
    //This Method create Brand
    public function create(){
        return view('backend.brand.create');
    }

    //This method store Brand
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3|max:255|unique:brands',
            'slug'=>'required|min:3|max:255|unique:brands',
            'status'=>'required'
        ]);

        if($validator->passes()){
            Brand::create([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'status'=>$request->status
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'Brand add sucessfully!'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    //This method edit brand
    public function edit($id){
        $brand=Brand::findOrFail($id);
        return view('backend.brand.edit',['brand'=>$brand]);
    }

    //This method update brand
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255',
            'status'=>'required'
        ]);
        if($validator->passes()){
            Brand::find($request->id)->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'status'=>$request->status
            ]);
            return response()->json([
                'status'=>true,
                'message'=>'Brand update sucessfully!'
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }
    }

    //This Method delete brand
    public function delete($id){
       Brand::find($id)->delete();
        
            return response()->json([
                'status'=>true,
                'message'=>"Brand Deleted",
            ]);
        
    }
}
