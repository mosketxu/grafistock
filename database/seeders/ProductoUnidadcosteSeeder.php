<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoUnidadcosteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('producto_unidadescoste')->delete();

        \DB::table('producto_unidadescoste')->insert([
            ['nombrecorto'=>'e_kg','nombre'=>'€/kg'],
            ['nombrecorto'=>'e_ud','nombre'=>'€/ud'],
            ['nombrecorto'=>'e_caj','nombre'=>'€/caja'],
            ['nombrecorto'=>'e_paq','nombre'=>'€/paquete'],
            ['nombrecorto'=>'e_rol','nombre'=>'€/rollo'],
            ['nombrecorto'=>'e_mto','nombre'=>'€/metro'],
        ]);
    }
}
