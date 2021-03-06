<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','LandingPageController@index')->name('landing-page');

Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('/cart','CartController@index')->name('cart.index');
Route::get('/cart/{sessionid}&{userid}&{url}','CartController@show');
Route::post('/cart','CartController@store')->name('cart.store');
Route::patch('/cart/{product}','CartController@update')->name('cart.update');
Route::delete('/cart/{product}','CartController@destroy')->name('cart.destroy');

Route::get('/checkout','CheckoutController@index')->name('checkout.index');
Route::post('/checkout','CheckoutController@store')->name('checkout.store');
Route::patch('/checkout_delivery/{id}','CheckoutController@updateDelivery')->name('checkout.updateDelivery');
Route::patch('/checkout_payment/{id}','CheckoutController@updatePay')->name('checkout.updatePay');

Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy');

Route::get('/thankyou','ConfirmationController@index')->name('confirmation.index');

Route::get('testAddCart',function() {
    $client = new \GuzzleHttp\Client();
    $url = config('app.add_cart');
    $response=$client->request('POST', $url, [
        'json' => [
            'user_id' => session()->get('user')['user_id'],
            'product_id' => 2,
        ]
    ]);
    // return redirect()->route('cart.index')->with('success_message','Item was added to your cart!');

    $data = $response->getBody();
    $data = json_decode($data);
    dd($data);
});

Route::get('isLogin','AuthUser@isLogin')->name('AuthUser.isLogin');
Route::get('setsession','AuthUser@setSession');
Route::get('destroysession','AuthUser@destroySession');

Route::get('testS',function() {
    session()->forget('user');
});

Route::get('testD',function() {
    session()->forget('delivery');
});

Route::get('testP',function() {
    session()->forget('payment');
});

Route::get('testC',function() {
    session()->forget('coupon');
});

