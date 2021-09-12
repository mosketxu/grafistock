<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class ProductoMaterialesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return vonombrecorto
     */
    public function run()
    {
        \DB::table('producto_materiales')->delete();

        \DB::table('producto_materiales')->insert([
            ['nombrecorto'=>'NOV','nombre'=>'NOVATECH'],
            ['nombrecorto'=>'ABI','nombre'=>'ABIPLEX'],
            ['nombrecorto'=>'ADH','nombre'=>'ADHESIVO'],
            ['nombrecorto'=>'DFL','nombre'=>'DECOFLOOR'],
            // ['nombrecorto'=>'NOV','nombre'=>'NOVATECH'],
            // ['nombrecorto'=>'ABI','nombre'=>'ABIPLEX'],
            // ['nombrecorto'=>'ADH','nombre'=>'ADHESIVO'],
            // ['nombrecorto'=>'BOL','nombre'=>'BOLSAS DE AIRE'],
            // ['nombrecorto'=>'BOL_KRA','nombre'=>'BOLSAS KRAFTIR'],
            // ['nombrecorto'=>'BUR_BOB','nombre'=>'BOBINA PLÁSTICO BURBUJA'],
            // ['nombrecorto'=>'BUR','nombre'=>'PROTECTOR DE BURBUJAS DE AIRE'],
            // ['nombrecorto'=>'CAJ','nombre'=>'CAJA CARTON ONDULADO'],
            // ['nombrecorto'=>'CAJ_A3','nombre'=>'CAJA CARTON ONDULADO A3'],
            // ['nombrecorto'=>'CAJ_A4','nombre'=>'CAJA CARTON ONDULADO A4'],
            // ['nombrecorto'=>'CAJ_TA','nombre'=>'CAJA DE TAPA ABATIBLE'],
            // ['nombrecorto'=>'CAR','nombre'=>'CARTON COMPACTO'],
            // ['nombrecorto'=>'CAR_2C','nombre'=>'CARTON DOBLE CANAL'],
            // ['nombrecorto'=>'CBM','nombre'=>'CANVAS BANNER MATISSE'],
            // ['nombrecorto'=>'COL','nombre'=>'TINTA COLORADO'],
            // ['nombrecorto'=>'DFL','nombre'=>'DECOFLOOR'],
            // ['nombrecorto'=>'DIB','nombre'=>'DIBON'],
            // ['nombrecorto'=>'DIL','nombre'=>'DILITE'],
            // ['nombrecorto'=>'DIS','nombre'=>'DISPA'],
            // ['nombrecorto'=>'DMP','nombre'=>'DIGITAL MAGNO PLUS'],
            // ['nombrecorto'=>'DUR','nombre'=>'DURATRANS'],
            // ['nombrecorto'=>'EDI','nombre'=>'EDIXION'],
            // ['nombrecorto'=>'EDT','nombre'=>'EASY DOT'],
            // ['nombrecorto'=>'ESP','nombre'=>'ESPONJITAS'],
            // ['nombrecorto'=>'EXP','nombre'=>'EXPLENDORLUX MIRROR'],
            // ['nombrecorto'=>'FAC','nombre'=>'FACE PLATE CLEANING'],
            // ['nombrecorto'=>'FIA','nombre'=>'FIJADOR A'],
            // ['nombrecorto'=>'FIB','nombre'=>'FIJADOR B'],
            // ['nombrecorto'=>'FOA','nombre'=>'FOAM'],
            // ['nombrecorto'=>'FOL','nombre'=>'FOLDING'],
            // ['nombrecorto'=>'GLP','nombre'=>'GLASSPACK'],
            // ['nombrecorto'=>'GOM','nombre'=>'GOMAS ELASTICAS'],
            // ['nombrecorto'=>'HJA','nombre'=>'HOJAS DE CALIBRACIÓN'],
            // ['nombrecorto'=>'IMN','nombre'=>'IMAN'],
            // ['nombrecorto'=>'KAP','nombre'=>'KAPA LINE'],
            // ['nombrecorto'=>'LAM_BTD','nombre'=>'BOPP TERMO DIGITAL'],
            // ['nombrecorto'=>'LAM','nombre'=>'LAMINADO'],
            // ['nombrecorto'=>'LBO','nombre'=>'LONA BLOCKOUT'],
            // ['nombrecorto'=>'LFT','nombre'=>'LONA FRONTLIT'],
            // ['nombrecorto'=>'LMH','nombre'=>'LONA MESH'],
            // ['nombrecorto'=>'MAD','nombre'=>'MADERA CALABO'],
            // ['nombrecorto'=>'MAN','nombre'=>'MAINTENANCE BOX'],
            // ['nombrecorto'=>'MAS','nombre'=>'MÁSCARA VERDE'],
            // ['nombrecorto'=>'MAT','nombre'=>'TINTA MATCHPRINT'],
            // ['nombrecorto'=>'MBL','nombre'=>'MÁSCARA BLANCA'],
            // ['nombrecorto'=>'MET','nombre'=>'METACRILATO'],
            // ['nombrecorto'=>'MOQ','nombre'=>'MOQUETA DIGITAL FLOOR'],
            // ['nombrecorto'=>'NID','nombre'=>'NIDO DE ABEJA'],
            // ['nombrecorto'=>'PAL','nombre'=>'PALBOARD'],
            // ['nombrecorto'=>'PAP','nombre'=>'PAPEL'],
            // ['nombrecorto'=>'PAP_PRF','nombre'=>'PAPEL PROOFING'],
            // ['nombrecorto'=>'PCC','nombre'=>'POLICARBONATO CELULAR'],
            // ['nombrecorto'=>'PEG','nombre'=>'PEGASUS'],
            // ['nombrecorto'=>'PET','nombre'=>'PET'],
            // ['nombrecorto'=>'PFE','nombre'=>'PP FERRICO'],
            // ['nombrecorto'=>'PHP','nombre'=>'PAPEL HEAVY POSTER'],
            // ['nombrecorto'=>'PKR','nombre'=>'PAPEL KRAFT LINER'],
            // ['nombrecorto'=>'POL','nombre'=>'POLIESTIRENO'],
            // ['nombrecorto'=>'PPA','nombre'=>'POLIPROPILENO ALVEOLAR'],
            // ['nombrecorto'=>'PPC','nombre'=>'POLIPROPILENO CELULAR'],
            // ['nombrecorto'=>'PPM','nombre'=>'POLIPROPILENO COMPACTO'],
            // ['nombrecorto'=>'PRI','nombre'=>'PRINTFOAM'],
            // ['nombrecorto'=>'PVC','nombre'=>'PVC'],
            // ['nombrecorto'=>'RAF','nombre'=>'RAFLATAC POLYLASER'],
            // ['nombrecorto'=>'REB','nombre'=>'REBOARD'],
            // ['nombrecorto'=>'REV','nombre'=>'REVELADOR'],
            // ['nombrecorto'=>'REY_AMC','nombre'=>'AUTO MASTERTAC CUTBACK'],
            // ['nombrecorto'=>'REY','nombre'=>'PAPEL FOTOCOPIA REY COPY'],
            // ['nombrecorto'=>'RHO','nombre'=>'TINTA ARIZONA'],
            // ['nombrecorto'=>'RHO_320','nombre'=>'TINTA RHO 320'],
            // ['nombrecorto'=>'ROL','nombre'=>'ROLLO'],
            // ['nombrecorto'=>'ROL_ACR','nombre'=>'ROLLO ACR 132 TTE'],
            // ['nombrecorto'=>'ROL_CIN','nombre'=>'ROLLO CINTA'],
            // ['nombrecorto'=>'ROL_460','nombre'=>'ROLLO CINTA 460'],
            // ['nombrecorto'=>'ROL_1030','nombre'=>'ROLLO CINTA REF.1030'],
            // ['nombrecorto'=>'RUP','nombre'=>'ROLL UP'],
            // ['nombrecorto'=>'SOB','nombre'=>'SOBRES BURBUJA DE AIRE'],
            // ['nombrecorto'=>'SYN','nombre'=>'SYNAPS OM'],
            // ['nombrecorto'=>'TAP','nombre'=>'TAPA'],
            // ['nombrecorto'=>'TAU','nombre'=>'TINTA TAURO'],
            // ['nombrecorto'=>'TCH','nombre'=>'TEXTIL CARPET HEAVY'],
            // ['nombrecorto'=>'TFB','nombre'=>'TEXTIL FUNKY BLOCKOUT'],
            // ['nombrecorto'=>'TOA','nombre'=>'TOALLITAS LIMPIEZA'],
            // ['nombrecorto'=>'TRA','nombre'=>'TRANSFER'],
            // ['nombrecorto'=>'TSB','nombre'=>'TEXTIL SAMBA'],
            // ['nombrecorto'=>'TTS','nombre'=>'TEXTIL TANGO'],
            // ['nombrecorto'=>'VBO','nombre'=>'VINILO BOARD'],
            // ['nombrecorto'=>'VCO','nombre'=>'VINILO CORTE'],
            // ['nombrecorto'=>'VIN_SRF','nombre'=>'STREET RAP + FLOORGRIP ANT (COMBO)'],
            // ['nombrecorto'=>'VIN','nombre'=>'VINILO'],
            // ['nombrecorto'=>'VIN_LSU','nombre'=>'VINILO + LAMINADO SUELO MACTAC ( COMBO )'],
            // ['nombrecorto'=>'VMP','nombre'=>'VINILO MONO PERM'],
            // ['nombrecorto'=>'VMR','nombre'=>'VINILO MONO REMOV'],
            // ['nombrecorto'=>'VPT','nombre'=>'VINILO POLITAPE'],
            // ['nombrecorto'=>'VVE','nombre'=>'VINILO VELLEDA'],
            // ['nombrecorto'=>'VWL','nombre'=>'VINILO 3M'],
            // ['nombrecorto'=>'WHI','nombre'=>'PAPEL WHITEBACK'],
            // ['nombrecorto'=>'WPF','nombre'=>'WINDOWS PERFORADO'],
        ]);
    }
}


