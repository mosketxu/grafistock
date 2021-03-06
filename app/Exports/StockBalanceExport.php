<?php

namespace App\Exports;

use App\Models\{Entidad};
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockBalanceExport implements FromCollection,WithHeadings
{

    protected $search='';
    protected $filtroclipro='';
    protected $filtromaterial='';
    protected $filtroacabado='';
    protected $filtrofamilia='';
    protected $filtrodescripcion='';
    protected $filtroanyo='';
    protected $filtromes='';
    protected $filtrofecha='';
    protected $tipo='';

    function __construct($search, $filtroclipro, $filtromaterial, $filtrofamilia, $filtroacabado,  $filtrodescripcion, $filtroanyo, $filtromes, $filtrofecha, $tipo  ) {
        $this->search=$search;
        $this->filtroclipro=$filtroclipro;
        $this->filtromaterial=$filtromaterial;
        $this->filtrofamilia=$filtrofamilia;
        $this->filtroacabado=$filtroacabado;
        $this->filtrodescripcion=$filtrodescripcion;
        $this->filtroanyo=$filtroanyo;
        $this->filtromes=$filtromes;
        $this->filtrofecha=$filtrofecha;
        $this->filtrofecha=$filtrofecha;
        $this->tipo=$tipo;
    }

    public function headings(): array
    {
        return [
            'Entidad',
            'Cuenta Proveedor',
            'Cuenta Cliente',
            'Familia',
            'Material',
            'Acabado',
            'Referencia',
            'Descripción',
            '€ Compra',
            'Cantidad Stock',
            '€ Total',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $exportacion=Entidad::join('productos','entidades.id','productos.entidad_id')
        ->join('stock_movimientos','productos.id','stock_movimientos.producto_id')
        ->join('producto_materiales','productos.material_id','producto_materiales.id')
        ->join('producto_familias','productos.familia_id','producto_familias.id')
        ->join('producto_acabados','productos.acabado_id','producto_acabados.id')
        ->select(
            'entidades.entidad',
            'entidades.cuentactblepro',
            'entidades.cuentactblecli',
            'producto_familias.nombre as familia',
            'producto_materiales.nombre as material',
            'producto_acabados.nombre as acabado',
            'productos.referencia',
            'productos.descripcion',
            'productos.preciocompra as precio',
            )
        ->selectRaw('sum(stock_movimientos.cantidad) as balance')
        ->selectRaw('sum(stock_movimientos.cantidad * productos.preciocompra) as total')
        ->groupBy($this->tipo)
        ->get();

        return $exportacion;
    }
}
