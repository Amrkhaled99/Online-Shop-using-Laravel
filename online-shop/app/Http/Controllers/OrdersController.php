<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    
    function cart()
    {

        $products = Orders::getProduct();

        $subTotal = 0;
        $shipping = 0;
        foreach ($products as $product) {

            $shipping += 10;
            $subTotal += ($product['price'] - ($product['price'] * $product['discount'])) * $product['quantity'];

        }
        return view('cart', ['products' => $products, 'shipping' => $this->getShipping($products), 'subTotal' => $this->getSubTotal($products)]);

    }



    function productServices()
    {
        $id = $_GET['id'];
        $key = $_GET['key'];

        $ids = session()->get('ids', []);

        switch ($key) {
            case 1:
                $this->decQuantity($ids, $id);
                break;
            case 2:
                $this->incQuantity($ids, $id);
                break;
            case 3:
                $this->removeProduct($ids, $id);
                break;
        }

        return redirect()->route('cart');
    }


    function incQuantity($ids, $id)
    {
        array_push($ids, $id);
        Session::put('ids', $ids);
    }



    function decQuantity($ids, $id)
    {

        if (count(array_keys($ids, $id)) > 1) {

            for ($i = 0; $i < count($ids); $i++) {
                if ($ids[$i] == $id) {
                    array_splice($ids, $i, 1);
                    break;
                }
            }

        }
        Session::put('ids', $ids);
    }


    function removeProduct($ids, $id)
    {
        
        for ($i = 0; $i < count($ids); $i++) {
            if ($ids[$i] == $id) {
                array_splice($ids, $i, 1);
                $i --;
            }
        }
        Session::put('ids', $ids);
    }


    
    public function getSubTotal($products){
        $subtotal = 0;
        foreach ($products as $product) {

            $price = ($product['price'] - ($product['price'] * $product['discount']));
            $subtotal +=  $product['quantity']* $price;
        }
        return $subtotal;
    }

    public function getShipping($products){
        return count($products)*10;
    }
}
