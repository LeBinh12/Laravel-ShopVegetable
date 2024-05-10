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
Route::post("AddOrderDetail/order={order_id}&product={ProductId}",[GetUser::class,'AddOrderDetail']);
Route::post("AddCart",[GetUser::class,'AddCart']);
Route::post("DeleteCart",[GetUser::class,'DeleteCart']);
Route::delete("DeleteOrder/{uid}",[GetUser::class,'DeleteOrder']);
Route::delete("DeleteOrderDetail/{uid}",[GetUser::class,'DeleteOrderDetails']);
Route::get("Cart/{uid}",[GetUser::class,'GetCart']);
Route::post("UpQuantity",[GetUser::class,'UpQuantity']);
Route::post("DownQuantity",[GetUser::class,'DownQuantity']);
Route::post("AddOrder",[GetUser::class,'AddOrder']);
Route::post("AddOrderDetails",[GetUser::class,'AddOrderDetails']);
Route::delete("DeleteAllCart/{uid}",[GetUser::class,'DeleteAllCart']);
Route::get("OrderDetail/{uid}",[GetUser::class,'GetOrderDetail']);
Route::post("Login",[GetUser::class,'Login']);
Route::get("CategoryId/{id}",[GetUser::class,'GetCategoryId']);
Route::post("UpdateProduct/{id}",[GetUser::class,'UpdateProduct']);
Route::post("AddBanner",[GetUser::class,'AddBanner']);
Route::Delete("DeleteBanner/{id}",[GetUser::class,'DeleteBanner']);
Route::get("Banner",[GetUser::class,'GetFullBanner']);
Route::post("UpdateCategory/{id}",[GetUser::class,'UpdateCategory']);
Route::get("OrderDetailSearch/{id}",[GetUser::class,'OrderDetailSearch']);
Route::post("UpdateStatus/{id}",[GetUser::class,'UpdateStatusOrderDetail']);
Route::delete("DeleteOrderDetail/{id}",[GetUser::class,'DeleteOrderDetail']);
Route::get("CustomerIdSearch/{id}",[GetUser::class,'CustomerIdSearch']);
Route::get("CustomerId/{id}",[GetUser::class,'CustomerId']);
Route::post("UpdateCustomer/{id}",[GetUser::class,'UpdateCustomer']);
Route::delete("DeleteCustomer/{id}",[GetUser::class,'DeleteCustomer']);
Route::get("SearchCustomer/{id}",[GetUser::class,'CustomerSearch']);


