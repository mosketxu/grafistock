<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoUnidadcosteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('producto_unidadescoste')->delete();

        \DB::table('producto_unidadescoste')->insert([
            ['id'=>'e_kg','nombre'=>'€/kg'],
            ['id'=>'e_ud','nombre'=>'€/ud'],
            ['id'=>'e_caj','nombre'=>'€/caja'],
            ['id'=>'e_paq','nombre'=>'€/paqueta'],
            ['id'=>'e_rol','nombre'=>'€/rollo'],
            ['id'=>'e_mto','nombre'=>'€/metro'],
        ]);
    }
}
