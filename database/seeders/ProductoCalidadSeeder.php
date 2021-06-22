<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductoCalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('producto_calidades')->delete();

        \DB::table('producto_calidades')->insert([
            ['sigla'=>'LON_2C','nombre'=>'LONA 2 CARAS'],
            ['sigla'=>'ADH_CRI','nombre'=>'ADH CRISTAL'],
            ['sigla'=>'ADH_NOR','nombre'=>'ADH NORMAL'],
            ['sigla'=>'ADH','nombre'=>'ADHESIVOS'],
            ['sigla'=>'ALU','nombre'=>'ALU'],
            ['sigla'=>'ANTIGRAFIT','nombre'=>'ANTIGRAFIT'],
            ['sigla'=>'BACKLIGHT','nombre'=>'BACKLIGHT'],
            ['sigla'=>'BRILLO','nombre'=>'BRILLO'],
            ['sigla'=>'CAR','nombre'=>'CAR'],
            ['sigla'=>'ESP','nombre'=>'ESPECIAL'],
            ['sigla'=>'ESTC_BRILL','nombre'=>'ESTC BRILL'],
            ['sigla'=>'ESTC_MATE','nombre'=>'ESTC MATE'],
            ['sigla'=>'FOA','nombre'=>'FOA'],
            ['sigla'=>'LON','nombre'=>'LONA'],
            ['sigla'=>'MAG','nombre'=>'MAGNETICO'],
            ['sigla'=>'MAT','nombre'=>'MATE'],
            ['sigla'=>'MET','nombre'=>'MET'],
            ['sigla'=>'NID','nombre'=>'NID'],
            ['sigla'=>'OFF_BL','nombre'=>'OFFSET BL'],
            ['sigla'=>'OTR','nombre'=>'OTR'],
            ['sigla'=>'PAP','nombre'=>'PAPEL'],
            ['sigla'=>'PLA','nombre'=>'PLASTICOS'],
            ['sigla'=>'PP_','nombre'=>'PP_'],
            ['sigla'=>'PVC','nombre'=>'PVC'],
            ['sigla'=>'REC','nombre'=>'RECICLADOS'],
            ['sigla'=>'SAT','nombre'=>'SATIN'],
            ['sigla'=>'STO_L','nombre'=>'STOPLIGHT'],
            ['sigla'=>'TXTIL','nombre'=>'TEXTIL'],
            ['sigla'=>'TXTURA','nombre'=>'TEXTURA'],
            ['sigla'=>'VIN','nombre'=>'VINILO'],
            ['sigla'=>'WIN','nombre'=>'WINDOWS'],
        ]);
    }
}

