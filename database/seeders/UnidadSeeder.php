<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{

    public function run()
    {
        \DB::table('unidades')->delete();

        \DB::table('unidades')->insert([
            ['nombrecorto'=>'car','nombre'=>'cartuchos'],
            ['nombrecorto'=>'hoj','nombre'=>'hojas'],
            ['nombrecorto'=>'m','nombre'=>'metros'],
            ['nombrecorto'=>'mm','nombre'=>'milimetros'],
            ['nombrecorto'=>'m2','nombre'=>'metros cuadrados'],
            ['nombrecorto'=>'pla','nombre'=>'planchas'],
            ['nombrecorto'=>'res','nombre'=>'resmas'],
            ['nombrecorto'=>'rol','nombre'=>'rollos'],
            ['nombrecorto'=>'uds','nombre'=>'unidades'],
        ]);
    }
}

