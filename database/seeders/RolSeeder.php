<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([
        'id' => 1,
        'nombre' => 'Administrador',
        'estado' => 1, // activo
        'created_at' => now(),
        'updated_at' => now(),
            ]);

        DB::table('rol')->insert([
        'id' => 2,
        'nombre' => 'Secretario',
        'estado' => 1, // activo
        'created_at' => now(),
        'updated_at' => now(),
            ]);
        
        DB::table('rol')->insert([
        'id' => 3,
        'nombre' => 'Técnico',
        'estado' => 1, // activo
        'created_at' => now(),
        'updated_at' => now(),
            ]);
    }
}
