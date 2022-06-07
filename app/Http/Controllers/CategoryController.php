<?php

namespace App\Http\Controllers;
use App\Models\category;
use Illuminate\Http\Request;
use DB;
use File;

class CategoryController extends Controller
{
      public function index(Request $request) {
        $categoris = DB::table('category')->get();
       
        return view('dashboard.category')->with('categoris', $categoris);
    }


    // For Product 

     public function AddCategorys(Request $request) {
        try {  
             // FOr Image
            $file = $request->file('image'); 
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $data = $file->move('upload/category/', $fileName);
            // For Insert Data
            $category = new category();
            $category->name = $request->category;
            $category->logo = $fileName;
            $category->save();
            // return json_encode(array('statusCode'=>200));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    // For Edit Category
    public function editCategory(Request $request) {
        try {
            $editCategoryDatas = category::where('id' ,$request->id)->get();
           
            return view('dashboard.category',compact('editCategoryDatas'));
       } catch (\Throwable $th) {
            throw $th;
        }
    }

       // For Update Category
    public function Update(Request $request) {
        try {
            $file = $request->file('image'); 
            $extension = $file->getClientOriginalExtension(); 
            $fileName = time().'.'.$extension;
            $data = $file->move('upload/category/', $fileName);  
            category::where('id', $request->editID)->update(array('name' => $request->category , 'logo'=> $fileName));
            return "success";
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Delete 

    public function Delete(Request $request) {

     try {   
         $datas = DB::table('category')->get();
         $row = category::find($request->id);
         $destination = 'upload/'.$row->image;
         if(File::exists($destination)){
             File::delete($destination);
            }
            category::first()->delete();
          
            return view('dashboard.display',compact('datas'));
        }catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

   
}
