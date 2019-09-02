<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderItem;
use App\Order;
use App\Product;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'quantity' => random_int(1, 4),
        'product_id' => function() {
            return factory(Product::class)->create()->id;
        },
        'price' => function($data) {
            return Product::find($data['product_id'])->price;
        },
        'discount' => function($data) {
            return Product::find($data['product_id'])->discount;
        },
        'order_id' => function() {
            return factory(Order::class)->create()->id;
        },
    ];
});
