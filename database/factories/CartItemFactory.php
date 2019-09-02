<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CartItem;
use App\Product;
use App\Cart;
use Faker\Generator as Faker;

$factory->define(CartItem::class, function (Faker $faker) {
    return [
        'quantity' => random_int(1, 4),
        'product_id' => function() {
            return factory(Product::class)->create()->id;
        },
        'cart_id' => function() {
            return factory(Cart::class)->create()->id;
        },
    ];
});
