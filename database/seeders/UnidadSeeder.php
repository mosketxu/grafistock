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
            ['id'=>'car','nombre'=>'cartuchos'],
            ['id'=>'hoj','nombre'=>'hojas'],
            ['id'=>'m','nombre'=>'metrod'],
            ['id'=>'mm','nombre'=>'milimetros'],
            ['id'=>'m2','nombre'=>'metros cuadrados'],
            ['id'=>'pla','nombre'=>'planchas'],
            ['id'=>'res','nombre'=>'resmas'],
            ['id'=>'rol','nombre'=>'rollos'],
            ['id'=>'uds','nombre'=>'unidades'],
        ]);
    }
}

