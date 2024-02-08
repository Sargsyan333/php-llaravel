<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    private function testUsers()
    {
        return [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'is_admin' => 1,
                'password' => bcrypt('secret'),
            ], [
                'name' => 'User',
                'email' => 'user@test.com',
                'is_admin' => 0,
                'password' => bcrypt('secret'),
            ],
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\User::class, 8)->create();

        foreach ($this->testUsers() as $user) {
            factory(App\User::class)->create($user);
        }
    }
}
