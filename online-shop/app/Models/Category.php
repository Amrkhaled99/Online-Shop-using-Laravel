<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public static $rules = [
        'name' => 'required',
        'image' => 'required|mimes:jpg,png,bmp,jpeg|max:2048'
    ];


    public static function getProductsCont()
    {
        return Product::count();
    }

    public static function getCategoriesCont()
    {
        return Category::count();
    }


    public static function getUsersCount()
    {
        return User::count();
    } 
    
    public static function getOrdersCount()
    {
        return Order::count();
    }

    public static function getColorsCount()
    {
        return Color::count();
    }

    public static function getSizesCount()
    {
        return Size::count();
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }


}