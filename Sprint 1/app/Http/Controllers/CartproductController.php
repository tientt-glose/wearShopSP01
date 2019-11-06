<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cartproduct;
use App\Http\Resources\Cartproduct as CartproductResource;

class CartproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart=Cartproduct::paginate(5);
        // return new CartproductResource($cart);
        return CartproductResource::collection($cart);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $cart=$request->isMethod('put') ? Cartproduct::where('userid',$userid)
        //     ->where('product_id',$request->product_id)->exists() ? Cartproduct::where('userid',$userid)
        //     ->where('product_id',$request->product_id)
        $cart=$request->isMethod('put') ? (Cartproduct::where('userid',$request->$userid)
        ->where('product_id',$request->product_id)->findOrFail()) : new Cartproduct;

        $cart->id=$request->input('cartproduct_id');
        $cart->userid=$request->input('userid');
        $cart->product_id=$request->input('product_id');
        $cart->product_name=$request->input('product_name');
        $cart->quantity=$request->input('quantity');
        $cart->price=$request->input('price');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userid)
    {
        $cart=Cartproduct::where('userid',$userid)->paginate(5);
        // return new CartproductResource($cart);
        return CartproductResource::collection($cart);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
