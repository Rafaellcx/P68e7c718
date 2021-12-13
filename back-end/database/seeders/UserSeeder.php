<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user')->insert(
            ['type_user_id' => 1, 'name' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('123456'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );

    }
}
