<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('ubicaciones')->delete();

        \DB::table('ubicaciones')->insert([
            ['nombrecorto' => 'alm1','nombre' => 'almacen 1'],
            ['nombrecorto' => 'alm2','nombre' => 'almacen 2'],
            ['nombrecorto' => 'alm3','nombre' => 'almacen 3'],
        ]);
    }
}
