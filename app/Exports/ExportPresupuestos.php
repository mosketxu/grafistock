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

class ExportPresupuestos implements FromCollection,WithCustomStartCell,WithHeadings,WithStrictNullComparison,ShouldAutoSize,WithStyles
{

    function __construct($seleccion,$estado,$entidad,$comercial,$fi,$ff,$vi,$vf,$filas){
        $this->estado=$estado;
        $this->entidad=$entidad;
        $this->comercial=$comercial;
        $this->fi=$fi;
        $this->ff=$ff;
        $this->vi=$vi;
        $this->vf=$vf;
        $this->presupuestos=$seleccion;
        $this->filas=$filas+10;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B2')->getFont()->setSize(16);
        $sheet->getStyle('B2')->getFont()->setBold(true);
        $sheet->getStyle('F:G')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet->getStyle('B4:B7')->getFont()->setItalic(true);
        $sheet->getStyle('B4:F7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('B4:F7')->getFont()->setItalic(true);
        $sheet->getStyle('9:9')->getFont()->setBold(true);
        $f=$this->filas-1;
        $sheet->setCellValue('D'.$this->filas, 'Totales');
        $sheet->setCellValue('E'.$this->filas,'=SUM(E10:E'.$f.')');
        $sheet->setCellValue('F'.$this->filas,'=SUM(F10:F'.$f.')');
        $sheet->setCellValue('G'.$this->filas,'=SUM(G10:G'.$f.')');
        $sheet->getStyle($this->filas.':'.$this->filas)->getFont()->setBold(true);
        $sheet->getStyle($this->filas.':'.$this->filas)->getFill()->getStartColor()->setARGB('FFFF0000');
        $sheet->getStyle('B2')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE);
        $sheet->getStyle('B2')->getFill()->getStartColor()->setARGB('FFFF0000');
        $r= "D$this->filas:G$this->filas";
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
            ['Filtro Entidad',$this->entidad],
            ['Filtro Periodo:','De',$this->fi,'A:',$this->ff],
            ['Filtro Ventas:','De',$this->vi,'A:',$this->vf],
            [' ',' '],
            ['Cliente','Comercial','Estado','Nº Presups', 'Margen Bruto','Cifra Ventas']
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return $this->presupuestos;
    }

    public function startCell(): string
    {
        return 'B2';
    }
}
