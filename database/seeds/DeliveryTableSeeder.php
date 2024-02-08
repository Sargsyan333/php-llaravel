<?php

use Illuminate\Database\Seeder;

class DeliveryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->insert([
            [
                'delivery_date' => date("Y-m-d"),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'delivery_date' => date("Y-m-d", time() - 60 * 60 * 24),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
