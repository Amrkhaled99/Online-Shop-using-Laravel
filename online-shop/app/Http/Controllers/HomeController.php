<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    function index()
    {
        
        return view('index')->with([
            'categories' => Category::all(),
            'products' => Product::all()
        ]);
    }

    function shop(Request $request)
    {
        $query = Product::query();

        $inputs = $request->all();

        if (isset($inputs['keywords'])) {
            $query = $query->where('name', 'like', "%" . $inputs['keywords'] . "%");
        }
        if (isset($inputs['color'])) {
            if (!in_array('-1', $inputs['color'])) {

                $query = $query->whereIn('color_id', $inputs['color']);
            }
        }
        if (isset($inputs['size'])) {
            if (!in_array('-1', $inputs['size'])) {
                $query = $query->whereIn('size_id', $inputs['size']);
            }
        }

        if ($request->has('category_id')) {
            $query = $query->where('category_id', $request->get('category_id'));
        }

        if ($request->has('price')) {
            if (!in_array('-1', $inputs['price'])) {
                $query = $query->where(function ($q) use ($inputs) {
                    foreach ($inputs['price'] as $price) {
                        $q = $q->orWhereBetween('price', [$price, $price + 100]);
                    }
                });
            }
        }

        /*SELECT * FROM Products WHERE con1 and con2 and (
        price between 0 and 100 or
        price between 100 and 200
        )
        */

        $query = $query->orderByDesc('created_at');
        $products = $query->paginate(9);


        return view('shop')->with([
            'products' => $products,
            'colors' => Color::all(),
            'sizes' => Size::all()
        ]);
    }

    function add_product(Request $request)
    {
        if (Auth::check()) {
            if ($request->has('id')) {
                $ids = Session::get('ids', []);
                array_push($ids, $request->get('id'));
                Session::put('ids', $ids);
                return response()->json(count($ids));
            }
            return abort(404);

        }
        else {
            return redirect('/login');

        }


    }

    function add_toFavorite(Request $request)
    {
        if (Auth::check()) {

            if ($request->has('id')) {
                $ids = Session::get('favorite_list', []);
                array_push($ids, $request->get('id'));
                Session::put('favorite_list', $ids);
                return response()->json(count($ids));
            }
            return abort(404);
        }
        else {
            return redirect('/login');

        }




    }


    
    function checkout()
    {
        // return view('checkout');
        return view('checkout');
    }
}