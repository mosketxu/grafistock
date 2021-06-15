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

        \DB::table('ubicaciones')->insert(array (
            1 =>array ('id' => 1,'nombre' => 'almacen 1',),
            2 =>array ('id' => 2,'nombre' => 'almacen 2',),
            3 =>array ('id' => 3,'nombre' => 'almacen 3',),
        ));
    }
}
