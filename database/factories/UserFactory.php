<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker, $data) {
    return [
        'name' => $data['name'] ?? $faker->name,
        'email' => $data['email'] ?? $faker->unique()->safeEmail,
        'tel' => $faker->phoneNumber,
        'address' => $faker->address,
        'zip' => mt_rand(1000, 9000),
        'city' => $faker->city,
        'customer_number' =>null,
        'primary_contact' => Str::random(15),
        'is_admin' => $data['is_admin'] ?? 0,
        'email_verified_at' => now(),
        'password' => $data['email'] ?? '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
