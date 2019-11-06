<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('cart/{userid}','CartproductController@index');
Route::get('carts','CartproductController@index');
Route::get('cart/{userid}','CartproductController@show');

//create new product
Route::post('cart','CartproductController@store');
// update new product
Route::put('cart','CartproductController@store');

Route::delete('cart/{userid}/product{id}','CartproductController@destroy');


// Route::get('carts',function (){
//     return response('My firts');
// });


// Route::get('cart/{userid}','CartproductController@show');
// Route::put('cart/{userid}','CartproductController@store');
// Route::delete('delete/{userid}/{productid}','CartproductController@destroy');



