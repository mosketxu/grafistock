<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('producto_clases')->delete();

        // \DB::table('producto_clases')->insert([
        //     ['nombrecorto'=>'GFBOBACA','nombre'=>'GF BOB ACA'],
        //     ['nombrecorto'=>'GFBOBFOT','nombre'=>'GF BOB FOT'],
        //     ['nombrecorto'=>'GFBOBSOP','nombre'=>'GF BOB SOP'],
        //     ['nombrecorto'=>'GFBOBVIN','nombre'=>'GF BOB VIN'],
        //     ['nombrecorto'=>'GFRIGIDOS','nombre'=>'GF RIGIDOS'],
        //     ['nombrecorto'=>'PFBOBLAM','nombre'=>'PF BOB LAM'],
        //     ['nombrecorto'=>'PFHOJSOP','nombre'=>'PF HOJ SOP'],
        //     ['nombrecorto'=>'TINTAL','nombre'=>'TINTA L'],
        //     ['nombrecorto'=>'VAR_R','nombre'=>'VARIOS R'],
        //     ['nombrecorto'=>'VAR_UD','nombre'=>'VARIOS UD'],
        // ]);
    }
}



