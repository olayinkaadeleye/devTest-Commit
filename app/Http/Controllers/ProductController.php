<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;


class ProductController extends Controller
{


    public function index()
    {
        $products = Product::latest()->get();
        return response()->json($products,200);
    }

  
   
    public function store(Request $request)
    {
            $this->validate($request, [
            'name' => 'required|max:255|unique:products,name',
            'price' => 'required|integer',
            'image' => 'required|image|max:2048',
            'description' => 'required',
            'category_id' => 'required',
        ]);
    
        $product = new Product([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);
        if ($request->image) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = '/storage/product/' . $imageName;
            $product->save();
        }
  
        return response()->json('product successfully added');
    }
  
    public function edit( $id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

     public function update($id, Request $request)
     {

        $this->validate($request, [
            'name' => 'required|max:255|unique:products,name',
            'price' => 'required|integer',
            'image' => 'required|image|max:2048',
            'description' => 'required',
            'category_id' => 'required',
        ]);
    
         $product = Product::find($id);
         $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);
        if ($request->image) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/product'), $imageName);
            $product->image = '/storage/product/' . $imageName;
            $product->save();
        }
        
         return response()->json('product successfully updated');
     }
  
    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('product successfully deleted');
    }
}