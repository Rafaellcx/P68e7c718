<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('type_user')->insert(
            ['name' => 'Administrador', 'isAdmin' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        );
        \DB::table('type_user')->insert(
            ['name' => 'Tripulante', 'isAdmin' => false, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        );
        \DB::table('type_user')->insert(
            ['name' => 'Sala de Controle', 'isAdmin' => true, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        );
    }
}
