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
            ['sigla' => 1,'nombre' => 'Alex'],
            ['sigla' => 2,'nombre' => 'Juan'],
            ['sigla' => 3,'nombre' => 'Jose'],
        ]);
    }
}
