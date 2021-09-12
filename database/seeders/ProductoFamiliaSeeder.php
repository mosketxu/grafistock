<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoFamiliaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('producto_familias')->delete();

        \DB::table('producto_familias')->insert([
            ['nombrecorto'=>'PAP','nombre'=>'Papel'],
            ['nombrecorto'=>'CAR','nombre'=>'Cartón'],
            ['nombrecorto'=>'MAD','nombre'=>'Madera'],
            ['nombrecorto'=>'TEX','nombre'=>'Textil'],
        ]);
    }
}

