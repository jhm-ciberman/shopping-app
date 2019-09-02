<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'user_id'   => function() {
            return factory(App\User::class)->create()->id;
        },
        'contact'          => $faker->name,

        'between'          => $faker->optional()->passthrough(function() use ($faker) {
            return trim($faker->streetName) . ' y ' . trim($faker->streetName);
        }),
        'references'       => $faker->optional()->text(100),
        'phone'            => $faker->phoneNumber,

        'country_code'     => 'ar',
        'street_name'      => trim($faker->streetName),
        'street_number'    => $faker->buildingNumber,
        'additional_info'  => $faker->optional()->secondaryAddress,

        'state'            => $faker->state,
        'city'             => $faker->city,
        'zip_code'         => $faker->postcode,

        'latitude'         => $faker->latitude,
        'longitude'        => $faker->longitude,
    ];
});
