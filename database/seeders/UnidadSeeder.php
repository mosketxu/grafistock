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

        \DB::table('unidades')->insert(array (
            1 =>array ('id' => 1,'nombre' => 'mm',),
            2 =>array ('id' => 2,'nombre' => 'cm',),
            3 =>array ('id' => 3,'nombre' => 'Kg',),
            4 =>array ('id' => 4,'nombre' => 'gr',),
            5 =>array ('id' => 5,'nombre' => 'µm',),
            6 =>array ('id' => 6,'nombre' => 'resma',),
            7 =>array ('id' => 7,'nombre' => 'bobinas',),
            8 =>array ('id' => 8,'nombre' => '€/Kg',),
            9 =>array ('id' => 9,'nombre' => '€/ud',),
        ));
    }
}
