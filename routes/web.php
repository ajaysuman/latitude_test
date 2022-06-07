<?php

use Illuminate\Support\Facades\Route;
use app\Controllers\ProductController;
use App\Models\category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  
    $datas = DB::table('category')->get();
    return view('dashboard.display',compact('datas'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// For Product
Route::get('/ShowProductForm', [App\Http\Controllers\ProductController::class, 'index'])->name('ShowProductForm');
Route::post('/AddProduct', [App\Http\Controllers\ProductController::class, 'AddProducts'])->name('AddProduct');
Route::get('/editProduct/{id}', [App\Http\Controllers\ProductController::class, 'EditProduct'])->name('editProduct');
Route::post('/updateProduct', [App\Http\Controllers\ProductController::class, 'Update'])->name('updateProduct');
Route::get('/deletePruduct/{id}', [App\Http\Controllers\ProductController::class, 'Delete'])->name('deletePruduct');

// For catetory
Route::get('/ShowCategoryForm', [App\Http\Controllers\CategoryController::class, 'index'])->name('ShowProductForm');
Route::post('/AddCategory', [App\Http\Controllers\CategoryController::class, 'AddCategorys'])->name('AddCategory');
Route::get('/editCategory/{id}', [App\Http\Controllers\CategoryController::class, 'EditCategory'])->name('editCategory');
Route::post('/updateCategory', [App\Http\Controllers\CategoryController::class, 'Update'])->name('updateCategory');
Route::get('/delete/{id}', [App\Http\Controllers\CategoryController::class, 'Delete'])->name('delete');


// View Product 
Route::get('/view', [App\Http\Controllers\ProductController::class, 'Show'])->name('view');

