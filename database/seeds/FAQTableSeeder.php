<?php

use Illuminate\Database\Seeder;

class FAQTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('f_a_q_s')->insert([
            'name' => 'How do I apply?',
            'text' => 'First you need to register for Apply using our online application service. Once you’ve registered,
             you’ll be able to complete your application – there’s quite a lot to fill in but you don’t have to do it all at once.
              We’ve got lots of information on filling in your application.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
