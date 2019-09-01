<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    $price = $faker->randomFloat(2, 0, 1000);
    $discount = $faker->optional(.2)->randomFloat(2, 0, .9 * $price);
    
    return [
        'name'         => ucfirst($faker->words(3, true)),
        'description'  => ucfirst($faker->paragraph),
        'price'        => $price,
        'discount'     => $discount ?? 0.00,
        'sku'          => strtoupper($faker->unique()->bothify('??####')),
    ];
});
