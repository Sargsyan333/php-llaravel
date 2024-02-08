<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => Str::random(30),
        'model_text' => Str::random(5),
        'colli_size' => Str::random(20),
        'skeeis_item_number' => Str::random(10),
        'pharmacy_item_number' => Str::random(8),
        'price' => mt_rand(10, 99),
        'type' => Str::random(5),
    ];
});