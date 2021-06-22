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
            ['sigla'=>'GFBOBACA','nombre'=>'GF BOB ACA'],
            ['sigla'=>'GFBOBFOT','nombre'=>'GF BOB FOT'],
            ['sigla'=>'GFBOBSOP','nombre'=>'GF BOB SOP'],
            ['sigla'=>'GFBOBVIN','nombre'=>'GF BOB VIN'],
            ['sigla'=>'GFRIGIDOS','nombre'=>'GF RIGIDOS'],
            ['sigla'=>'PFBOBLAM','nombre'=>'PF BOB LAM'],
            ['sigla'=>'PFHOJSOP','nombre'=>'PF HOJ SOP'],
            ['sigla'=>'TINTAL','nombre'=>'TINTA L'],
            ['sigla'=>'VAR_R','nombre'=>'VARIOS R'],
            ['sigla'=>'VAR_UD','nombre'=>'VARIOS UD'],
        ]);
    }
}



