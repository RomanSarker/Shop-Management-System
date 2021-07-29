<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function AddProduct(Request $request){
        $product_name= $request->input('product_name');
        $product_code= time();
        $product_price=  $request->input('product_price');
        $product_category= $request->input('product_category');
        $product_remarks= $request->input('product_remarks');
        $product_icon= $request->file('product_icon')->store('public');
        $result=ProductModel::insert([
            "product_name"=>$product_name,
            "product_code "=>$product_code,
            "product_icon"=>$product_icon,
            "product_price"=>$product_price,
            "product_category"=>$product_category,
            "product_remarks"=>$product_remarks,
        ]);
        return $result;
    }

    function DeleteProduct(Request $request){
        $id= $request->id;
        $product_icon= ProductModel::Where('id',$id)->get(['product_icon']);
        Storage::delete($product_icon[0]['product_icon']);
        $result=ProductModel::Where('id', $id)->delete();
        return  $result;
    }

    function SelectProduct(){
        $result= ProductModel::all();
        return $result;
    }


    function SelectProductByCategory(Request $request){
        $Category= $request->Category;
        $result= ProductModel::Where('product_category',$Category)->get();
        return $result;
    }

    function UpdateProductWithImage(Request $request){
        $id= $request->input('id');

        // Old Image Delete
        $product_icon= ProductModel::Where('id',$id)->get(['product_icon']);
        Storage::delete($product_icon[0]['product_icon']);

        // New Image Upload
        $product_icon= $request->file('product_icon')->store('public');
        $product_name= $request->input('product_name');
        $product_price=  $request->input('product_price');
        $product_category= $request->input('product_category');
        $product_remarks= $request->input('product_remarks');

        $result= ProductModel::Where('id', $id)->update([
            "product_name"=>$product_name,
            "product_icon"=>$product_icon,
            "product_price"=>$product_price,
            "product_category"=>$product_category,
            "product_remarks"=>$product_remarks,
        ]);

        return $result;

    }

    function UpdateProductWithoutImage(Request $request){
        $id= $request->input('id');
        $product_name= $request->input('product_name');
        $product_price=  $request->input('product_price');
        $product_category= $request->input('product_category');
        $product_remarks= $request->input('product_remarks');

        $result= ProductModel::Where('id', $id)->update([
            "product_name"=>$product_name,
            "product_price"=>$product_price,
            "product_category"=>$product_category,
            "product_remarks"=>$product_remarks,
        ]);
        return $result;
    }

}
