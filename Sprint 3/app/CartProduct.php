<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $fillable = ['order_id', 'cart_id', 'product_id', 'quantity', 'name', 'price'];

    public function getImgById()
    {
        $image = Product::where('id', $this->product_id)->select('image')->first();
        return $image->image;
    }

    public function getDesById()
    {
        $des = Product::where('id', $this->product_id)->select('description')->first();
        return substr($des->description, 0, 40) . '...';
    }

    public function presentPrice()
    {
        $fmt = new \NumberFormatter('vi-VN', \NumberFormatter::CURRENCY);
        return $fmt->formatCurrency($this->price, "VND");

        #en-US USD
        #vi-VN VND
    }

    public function getProductTotalById()
    {
        $price = CartProduct::where('id', $this->id)->select('price')->first();
        $qty = CartProduct::where('id', $this->id)->select('quantity')->first();
        return $price->price * $qty->quantity;
    }

    public static function getCartByCartID($cart_id)
    {
        return CartProduct::where('cart_id', $cart_id)->get();
    }

    public static function getProductByProductIDinSpecCart($cart_id, $product_id)
    {
        return CartProduct::where('cart_id', $cart_id)->where('product_id', $product_id)->first();
    }

    public static function jSONProductByProductIDinSpecCart($cart_id, $product_id)
    {
        return CartProduct::where('cart_id', $cart_id)->where('product_id', $product_id)->get();
    }

    public static function getProductByRowIDinSpecCart($cart_id, $row_id)
    {
        return CartProduct::where('cart_id', $cart_id)->where('id', $row_id)->firstOrFail();
    }
}
