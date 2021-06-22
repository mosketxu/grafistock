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
            ['sigla'=>'e_kg','nombre'=>'€/kg'],
            ['sigla'=>'e_ud','nombre'=>'€/ud'],
            ['sigla'=>'e_caj','nombre'=>'€/caja'],
            ['sigla'=>'e_paq','nombre'=>'€/paquete'],
            ['sigla'=>'e_rol','nombre'=>'€/rollo'],
            ['sigla'=>'e_mto','nombre'=>'€/metro'],
        ]);
    }
}
