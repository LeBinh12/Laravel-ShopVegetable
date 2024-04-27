<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\Controller;
use Carbon\Carbon;



class GetUser extends Controller
{
    public function AddCategory(Request $request){
        $json = DB::table('categories')->insert([
            "Name"=>$request->input("Name"),
        ]);
        if($json){
            $data = DB::table('categories')->get()->last();
            return response()->json([
                'status' => 200,
                "data"=> $data
            ],200);
        }
        else return response()->json([ 
            "status" => 404,
            "message" => "Error creating category"
        ],400);
    }
    public function deleteCategory($id){
        $user = DB::table('categories')->where('id',$id)->delete();
        return response()->json([
            "status" => 200,
            "message" => "Category deleted"
        ],200);
    }
    public function GetProductCategory($CategoryID){
        $json = DB::table('products')->where('Category_id',$CategoryID )->get();
        return response()->json($json);   
    }   

    public function AddProduct(Request $Request){
        $json = DB::table('products')->insert([
            "Name"=>$Request->input('Name'),
            "Price"=>$Request->input('Price'),
            "Image"=>$Request->input('Image'),
            "Quantity"=>$Request->input('Quantity'),
            "Detail"=>$Request->input('Detail'),
            "Category_id"=>$Request->input('Category_id'),
        ]);
        if($json){
            $data = DB::table('products')->get()->last();
            return response()->json([
                "status"=> 200,
                "data"=>$data
            ],200);
        }
        else return response()->json([
            "status"=> 400,
            "message"=>"Error Add Product"
        ],400);
    }
    public function UpdtaeProduct(Request $Request,$id){
        $json = [
            "Name"=>$Request->input('Name'),
            "Price"=>$Request->input('Price'),
            "Image"=>$Request->input('Image'),
            "Quantity"=>$Request->input('Quantity'),
            "Detail"=>$Request->input('Detail'),
            "Category_id"=>$Request->input('Category_id'),
        ];

        $Product = DB::table('Products')->where('id',$id)->update($json);
        if($Product){
            return response()->json([
                "status"=> 200,
                "data"=>$json
            ],200);
        }
        else return response()->json([
            "status"=> 400,
            "message"=>"Error Add Product"
        ],400);

    }


public function deleteProduct($id){
        $user = DB::table('products')->where('id',$id)->delete();
        return response()->json([
            "status" => 200,
            "message" => "Product deleted"
        ],200);
    }
public function GetCategory(){
    $json = DB::table('categories')->get();
    return response()->json([
        "status" => 200,
        "data"=>$json
    ],200);
}

public function GetBanner($id){
    $json = DB::table('Banner')->where('id',$id)->get();
    return response()->json([
        "status" => 200,
        "data"=>$json
    ],200);
}

public function GetProductRanDom(){
    $json = DB::table('products')->inRandomOrder()->get(); // inRandomOrder() sắp xếp kết quả ngẩu nhiên
    return response()->json([
        "status" => 200,
        "data"=>$json
    ],200);
}

public function GetBannerRanDom(){
    $json = DB::table('Banner')->inRandomOrder()->get(); // inRandomOrder() sắp xếp kết quả ngẩu nhiên
    return response()->json([
        "status" => 200,
        "data"=>$json
    ],200);
}

public function NewProductCategory($CategoryID){
    $json = DB::table('products')->join('categories','products.Category_id',"=","categories.id")
        ->where('categories.id',$CategoryID)->orderBy("products.id",'desc')->limit(6)->select('products.*')
        ->get();
    return response()->json([
        "status" => 200,
        "data" => $json,
    ], 200);
}   

public function NewProduct(){
    $json = DB::table("products")->orderBy('id','Desc')
    ->limit(3)->get();
    return response()->json([
        "status" => 200,
        "data" => $json,
    ], 200);
}

public function MaxPrice(){
    $json = DB::table('products')->Max('Price');
    return response()->json([
        "status" => 200,
        "data" => $json,
    ], 200);

}   
public function MinPrice(){
    $json = DB::table('products')->Min('Price');
    return response()->json([
        "status" => 200,
        "data" => $json,
    ], 200);

}   

public function Product(){
    $json = DB::table('products')->get();
    return response()->json([
        "status" => 200,
        "data" => $json,
    ], 200);

} 

public function ProductDetail($id){
    $json = DB::table('products')->where("id",$id)->get();
    return response()->json([
        "status" => 200,
        "data" => $json,
    ], 200);

} 
public function GetProductCategoryRanDom($id){
    $json = DB::table('products')->where("Category_id",$id)->inRandomOrder()->get(); // inRandomOrder() sắp xếp kết quả ngẩu nhiên
    return response()->json([
        "status" => 200,
        "data"=>$json
    ],200);
}

public function SearchProduct($Name){
    $json = DB::table('products')->Where("Name", 'LIKE','%'.$Name.'%')
                                ->orWhere("Detail",'Like','%'.$Name.'%')
                                ->get(); 
    return response()->json([
        "status" => 200,
         "data"=>$json
     ],200);
}
public function AddOrderDetail(Request $request, $order_id , $ProductId){
    $Json = DB::table('order_details')->insert([
        "Quantity" => $request->input('Quantity'),
        "Price"=>$request->input('Price'),
        "order_id"=>$order_id,
        "Product_id"=>$ProductId,
    ]);
    if($Json){
        $data = DB::table('order_details')->get()->last();
        return response()->json([
            "status" => 200,
            "data" => $data ,
        ],200);
    }
    else return response()->json([
        "status" => 400,
        "message" => "Error Add Customer",

    ],400);
}
public function AddCart(Request $request){
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    $price = $request->input('price');
    $uid = $request->input('uid');
    $json = DB::table('carts')->where('uid', $uid)->where('product_id', $productId)->first();
    if($json){
        // Sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
        $newQuantity = $json->quantity + $quantity;
        DB::table('carts')
            ->where('uid', $uid)
            ->where('product_id', $productId)
            ->update(['quantity' => $newQuantity]);

    }   
    else {
        // Sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
        DB::table('carts')->insert([
            'uid' => $uid,
            'product_id' => $productId,
            'quantity' => $quantity,
            'price' => $price,

        ]);

    }
    return response()->json([
        'status' => 200,
        'message' => 'Product added to cart successfully.',
    ], 200);
}

public function DeleteCart(Request $request){
    $id = $request->input('Cart_id');
    $uid = $request->input('uid');
    $json = DB::table("carts")->where("Cart_id",$id)->where("uid",$uid)->delete();
    if($json){
    return response()->json([
        "status" => 200,
        "message" => "Delete Customer successfully",
    ],200);
    } else{
        return response()->json([
            "status" => 400,
            "message" => "Delete Customer failed",
        ],400);
    }
}
public function DeleteOrder($id){
    $json = DB::table("order")->where("id",$id)->delete();
    return response()->json([
        "status" => 200,
        "message" => "Delete Customer successfully",
    ],200);
}
public function DeleteOrderDetail($id){
    $json = DB::table("order_details")->where("id",$id)->delete();
    return response()->json([
        "status" => 200,
        "message" => "Delete Customer successfully",
    ],200);
}

public function GetCart($uid){

    $json = DB::table('carts')->join("products", "carts.product_id","=","products.id")
                                ->select("carts.*","products.*")
                                ->where("carts.uid",$uid)
                                ->get();
     
    return response()->json([
        "status" => 200,
        "data" => $json,
    ],200);
}

public function UpQuantity(Request $request){
    $id = $request->input('Cart_id');
    $uid = $request->input('uid');

    $json = DB::table("carts")->where("Cart_id",$id)->where("uid",$uid)->first();

    if($json){
            $NewQuantity = $json->quantity +1;
             DB::table("carts")->where("uid",$uid)->where("Cart_id",$id)
             ->update(["quantity" =>$NewQuantity]);
             return response()->json([
                "status" => 200,
                "message" => "Up Quantity successfully"
              ],200);

    }else{
  return response()->json([
    "status" => 400,
    "message" => "Error while processing quantity"
  ],400);
}
}

public function DownQuantity(Request $request){
    $id = $request->input('Cart_id');
    $uid = $request->input('uid');

    $json = DB::table("carts")->where("Cart_id",$id)->where("uid",$uid)->first();

    if($json){
            $NewQuantity = $json->quantity - 1;
             DB::table("carts")->where("uid",$uid)->where("Cart_id",$id)
             ->update(["quantity" =>$NewQuantity]);
             return response()->json([
                "status" => 200,
                "message" => "Up Quantity successfully"
              ],200);

    }else{
  return response()->json([
    "status" => 400,
    "message" => "Error while processing quantity"
  ],400);
}
}

public function AddOrder(Request $request){
    $iddonhang = $request->input('iddonhang');
    $Name = $request->input('FullName');
    $Email = $request->input('Email');
    $Address = $request->input('Address');
    $Phone = $request->input('Phone');
    $uid = $request->input('uid');
    $Nation = $request->input('National');
    $CityOrTown = $request->input('TownOrCity');
    $Total = $request->input('Total');
    $OrderNote = $request->input('OrderNote');
    $json = DB::table('order')->insert([
        "iddonhang" => $iddonhang,
        "FullName" => $Name,
        "Phone" => $Phone,
        "Address" => $Address,
        "Email" => $Email,
        "uid" => $uid,
        "National" => $Nation,
        "TownOrCity" => $CityOrTown,
        "Total" => $Total,
        "OrderNote"=> $OrderNote,
    ]);
    if($json){
        $data = DB::table('order')->get()->last();
        return response()->json([
            "status"=> 200,
            "data"=>$data
        ],200);
    }
    else return response()->json([
        "status"=> 400,
        "message"=>"Error Add Product"
    ],400);
}

public function addOrderDetails(Request $request){
    $Quantity = $request->input('Quantity');
    $Price = $request->input('Price');
    $Product_id = $request->input('Product_id');
    $uid = $request->input('uid');
    $iddonhang = $request->input('iddonhang');
    $json = DB::table('order_details')->insert([
        'Quantity' => $Quantity,
        'Price' => $Price,
        'Product_id' => $Product_id,
        'uid' => $uid,
        'iddonhang' => $iddonhang
    ]);
    if($json){
        $data = DB::table('order_details')->get();
        return response()->json([
            "status"=> 200,
            "data"=>$data
        ],200);
    } else return response()->json([
        "status"=> 400,
        "message"=>"Error Add Product"
    ],400);

}

public function DeleteAllCart($uid){
    $json = DB::table("carts")->where("uid",$uid)->delete();
    if($json){
    return response()->json([
        "status" => 200,
        "message" => "Delete Customer successfully",
    ],200);
    } else{
        return response()->json([
            "status" => 400,
            "message" => "Delete Customer failed",
        ],400);
    }
}

public function GetOrderDetail($uid){
    $json = DB::table("order_details")->join("products","order_details.Product_id"," = ", "products.id")
                                    ->select("order_details.*","products.*")
                                    ->where("order_details.uid",$uid)
                                    ->get();
    return response()->json([
        "status" => 200,
        "data" => $json,
    ],200);
}







////
// Điền thông tin
// $message = "";
// $month_error = "";
// $day_error = "";
// $year_error = "";
  
// // Create your variables here:
// $month_options = [
//   "options" => ["min_range"=>1,"max_range"=>12]
// ];
// $day_options = ["options"=>["min_range"=>1,"max_range"=>31]];
// $year_options = ["options"=>["min_range"=>1903,"max_range"=>2024]];

// // Define your function here:
// function validateInput($type,&$error,$options_arr) {
//     if(!filter_var($_POST[$type],FILTER_VALIDATE_INT,$options_arr)){
//       $error = "* Invalid ${type}";
//       return FALSE;
//     }else{
//       Return TRUE;
//     }
// }

//   if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Uncomment the code below:
//     $test_month = validateInput("month", $month_error, $month_options);
//     $test_day = validateInput("day", $day_error, $day_options);
//     $test_year = validateInput("year", $year_error, $year_options);    
//     if ($test_month && $test_day && $test_year){
//       $message = "Your birthday is: {$_POST["month"]}/{$_POST["day"]}/{$_POST["year"]}";
//     }  
//   }





}

