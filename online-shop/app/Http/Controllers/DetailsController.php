<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DetailsController extends Controller
{
    function index($id)
    {

        $product = Product::find($id);
        $sizes = Size::all();
        $colors = Color::all();

        $sProduct = Product::where('category_id', $product->category_id)->get();
        // dd(  $product);
       // $id = $product['category']['id'];
    //    $sProduct = DB::select( 
    //     DB::raw (
    //    " SELECT p.name,p.rating_count,p.image,p.price,p.discount,p.rating
    //    FROM  products as p 
    //    LEFT JOIN categories as c
    //    ON p.category_id=$id") );

      

       $price= $this->price($product);
        return view("details",compact("product","price","sizes","colors","sProduct"));
    }

    public function price($product)
    {
        return $product->price - $product->price * $product->discount;
    }


    function store(Request $request){

        $id = $request['product_id'];

        $product = product::find($id);
        $rate = new Rating();

        $rating=$product['rating'];
        $cRating=$product['rating_count'];
        $newRating= $request["product_rating"];


        $rating = ($rating * $cRating + $newRating) / $cRating + 1;


        $rate['rating'] = $request["product_rating"];
        $rate['user_id'] = Auth::user()->id;
        $rate['name'] = $request["name"];
        $rate['email'] = $request["email"];
        $rate['review'] = $request["review"];

        $product['rating'] = $rating;
        $product['rating_count']=  $cRating+1 ;

        $rate->save();
        $product->save();

      // return redirect()->route("index");
       return redirect('/shop');

    
    }


}
