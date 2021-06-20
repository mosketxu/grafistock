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

        \DB::table('solicitantes')->insert([
            ['id' => 1,'nombre' => 'Alex'],
            ['id' => 2,'nombre' => 'Juan'],
            ['id' => 3,'nombre' => 'Jose'],
        ]);
    }
}
