<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Order;
use Faker\Generator as Faker;
use App\User;
use App\Delivery;

$factory->define(Order::class, function (Faker $faker) {

    $user = User::all()->random(1)->first();
    $delivery = Delivery::all()->random(1)->first();

    return [
        'user_id' => $user->id,
        'delivery_id' => $delivery->id,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'mobile' => $faker->phoneNumber,
        'package_delivery_information' => Str::random(10),
        'package_delivery_date' => now(),
        'package_comment' => Str::random(15),
        'economics_id' => mt_rand(1000, 9000),
        'order_accepted_date' => now(),
        'shipmondo_id' => mt_rand(1000, 9000),
        'shipmondo_package_id' => mt_rand(1000, 9000),
    ];
});
