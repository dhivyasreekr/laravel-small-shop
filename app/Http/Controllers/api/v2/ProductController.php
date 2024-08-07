<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
            // if($request->has('brand_id')){
            //     $products=Product::where('brand_id', $request->input('brand_id'))
            //                     ->orderBy('name', 'asc')
            //                     ->get();
            // }
            // else if($request->has('category_id')){
            //     $products = Product::whereHas('category', function ($query) use ($request) {
            //                     $query->where('categories.id', $request->input('category_id'));
            //                 })->orderBy('name', 'asc')->get();
            // }
            // else
            {
                $products = Product::orderBy('name', 'asc')->get();
            }
        
            $transformedProducts = $products->map(function($product){
            return[
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name,
                'brand' => $product->brand->name,
                'description' => $product->description,
                'price' => $product->price,
                'image_path' => $product->getImagePath(),
                'qty' => $product->qty,
                'alert_stock'=>$product->alert_stock,
            ];
        });
        return response()->json(['data' => $transformedProducts],200);
    }
}
