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
            ['sigla' => 'alm1','nombre' => 'almacen 1'],
            ['sigla' => 'alm2','nombre' => 'almacen 2'],
            ['sigla' => 'alm3','nombre' => 'almacen 3'],
        ]);
    }
}
