<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class ProductoMaterialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('producto_materiales')->delete();

        \DB::table('producto_materiales')->insert([
            ['id'=>'NOV','nombre'=>'NOVATECH'],
            ['id'=>'ABI','nombre'=>'ABIPLEX'],
            ['id'=>'ADH','nombre'=>'ADHESIVO'],
            ['id'=>'BOL','nombre'=>'BOLSAS DE AIRE'],
            ['id'=>'BOL_KRA','nombre'=>'BOLSAS KRAFTIR'],
            ['id'=>'BUR_BOB','nombre'=>'BOBINA PLÁSTICO BURBUJA'],
            ['id'=>'BUR','nombre'=>'PROTECTOR DE BURBUJAS DE AIRE'],
            ['id'=>'CAJ','nombre'=>'CAJA CARTON ONDULADO'],
            ['id'=>'CAJ_A3','nombre'=>'CAJA CARTON ONDULADO A3'],
            ['id'=>'CAJ_A4','nombre'=>'CAJA CARTON ONDULADO A4'],
            ['id'=>'CAJ_TA','nombre'=>'CAJA DE TAPA ABATIBLE'],
            ['id'=>'CAR','nombre'=>'CARTON COMPACTO'],
            ['id'=>'CAR_2C','nombre'=>'CARTON DOBLE CANAL'],
            ['id'=>'CBM','nombre'=>'CANVAS BANNER MATISSE'],
            ['id'=>'COL','nombre'=>'TINTA COLORADO'],
            ['id'=>'DFL','nombre'=>'DECOFLOOR'],
            ['id'=>'DIB','nombre'=>'DIBON'],
            ['id'=>'DIL','nombre'=>'DILITE'],
            ['id'=>'DIS','nombre'=>'DISPA'],
            ['id'=>'DMP','nombre'=>'DIGITAL MAGNO PLUS'],
            ['id'=>'DUR','nombre'=>'DURATRANS'],
            ['id'=>'EDI','nombre'=>'EDIXION'],
            ['id'=>'EDT','nombre'=>'EASY DOT'],
            ['id'=>'ESP','nombre'=>'ESPONJITAS'],
            ['id'=>'EXP','nombre'=>'EXPLENDORLUX MIRROR'],
            ['id'=>'FAC','nombre'=>'FACE PLATE CLEANING'],
            ['id'=>'FIA','nombre'=>'FIJADOR A'],
            ['id'=>'FIB','nombre'=>'FIJADOR B'],
            ['id'=>'FOA','nombre'=>'FOAM'],
            ['id'=>'FOL','nombre'=>'FOLDING'],
            ['id'=>'GLP','nombre'=>'GLASSPACK'],
            ['id'=>'GOM','nombre'=>'GOMAS ELASTICAS'],
            ['id'=>'HJA','nombre'=>'HOJAS DE CALIBRACIÓN'],
            ['id'=>'IMN','nombre'=>'IMAN'],
            ['id'=>'KAP','nombre'=>'KAPA LINE'],
            ['id'=>'LAM_BTD','nombre'=>'BOPP TERMO DIGITAL'],
            ['id'=>'LAM','nombre'=>'LAMINADO'],
            ['id'=>'LBO','nombre'=>'LONA BLOCKOUT'],
            ['id'=>'LFT','nombre'=>'LONA FRONTLIT'],
            ['id'=>'LMH','nombre'=>'LONA MESH'],
            ['id'=>'MAD','nombre'=>'MADERA CALABO'],
            ['id'=>'MAN','nombre'=>'MAINTENANCE BOX'],
            ['id'=>'MAS','nombre'=>'MÁSCARA VERDE'],
            ['id'=>'MAT','nombre'=>'TINTA MATCHPRINT'],
            ['id'=>'MBL','nombre'=>'MÁSCARA BLANCA'],
            ['id'=>'MET','nombre'=>'METACRILATO'],
            ['id'=>'MOQ','nombre'=>'MOQUETA DIGITAL FLOOR'],
            ['id'=>'NID','nombre'=>'NIDO DE ABEJA'],
            ['id'=>'PAL','nombre'=>'PALBOARD'],
            ['id'=>'PAP','nombre'=>'PAPEL'],
            ['id'=>'PAP_PRF','nombre'=>'PAPEL PROOFING'],
            ['id'=>'PCC','nombre'=>'POLICARBONATO CELULAR'],
            ['id'=>'PEG','nombre'=>'PEGASUS'],
            ['id'=>'PET','nombre'=>'PET'],
            ['id'=>'PFE','nombre'=>'PP FERRICO'],
            ['id'=>'PHP','nombre'=>'PAPEL HEAVY POSTER'],
            ['id'=>'PKR','nombre'=>'PAPEL KRAFT LINER'],
            ['id'=>'POL','nombre'=>'POLIESTIRENO'],
            ['id'=>'PPA','nombre'=>'POLIPROPILENO ALVEOLAR'],
            ['id'=>'PPC','nombre'=>'POLIPROPILENO CELULAR'],
            ['id'=>'PPM','nombre'=>'POLIPROPILENO COMPACTO'],
            ['id'=>'PRI','nombre'=>'PRINTFOAM'],
            ['id'=>'PVC','nombre'=>'PVC'],
            ['id'=>'RAF','nombre'=>'RAFLATAC POLYLASER'],
            ['id'=>'REB','nombre'=>'REBOARD'],
            ['id'=>'REV','nombre'=>'REVELADOR'],
            ['id'=>'REY_AMC','nombre'=>'AUTO MASTERTAC CUTBACK'],
            ['id'=>'REY','nombre'=>'PAPEL FOTOCOPIA REY COPY'],
            ['id'=>'RHO','nombre'=>'TINTA ARIZONA'],
            ['id'=>'RHO_320','nombre'=>'TINTA RHO 320'],
            ['id'=>'ROL','nombre'=>'ROLLO'],
            ['id'=>'ROL_ACR','nombre'=>'ROLLO ACR 132 TTE'],
            ['id'=>'ROL_CIN','nombre'=>'ROLLO CINTA'],
            ['id'=>'ROL_460','nombre'=>'ROLLO CINTA 460'],
            ['id'=>'ROL_1030','nombre'=>'ROLLO CINTA REF.1030'],
            ['id'=>'RUP','nombre'=>'ROLL UP'],
            ['id'=>'SOB','nombre'=>'SOBRES BURBUJA DE AIRE'],
            ['id'=>'SYN','nombre'=>'SYNAPS OM'],
            ['id'=>'TAP','nombre'=>'TAPA'],
            ['id'=>'TAU','nombre'=>'TINTA TAURO'],
            ['id'=>'TCH','nombre'=>'TEXTIL CARPET HEAVY'],
            ['id'=>'TFB','nombre'=>'TEXTIL FUNKY BLOCKOUT'],
            ['id'=>'TOA','nombre'=>'TOALLITAS LIMPIEZA'],
            ['id'=>'TRA','nombre'=>'TRANSFER'],
            ['id'=>'TSB','nombre'=>'TEXTIL SAMBA'],
            ['id'=>'TTS','nombre'=>'TEXTIL TANGO'],
            ['id'=>'VBO','nombre'=>'VINILO BOARD'],
            ['id'=>'VCO','nombre'=>'VINILO CORTE'],
            ['id'=>'VIN_SRF','nombre'=>'STREET RAP + FLOORGRIP ANT (COMBO)'],
            ['id'=>'VIN','nombre'=>'VINILO'],
            ['id'=>'VIN_LSU','nombre'=>'VINILO + LAMINADO SUELO MACTAC ( COMBO )'],
            ['id'=>'VMP','nombre'=>'VINILO MONO PERM'],
            ['id'=>'VMR','nombre'=>'VINILO MONO REMOV'],
            ['id'=>'VPT','nombre'=>'VINILO POLITAPE'],
            ['id'=>'VVE','nombre'=>'VINILO VELLEDA'],
            ['id'=>'VWL','nombre'=>'VINILO 3M'],
            ['id'=>'WHI','nombre'=>'PAPEL WHITEBACK'],
            ['id'=>'WPF','nombre'=>'WINDOWS PERFORADO'],
        ]);
    }
}


