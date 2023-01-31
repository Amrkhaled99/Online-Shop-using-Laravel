<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products = Product::paginate(10);
        $colors = Color::all();
        $sizes = Size::all();
   

        return view("admin.products.index", compact("products","sizes","colors"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view("admin.products.create",compact("categories","sizes","colors"));   
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::$rules);
    
    
        $imageUrl = $request->file('image')->store('products', ['disk' => 'public']);

        $product = new Product;
        
        $product['image'] = $imageUrl;
        $product->fill($request->post());
    
        $product['description'] = $request['description'];
        $product['image'] =$imageUrl;
        $product['rating'] =  $request['rating'];
        $product['rating_count'] =  $request['rating_count'];
        $product['is_recent'] = $request['is_recent'] ? 1 : 0;
        $product['is_featured'] = $request['is_featured'] ? 1 : 0;

        $product->save();
        return redirect()->route('products.index');
    }



    public function storeSize(Request $request)
    {
        

        $productSize = new ProductSize();
        $sizes = Size::all();

       //$productSize->fill($request->post());


    //     foreach ($sizes as $size) {
    //    $productSize['size_'].$size->id =  $request['size_'].$size->id ;

    //     }

        


        $productSize->save();
        return redirect()->route('products.index');
    }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
  
        $products = product::find($id);
        return view("admin.products.show",compact("products","categories","sizes","colors"));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
  
        $products = product::find($id);

        return view("admin.products.edit",compact("products","categories","sizes","colors"));
    
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

            $products = product::find($id);
            $request->validate([
                'name' => 'required|min:4',
                'image' => 'required',
    
            ]);
            $products->fill($request->post());
    
            $imageUrl = $request->file('image')->store('products', ['disk' => 'public']);
    
            $categories['image'] = $imageUrl;
    
            $products->save();
           return redirect()->route("admin.products");
        
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        Session::flash('message', 'Record has been deleted successfully!'); 
        return redirect()->route('products.index');

       

    
    }
}
