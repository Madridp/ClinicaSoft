<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioAdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        'name' => 'Josué Ahias Enoc Madrid',
        'email' => 'josuemadrid@admin.com',
        'password' => Hash::make('admin2022'),
        'estado' => 1, // activo
        'id_rol' => 1, // rol admin
        'created_at' => now(),
        'updated_at' => now(),
        ]);
    
    }
}
