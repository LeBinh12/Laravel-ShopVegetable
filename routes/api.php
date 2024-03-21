<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetUser;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user(); 
// });
Route::post('AddCategory',[GetUser::class,'AddCategory']);
Route::delete('DeleteCategory/{id}',[GetUser::class,'deleteCategory']);
Route::post('AddProduct',[GetUser::class,'AddProduct']);
Route::Get('ProductCategory/{id}',[GetUser::class,'getProductCategory']);
Route::put('UpdateProduct/{id}',[GetUser::class,'updateProduct']);
Route::delete('DeleteProduct/{id}',[GetUser::class,'deleteProduct']);
Route::get("Category",[GetUser::class,'GetCategory']);
Route::get("ProductRandom",[GetUser::class,'GetProductRandom']);
Route::get("BannerRandom",[GetUser::class,'GetBannerRandom']);
Route::get("Banner/{id}",[GetUser::class,'GetBanner']);
Route::get("NewProductCategory/{id}",[GetUser::class,'NewProductCategory']);
Route::get("MaxPrice",[GetUser::class,'MaxPrice']);
Route::get("MinPrice",[GetUser::class,'MinPrice']);
Route::get("Product",[GetUser::class,'Product']);
Route::get("NewProduct",[GetUser::class,'NewProduct']);
Route::get("Product/{id}",[GetUser::class,'ProductDetail']);
Route::get("ProductCategoryRandom/{id}",[GetUser::class,'GetProductCategoryRanDom']);
Route::get("Search/{id}",[GetUser::class,'SearchProduct']);
Route::post("AddCustomer",[GetUser::class,'AddCustomer']);
Route::post("AddOrder/{id}",[GetUser::class,'AddOrder']);
Route::post("AddOrderDetail/order={order_id}&product={ProductId}",[GetUser::class,'AddOrderDetail']);
Route::post("AddCart/customer={customer_id}&product={ProductId}",[GetUser::class,'AddCart']);
Route::delete("DeleteCart/{id}",[GetUser::class,'DeleteCart']);
Route::delete("DeleteOrder/{id}",[GetUser::class,'DeleteOrder']);
Route::delete("DeleteOrderDetail/{id}",[GetUser::class,'DeleteOrderDetail']);