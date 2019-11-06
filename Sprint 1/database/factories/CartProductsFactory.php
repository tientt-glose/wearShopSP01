<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Cartproduct::class, function (Faker $faker) {
    return [
        'userid'=>$faker->randomNumber($nbDigits = 2),
        'product_id'=>$faker->text(5), 
        'product_name'=>$faker->text(10), 
        'quantity'=>$faker->randomNumber($nbDigits = 1), 
        'price'=>$faker->randomNumber($nbDigits = 7)
    ];
});
