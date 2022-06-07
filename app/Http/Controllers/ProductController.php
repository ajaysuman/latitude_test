<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use DB;
use File;

class ProductController extends Controller
{
    public function index(Request $request) {
   
        $editCategoryDatas = "";

        return view('dashboard.product',compact('editCategoryDatas'));
    }


    // For Product 

     public function AddProducts(Request $request) {
        try { 
           // FOr Image
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $data = $file->move('upload/product/', $fileName);
     
            // For Insert Data
            $product = new product();
            $product->name = $request->name;
            $product->logo = $fileName;
            $product->save();
            return json_encode(array('statusCode'=>200));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    // For Display Page

    public function Show(Request $request) {
        try {
            $productDatas = DB::table('product')->get();
            return view('dashboard.productview', compact('productDatas'));    
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

// Edit Product 
    public function EditProduct(Request $request) {
            try {
                $editProducts = product::where('id', $request->id)->get();
                return view('dashboard.product', compact('editProducts'));    
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
    }

    // update product 

       public function Update(Request $request) {
           try {
                $file = $request->file('image'); 
                $extension = $file->getClientOriginalExtension(); 
                $fileName = time().'.'.$extension;
                $data = $file->move('upload/product/', $fileName);  
                product::where('id', $request->editID)->update(array('name' => $request->name , 'logo'=> $fileName));
                return "success";
            } catch (\Throwable $th) {
                return $th->getMessage();
            }
    }

    // Delete 

    public function Delete(Request $request) {
     try { 
         if($request->id != "" ){

             $row = product::find($request->id);
             $destination = 'upload/'.$row->image;
             if(File::exists($destination)){
                 File::delete($destination);
                }
                product::first()->delete();
            }  
            $productDatas =  DB::table('product')->get();
             return view('dashboard.productview',compact('productDatas'));
        }catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

 
}
