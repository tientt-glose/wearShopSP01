<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (session()->has('user')) echo '1';
        if (isLogin()==false) return redirect(config('app.auth').'/requirelogin?url='.config('app.api'));
        echo session()->get('user')['user_id'].'.';
        $products = Product::inRandomOrder()->take(12)->get();

        return view('shop')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        $product = Product::where('id',$id)->firstOrFail();
        $mightAlsoLike = Product::where('id','!=',$id)->MightAlsoLike()->get();
        return view('product')->with([
            'product'=> $product,
            'mightAlsoLike'=> $mightAlsoLike,
        ]);
    }


    
}
