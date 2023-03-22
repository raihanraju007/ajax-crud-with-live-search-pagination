<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        $products = Product::latest()->paginate(5);
        return view('product',compact('products'));
    }

    public function addProduct(Request $request){
        $request->validate(
            [
                'name'=> 'required|unique:products',
                'price'=> 'required',
            ],
            [
                'name.required' => 'Name is Required',
                'name.unique'   => 'Product Already Exists',
                'price.required' => 'Price is Required',
            ]
        );
        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function updateProduct(Request $request){
        $request->validate(
            [
                'up_name'=> 'required|unique:products,name,'.$request->up_id,
                'up_price'=> 'required',
            ],
            [
                'up_name.required' => 'Name is Required',
                'up_name.unique'   => 'Product Already Exists',
                'up_price.required' => 'Price is Required',
            ]
        );
       Product::where('id',$request->up_id)->update([
            'name' => $request->up_name,
            'price' => $request->up_price,
       ]);
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function deleteProduct(Request $request){
        Product::find($request->product_id)->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function pagination(Request $request){
        $products = Product::latest()->paginate(5);
        return view('pagination_product',compact('products'))->render();
    }

    public function searchProduct(Request $request){
        $products = Product::where('name','like','%'.$request->search_string.'%')
        ->orWhere('price','like', '%'.$request->search_string.'%')
        ->orderBy('id','desc')
        ->paginate(5);

        if($products->count() >= 1){
            return view('pagination_product',compact('products'))->render();
        }else{
            return response()->json([
                'status' => 'not_found',
            ]);
        }
    }

}
