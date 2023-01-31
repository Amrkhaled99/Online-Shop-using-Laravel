<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    function checkout()
    {

        $products = Orders::getProduct();

        $subTotal = 0;
        $shipping = 0;
        foreach ($products as $product) {

            $shipping += 10;
            $subTotal += ($product['price'] - ($product['price'] * $product['discount'])) * $product['quantity'];

        }
        return view('checkout', ['products' => $products, 'shipping' => $this->getShipping($products), 'subTotal' => $this->getSubTotal($products)]);

    }
  

     public function store(Request $request){


        if (Auth::check()) {

            $products = Orders::getProduct();
            $order = new Order();
            // $order->fill($request->post());
            $order->fname =$request['fname'];
            $order->lname =$request['lname'];
            $order->email =$request['email'];
            $order->mobile  =$request['mobile'];
            $order->address1 =$request['address1'];
            $order->address2 =$request['address2'];
            $order->country =$request['country'];
            $order->city =$request['city'];
            $order->state =$request['state'];  
            $order->zip =$request['zip'];
            // $order->sub_total =$request['subtotal'];
            // $order->shipping =$request['shipping'];
            // $order->total = $request['total'];
            $order->sub_total = $this->getSubTotal($products);
            $order->shipping =$this->getShipping($products);
            $order->total =$this->getSubTotal($products)*$this->getShipping($products);
            $order->user_id = Auth::user()->id;
            $order->save();
          
           
             foreach ($products as $product) {
                $orderDetail = new OrderDetails();
                $orderDetail->quantity = $product->quantity;
                $orderDetail->price = $product->price;
                $orderDetail->product_id = $product->id;
                $orderDetail->order_id = $order->id;
                $orderDetail->saveOrFail();
            }
            return redirect('/');

    
    
        } else {
            return redirect('/login');

        }

      


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
