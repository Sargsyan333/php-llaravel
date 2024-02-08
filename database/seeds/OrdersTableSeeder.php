<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = factory(Order::class, 5)->create();

        $orders->each(function ($order) {
            $id = Product::all()->random(1)->first()->id;

            $order->products()->attach(
                [ $id ],
                ['price' => mt_rand(10, 99), 'amount' => mt_rand(10, 99)]
            );
        });
    }
}



