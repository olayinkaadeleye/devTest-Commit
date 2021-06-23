<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{


    public function index()
    {
        $products = Product::latest()->get();

        return response()->json($products, 200);
        //$categories = Category::all()->toArray();
        //return array_reverse($categories);
    }

  
   
    public function store(Request $request)
    {
    
        $product = new Product([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
        ]);
        $product->save();
  
        return response()->json('product successfully added');
    }
  
    public function edit( $id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

     // update post
     public function update($id, Request $request)
     {

         $product = Product::find($id);
         $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
   
         return response()->json('product successfully updated');
     }
  
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('product successfully deleted');
    }
}