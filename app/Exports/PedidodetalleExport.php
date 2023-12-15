<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PedidodetalleExport implements FromCollection,WithHeadings
{
    public $search;
    public $filtroclipro;
    public $filtroanyo;
    public $filtromes;
    public $pedidos;
    public $message;

    function __construct($seleccion){
        $this->pedidos=$seleccion;
    }

    public function headings(): array{
        return [
            'Pedido','Proveedor','Solicitado Por', 'Fecha Pedido','Fecha Prevista','Fecha Recepción','Ubicación','Estado','Observaciones','Total Pedido','Referencia','Descripcion','Cantidad','Total',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return $this->pedidos;
    }

}
