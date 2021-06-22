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
            ['sigla'=>'NOV','nombre'=>'NOVATECH'],
            ['sigla'=>'ABI','nombre'=>'ABIPLEX'],
            ['sigla'=>'ADH','nombre'=>'ADHESIVO'],
            ['sigla'=>'BOL','nombre'=>'BOLSAS DE AIRE'],
            ['sigla'=>'BOL_KRA','nombre'=>'BOLSAS KRAFTIR'],
            ['sigla'=>'BUR_BOB','nombre'=>'BOBINA PLÁSTICO BURBUJA'],
            ['sigla'=>'BUR','nombre'=>'PROTECTOR DE BURBUJAS DE AIRE'],
            ['sigla'=>'CAJ','nombre'=>'CAJA CARTON ONDULADO'],
            ['sigla'=>'CAJ_A3','nombre'=>'CAJA CARTON ONDULADO A3'],
            ['sigla'=>'CAJ_A4','nombre'=>'CAJA CARTON ONDULADO A4'],
            ['sigla'=>'CAJ_TA','nombre'=>'CAJA DE TAPA ABATIBLE'],
            ['sigla'=>'CAR','nombre'=>'CARTON COMPACTO'],
            ['sigla'=>'CAR_2C','nombre'=>'CARTON DOBLE CANAL'],
            ['sigla'=>'CBM','nombre'=>'CANVAS BANNER MATISSE'],
            ['sigla'=>'COL','nombre'=>'TINTA COLORADO'],
            ['sigla'=>'DFL','nombre'=>'DECOFLOOR'],
            ['sigla'=>'DIB','nombre'=>'DIBON'],
            ['sigla'=>'DIL','nombre'=>'DILITE'],
            ['sigla'=>'DIS','nombre'=>'DISPA'],
            ['sigla'=>'DMP','nombre'=>'DIGITAL MAGNO PLUS'],
            ['sigla'=>'DUR','nombre'=>'DURATRANS'],
            ['sigla'=>'EDI','nombre'=>'EDIXION'],
            ['sigla'=>'EDT','nombre'=>'EASY DOT'],
            ['sigla'=>'ESP','nombre'=>'ESPONJITAS'],
            ['sigla'=>'EXP','nombre'=>'EXPLENDORLUX MIRROR'],
            ['sigla'=>'FAC','nombre'=>'FACE PLATE CLEANING'],
            ['sigla'=>'FIA','nombre'=>'FIJADOR A'],
            ['sigla'=>'FIB','nombre'=>'FIJADOR B'],
            ['sigla'=>'FOA','nombre'=>'FOAM'],
            ['sigla'=>'FOL','nombre'=>'FOLDING'],
            ['sigla'=>'GLP','nombre'=>'GLASSPACK'],
            ['sigla'=>'GOM','nombre'=>'GOMAS ELASTICAS'],
            ['sigla'=>'HJA','nombre'=>'HOJAS DE CALIBRACIÓN'],
            ['sigla'=>'IMN','nombre'=>'IMAN'],
            ['sigla'=>'KAP','nombre'=>'KAPA LINE'],
            ['sigla'=>'LAM_BTD','nombre'=>'BOPP TERMO DIGITAL'],
            ['sigla'=>'LAM','nombre'=>'LAMINADO'],
            ['sigla'=>'LBO','nombre'=>'LONA BLOCKOUT'],
            ['sigla'=>'LFT','nombre'=>'LONA FRONTLIT'],
            ['sigla'=>'LMH','nombre'=>'LONA MESH'],
            ['sigla'=>'MAD','nombre'=>'MADERA CALABO'],
            ['sigla'=>'MAN','nombre'=>'MAINTENANCE BOX'],
            ['sigla'=>'MAS','nombre'=>'MÁSCARA VERDE'],
            ['sigla'=>'MAT','nombre'=>'TINTA MATCHPRINT'],
            ['sigla'=>'MBL','nombre'=>'MÁSCARA BLANCA'],
            ['sigla'=>'MET','nombre'=>'METACRILATO'],
            ['sigla'=>'MOQ','nombre'=>'MOQUETA DIGITAL FLOOR'],
            ['sigla'=>'NID','nombre'=>'NIDO DE ABEJA'],
            ['sigla'=>'PAL','nombre'=>'PALBOARD'],
            ['sigla'=>'PAP','nombre'=>'PAPEL'],
            ['sigla'=>'PAP_PRF','nombre'=>'PAPEL PROOFING'],
            ['sigla'=>'PCC','nombre'=>'POLICARBONATO CELULAR'],
            ['sigla'=>'PEG','nombre'=>'PEGASUS'],
            ['sigla'=>'PET','nombre'=>'PET'],
            ['sigla'=>'PFE','nombre'=>'PP FERRICO'],
            ['sigla'=>'PHP','nombre'=>'PAPEL HEAVY POSTER'],
            ['sigla'=>'PKR','nombre'=>'PAPEL KRAFT LINER'],
            ['sigla'=>'POL','nombre'=>'POLIESTIRENO'],
            ['sigla'=>'PPA','nombre'=>'POLIPROPILENO ALVEOLAR'],
            ['sigla'=>'PPC','nombre'=>'POLIPROPILENO CELULAR'],
            ['sigla'=>'PPM','nombre'=>'POLIPROPILENO COMPACTO'],
            ['sigla'=>'PRI','nombre'=>'PRINTFOAM'],
            ['sigla'=>'PVC','nombre'=>'PVC'],
            ['sigla'=>'RAF','nombre'=>'RAFLATAC POLYLASER'],
            ['sigla'=>'REB','nombre'=>'REBOARD'],
            ['sigla'=>'REV','nombre'=>'REVELADOR'],
            ['sigla'=>'REY_AMC','nombre'=>'AUTO MASTERTAC CUTBACK'],
            ['sigla'=>'REY','nombre'=>'PAPEL FOTOCOPIA REY COPY'],
            ['sigla'=>'RHO','nombre'=>'TINTA ARIZONA'],
            ['sigla'=>'RHO_320','nombre'=>'TINTA RHO 320'],
            ['sigla'=>'ROL','nombre'=>'ROLLO'],
            ['sigla'=>'ROL_ACR','nombre'=>'ROLLO ACR 132 TTE'],
            ['sigla'=>'ROL_CIN','nombre'=>'ROLLO CINTA'],
            ['sigla'=>'ROL_460','nombre'=>'ROLLO CINTA 460'],
            ['sigla'=>'ROL_1030','nombre'=>'ROLLO CINTA REF.1030'],
            ['sigla'=>'RUP','nombre'=>'ROLL UP'],
            ['sigla'=>'SOB','nombre'=>'SOBRES BURBUJA DE AIRE'],
            ['sigla'=>'SYN','nombre'=>'SYNAPS OM'],
            ['sigla'=>'TAP','nombre'=>'TAPA'],
            ['sigla'=>'TAU','nombre'=>'TINTA TAURO'],
            ['sigla'=>'TCH','nombre'=>'TEXTIL CARPET HEAVY'],
            ['sigla'=>'TFB','nombre'=>'TEXTIL FUNKY BLOCKOUT'],
            ['sigla'=>'TOA','nombre'=>'TOALLITAS LIMPIEZA'],
            ['sigla'=>'TRA','nombre'=>'TRANSFER'],
            ['sigla'=>'TSB','nombre'=>'TEXTIL SAMBA'],
            ['sigla'=>'TTS','nombre'=>'TEXTIL TANGO'],
            ['sigla'=>'VBO','nombre'=>'VINILO BOARD'],
            ['sigla'=>'VCO','nombre'=>'VINILO CORTE'],
            ['sigla'=>'VIN_SRF','nombre'=>'STREET RAP + FLOORGRIP ANT (COMBO)'],
            ['sigla'=>'VIN','nombre'=>'VINILO'],
            ['sigla'=>'VIN_LSU','nombre'=>'VINILO + LAMINADO SUELO MACTAC ( COMBO )'],
            ['sigla'=>'VMP','nombre'=>'VINILO MONO PERM'],
            ['sigla'=>'VMR','nombre'=>'VINILO MONO REMOV'],
            ['sigla'=>'VPT','nombre'=>'VINILO POLITAPE'],
            ['sigla'=>'VVE','nombre'=>'VINILO VELLEDA'],
            ['sigla'=>'VWL','nombre'=>'VINILO 3M'],
            ['sigla'=>'WHI','nombre'=>'PAPEL WHITEBACK'],
            ['sigla'=>'WPF','nombre'=>'WINDOWS PERFORADO'],
        ]);
    }
}


