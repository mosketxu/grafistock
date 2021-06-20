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
            ['id'=>'B','nombre' => 'Bobina'],
            ['id'=>'C','nombre' => 'Consumible'],
            ['id'=>'G','nombre' => 'Gran.Formato'],
            ['id'=>'P','nombre' => 'Peq.Formato'],
            ['id'=>'R','nombre' => 'Rígido'],
        ]);
    }
}
