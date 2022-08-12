<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_compra')->insert([
            'id' => 1,
            'nombre' => 'Contado',
            'estado' => 1, // activo
            'created_at' => now(),
            'updated_at' => now(),
                ]);
    
            DB::table('tipo_compra')->insert([
            'id' => 2,
            'nombre' => 'Crédito',
            'estado' => 1, // activo
            'created_at' => now(),
            'updated_at' => now(),
                ]);
    }
}
