<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('unidades')->delete();

        \DB::table('unidades')->insert([
            ['sigla'=>'car','nombre'=>'cartuchos'],
            ['sigla'=>'hoj','nombre'=>'hojas'],
            ['sigla'=>'m','nombre'=>'metrod'],
            ['sigla'=>'mm','nombre'=>'milimetros'],
            ['sigla'=>'m2','nombre'=>'metros cuadrados'],
            ['sigla'=>'pla','nombre'=>'planchas'],
            ['sigla'=>'res','nombre'=>'resmas'],
            ['sigla'=>'rol','nombre'=>'rollos'],
            ['sigla'=>'uds','nombre'=>'unidades'],
        ]);
    }
}

