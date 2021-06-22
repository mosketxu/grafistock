<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('producto_tipos')->delete();

        \DB::table('producto_tipos')->insert([
            ['sigla'=>'B','nombre' => 'Bobina'],
            ['sigla'=>'C','nombre' => 'Consumible'],
            ['sigla'=>'G','nombre' => 'Gran.Formato'],
            ['sigla'=>'P','nombre' => 'Peq.Formato'],
            ['sigla'=>'R','nombre' => 'Rígido'],
        ]);
    }
}
