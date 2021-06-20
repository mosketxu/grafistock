<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UbicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ubicaciones')->delete();

        \DB::table('ubicaciones')->insert([
            ['id' => 'alm1','nombre' => 'almacen 1'],
            ['id' => 'alm2','nombre' => 'almacen 2'],
            ['id' => 'alm3','nombre' => 'almacen 3'],
        ]);
    }
}
