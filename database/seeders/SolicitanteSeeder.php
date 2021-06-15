<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SolicitanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('solicitantes')->delete();

        \DB::table('solicitantes')->insert(array (
            1 =>array ('id' => 1,'nombre' => 'Alex',),
            2 =>array ('id' => 2,'nombre' => 'Juan',),
            3 =>array ('id' => 3,'nombre' => 'Jose',),
        ));
    }
}
