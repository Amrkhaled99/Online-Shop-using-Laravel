<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'products';

    public static  function getProduct()
    {
        $orders = [];
        $subTotal = 0;
        $shipping = 0;

        $products= self::all();
        $sIds = session()->get('ids', []);
        $ids = array_count_values($sIds);
        foreach ($ids as $id => $quantity) {
            if ($products->find($id)) {
                $product = $products->find($id);
                $product['quantity'] = $quantity;
                array_push($orders, $product);
             
            }
        }
        $unique = array_unique($orders); 
      
       
        return  $unique ;
    }

}