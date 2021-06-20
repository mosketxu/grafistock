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
            ['id'=>'LON_2C','nombre'=>'LONA 2 CARAS'],
            ['id'=>'ADH_CRI','nombre'=>'ADH CRISTAL'],
            ['id'=>'ADH_NOR','nombre'=>'ADH NORMAL'],
            ['id'=>'ADH','nombre'=>'ADHESIVOS'],
            ['id'=>'ALU','nombre'=>'ALU'],
            ['id'=>'ANTIGRAFIT','nombre'=>'ANTIGRAFIT'],
            ['id'=>'BACKLIGHT','nombre'=>'BACKLIGHT'],
            ['id'=>'BRILLO','nombre'=>'BRILLO'],
            ['id'=>'CAR','nombre'=>'CAR'],
            ['id'=>'ESP','nombre'=>'ESPECIAL'],
            ['id'=>'ESTC_BRILL','nombre'=>'ESTC BRILL'],
            ['id'=>'ESTC_MATE','nombre'=>'ESTC MATE'],
            ['id'=>'FOA','nombre'=>'FOA'],
            ['id'=>'LON','nombre'=>'LONA'],
            ['id'=>'MAG','nombre'=>'MAGNETICO'],
            ['id'=>'MAT','nombre'=>'MATE'],
            ['id'=>'MET','nombre'=>'MET'],
            ['id'=>'NID','nombre'=>'NID'],
            ['id'=>'OFF_BL','nombre'=>'OFFSET BL'],
            ['id'=>'OTR','nombre'=>'OTR'],
            ['id'=>'PAP','nombre'=>'PAPEL'],
            ['id'=>'PLA','nombre'=>'PLASTICOS'],
            ['id'=>'PP_','nombre'=>'PP_'],
            ['id'=>'PVC','nombre'=>'PVC'],
            ['id'=>'REC','nombre'=>'RECICLADOS'],
            ['id'=>'SAT','nombre'=>'SATIN'],
            ['id'=>'STO_L','nombre'=>'STOPLIGHT'],
            ['id'=>'TXTIL','nombre'=>'TEXTIL'],
            ['id'=>'TXTURA','nombre'=>'TEXTURA'],
            ['id'=>'VIN','nombre'=>'VINILO'],
            ['id'=>'WIN','nombre'=>'WINDOWS'],
        ]);
    }
}

