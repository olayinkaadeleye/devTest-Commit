<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::latest()->get();

        return response()->json($categories, 200);
        //$categories = Category::all()->toArray();
        //return array_reverse($categories);
    }

  
   
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = new Category([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->name),
        ]);
        $category->save();
  
        return response()->json('category successfully added');
    }
  
    public function edit( $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

     // update post
     public function update($id, Request $request)
     {

         $category = Category::find($id);
         $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
   
         return response()->json('category successfully updated');
     }
  
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return response()->json('category successfully deleted');
    }
}