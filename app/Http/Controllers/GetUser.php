<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\Controller;


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

}

