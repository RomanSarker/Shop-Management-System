<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    function AddCategory(Request $request){
       $name= $request->input('name');
       $imagePath= $request->file('image')->store('public');
       $code= time();
       $result= CategoryModel::insert(['cat_name'=>$name, 'cat_code'=>$code, 'cat_icon'=>$imagePath]);
       return $result;
    }

    function DeleteCategory(Request $request){
        $id= $request->id;
        $cat_icon= CategoryModel::Where('id',$id)->get(['cat_icon']);
        Storage::delete($cat_icon[0]['cat_icon']);
        $result=CategoryModel::Where('id', $id)->delete();
        return  $result;
    }

    function SelectCategory(){
        $result= CategoryModel::all();
        return $result;
    }


    function UpdateCategoryWithImage(Request $request){
        $id= $request->input('id');

        // Old Image Delete
        $cat_icon= CategoryModel::Where('id',$id)->get(['cat_icon']);
        Storage::delete($cat_icon[0]['cat_icon']);

        // New Image Upload
        $imagePath= $request->file('image')->store('public');


        $name= $request->input('name');

        $result= CategoryModel::Where('id', $id)->update(['cat_name'=>$name,'cat_icon'=>$imagePath]);

        return $result;

    }


    function UpdateCategoryWithoutImage(Request $request){
        $id= $request->input('id');
        $name= $request->input('name');
        $result= CategoryModel::Where('id', $id)->update(['cat_name'=>$name]);
        return $result;
    }



}
