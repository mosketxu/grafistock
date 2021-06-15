<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('secciones')->delete();

        \DB::table('secciones')->insert(array (
            1 =>array ('id' => 1,'nombre' => 'GF Rígido 1',),
            2 =>array ('id' => 2,'nombre' => 'Sección 2',),
            3 =>array ('id' => 3,'nombre' => 'Sección 3',),
        ));
    }
}
