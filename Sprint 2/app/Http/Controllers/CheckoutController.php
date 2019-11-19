<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }

        return view('checkout')->with([
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),
        ]);
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
    public function store(CheckoutRequest $request)
    {
        // dd($request->all());
        $contents = Cart::content()->map(function ($item) {
            return $item->name.', '.$item->qty;
        })->values()->toJson();

        // $contentss = Cart::content()->map(function ($item) {
        //     return $item->name.', '.$item->qty;
        // })->values();
        $full_address=$request->address.', tien'.$request->province.', '.$request->city;
        try {
            $charge = Stripe::charges()->create([
                'amount' => getNumbers()->get('newTotal'),
                'currency' => 'VND',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            $client = new \GuzzleHttp\Client();
            $url = config('app.create_billing');
            $response = $client->request('POST', $url, [
                'json' => [
                    'user_id'=> auth()->user()->id,
                    'billing_email' => $request->email,
                    'billing_name' => $request->name,
                    'billing_address' => $full_address,
                    'billing_phone' => $request->phone,
                    'billing_name_on_card' => $request->name_on_card ?? null,
                    'billing_content' => $contents,
                    'billing_discount' => getNumbers()->get('discount'),
                    'billing_discount_code' => getNumbers()->get('code'),
                    'billing_subtotal' => getNumbers()->get('newSubtotal'),
                    'billing_tax' => getNumbers()->get('newTax'),
                    'billing_total' => getNumbers()->get('newTotal'),
                    'payment_gateway' => 'Card',
                ]
            ]);
            
            // Testing respon
            // $data = $response->getBody()->getContents();
            // $data = $response->getBody();
            // $data = json_decode($data);
            // dd($data);

            Cart::instance('default')->destroy();
            session()->forget('coupon');
            // return back()->with('success_message', 'Thank you! Your payment has been successfully accepted!');
            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
