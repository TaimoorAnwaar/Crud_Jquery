<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //

    public function Create(){
        return view('categories.create');
    }

    public function store(Request $request){

        $request->validate([
'name'=>'required|min:3',
'type'=>'required',

        ]);
$category=new Category();

$category->name=$request->name;
$category->category =$request->type;
$category->save();



return response()->json($category);
}
    public function index(){

        $items=Category::all();
        return   view( 'categories.create',compact('items'));
    }
    public function delete(Request $request)
{
    $category = Category::find($request->id);

    if ($category) {
        $category->delete();
        return response()->json(['success' => 'Category deleted successfully!']);
    } else {
        return response()->json(['error' => 'Category not found!'], 404);
    }
}

public function update(Request $request)
{
    $category = Category::find($request->id);

    if ($category) {
        $category->name = $request->name;
        $category->category = $request->category;
        $category->save();

        return response()->json(['success' => 'Category updated successfully!']);
    } else {
        return response()->json(['error' => 'Category not found!'], 404);
    }
}


}
