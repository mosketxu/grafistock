<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaterialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('materiales')->delete();

        \DB::table('materiales')->insert(array (
            1 =>array ('id' => 1,'nombre' => 'papel','peso' => '80gr','mano' => '','calidad' => 'offset',),
            2 =>array ('id' => 2,'nombre' => 'papel','peso' => '80gr','mano' => '','calidad' => 'mate',),
            3 =>array ('id' => 3,'nombre' => 'pvc','peso' => '','mano' => '120','calidad' => 'nose',),
        ));
    }
}
