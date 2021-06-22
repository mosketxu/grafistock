<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoGrupoproduccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('producto_gruposproduccion')->delete();

        \DB::table('producto_gruposproduccion')->insert([
            ['sigla'=>'CON','nombre'=>'CONSUMIB'],
            ['sigla'=>'EMB','nombre'=>'EMBALAJES'],
            ['sigla'=>'GEXP','nombre'=>'G EXPOSITO'],
            ['sigla'=>'GLAMADH','nombre'=>'G LAM ADH'],
            ['sigla'=>'GSOPFOT','nombre'=>'G SOP FOTO'],
            ['sigla'=>'GSOPRIG','nombre'=>'G SOP RIGI'],
            ['sigla'=>'GSOPROL','nombre'=>'G SOP ROLL'],
            ['sigla'=>'GTINT','nombre'=>'G TINTAS'],
            ['sigla'=>'GVINCOR','nombre'=>'G VIN CORT'],
            ['sigla'=>'PACAB','nombre'=>'P ACABADOS'],
            ['sigla'=>'PPAP','nombre'=>'P PAPEL'],
        ]);
    }
}

