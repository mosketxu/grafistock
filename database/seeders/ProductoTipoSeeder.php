<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('producto_tipos')->delete();

        \DB::table('producto_tipos')->insert([
            ['nombrecorto'=>'B','nombre' => 'Bobina'],
            ['nombrecorto'=>'C','nombre' => 'Consumible'],
            ['nombrecorto'=>'G','nombre' => 'Gran.Formato'],
            ['nombrecorto'=>'P','nombre' => 'Peq.Formato'],
            ['nombrecorto'=>'R','nombre' => 'Rígnombrecortoo'],
        ]);
    }
}
