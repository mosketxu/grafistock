<?php

namespace App\Exports;

use App\Models\Presupuesto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportPresupuestosSinAgrupar implements FromCollection,WithCustomStartCell,WithHeadings,WithStrictNullComparison,ShouldAutoSize,WithStyles
{
    public $desplazamiento=10;
    public $mes;
    public $estado;
    public $entidad;
    public $comercial;
    public $presupuesto;
    public $fechapresupuesto;
    public $fi;
    public $ff;
    public $vi;
    public $vf;
    public $presupuestos;
    public $filas;

    function __construct($mes,$seleccion,$estado,$entidad,$comercial,$fi,$ff,$vi,$vf,$filas){
        $this->mes=$mes;
        $this->estado=$estado;
        $this->entidad=$entidad;
        $this->comercial=$comercial;
        $this->fi=$fi;
        $this->ff=$ff;
        $this->vi=$vi;
        $this->vf=$vf;
        $this->presupuestos=$seleccion;
        $this->filas=$filas+$this->desplazamiento+1;
    }

    public function styles(Worksheet $sheet)
    {
        //columnas con formulas
        // if($this->mes!=true){
        //     $t1='D';$t2='E';$t3='F';$t4='G';
        // }else{
            // $t1='E';$t2='F';$t3='G';$t4='H';
            $t1='E';$t2='F';$t3='G';$t4='H';$t5='I';
        // }
        //titulo
        $sheet->getStyle('B2')->getFont()->setSize(16);
        $sheet->getStyle('B2')->getFont()->setBold(true);
        //columnas con datos economicos:punto millar y 2 decimales
        $sheet->getStyle($t3.':'.$t4)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        //columnas con datos economicos:porcentaje
        $sheet->getStyle($t5)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);
        //Filtros
        $sheet->getStyle('B4:B8')->getFont()->setItalic(true);
        $sheet->getStyle('B4:F8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('B4:F8')->getFont()->setItalic(true);
        $sheet->getStyle($this->desplazamiento.':'.$this->desplazamiento)->getFont()->setBold(true);
        $f=$this->filas-1;
        //Totales
        $sheet->setCellValue($t1.$this->filas, 'Totales');
        $sheet->setCellValue($t2.$this->filas,'=SUM('.$t2.$this->desplazamiento.':'.$t2.$f.')');
        $sheet->setCellValue($t3.$this->filas,'=SUM('.$t3.$this->desplazamiento.':'.$t3.$f.')');
        $sheet->setCellValue($t4.$this->filas,'=SUM('.$t4.$this->desplazamiento.':'.$t4.$f.')');
        $sheet->getStyle($this->filas.':'.$this->filas)->getFont()->setBold(true);
        $sheet->getStyle($this->filas.':'.$this->filas)->getFill()->getStartColor()->setARGB('FFFF0000');
        $sheet->getStyle('B2')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE);
        $sheet->getStyle('B2')->getFill()->getStartColor()->setARGB('FFFF0000');
        $r= "$t1$this->filas:$t4$this->filas";
        $sheet->getStyle($r)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setRGB('cee0f2');
        $sheet->getStyle($r)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle($r)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
    }


    public function headings(): array{
        return [
            ['Estadísticas de presupuestos',now()],
            [' ',' '],
            ['Filtro Estado',$this->estado],
            ['Filtro Comercial',$this->comercial->name?? '',],
            ['Filtro Entidad',$this->entidad],
            ['Filtro Periodo:','De',$this->fi,'A:',$this->ff],
            ['Filtro Ventas:','De',$this->vi,'A:',$this->vf],
            [' ',' '],
            ['Cliente','Comercial','Presupuesto','Fecha Presupuesto','Precio Coste','Precio Venta','Margen','% Margen','Estado']
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return $this->presupuestos;
    }

    public function startCell(): string
    {
        return 'B2';
    }
}
