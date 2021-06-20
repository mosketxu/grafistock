<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('producto_clases')->delete();

        \DB::table('producto_clases')->insert([
            ['id'=>'GFBOBACA','nombre'=>'GF BOB ACA'],
            ['id'=>'GFBOBFOT','nombre'=>'GF BOB FOT'],
            ['id'=>'GFBOBSOP','nombre'=>'GF BOB SOP'],
            ['id'=>'GFBOBVIN','nombre'=>'GF BOB VIN'],
            ['id'=>'GFRIGIDOS','nombre'=>'GF RIGIDOS'],
            ['id'=>'PFBOBLAM','nombre'=>'PF BOB LAM'],
            ['id'=>'PFHOJSOP','nombre'=>'PF HOJ SOP'],
            ['id'=>'TINTAL','nombre'=>'TINTA L'],
            ['id'=>'VAR_R','nombre'=>'VARIOS R'],
            ['id'=>'VAR_UD','nombre'=>'VARIOS UD'],
        ]);
    }
}



