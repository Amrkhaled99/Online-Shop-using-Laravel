<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
   
    function index()
    {
        // $categories = Category::all();
        $categories = Category::paginate(5);

        return view("admin.categories.index")->with("categories",$categories);
    }


    function create()
    {
    
        return view("admin.categories.create");
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'image' => 'required',

        ]);


        $imageUrl = $request->file('image')->store('categories', ['disk' => 'public']);
        $category = new Category;

        $category->fill($request->post());
        $category['image'] = $imageUrl;

        $category->save();
        return redirect()->route("admin.categories");

    
    }



    // ############################## Edit ##############################

    
    function edit($id)
    {
        $categories = Category::find($id);
        return view("admin.categories.edit")->with("categories",$categories);
    }

    function update($id,Request $request)
    {
        $categories = Category::find($id);
        $request->validate([
            'name' => 'required|min:4',
            'image' => 'required',

        ]);
        $categories->fill($request->post());

        $imageUrl = $request->file('image')->store('categories', ['disk' => 'public']);

        $categories['image'] = $imageUrl;

        $categories->save();
       return redirect()->route("admin.categories");
        

    }



    function destroy($id)
    {
        Category::destroy($id);
        Session::flash('message', 'Record has been deleted successfully!'); 
        return redirect()->route("admin.categories");


    }

    
    function show($id)
    {
        $category = Category::find($id);
        return view("admin.categories.show")->with("category",$category);
    }
    
}
