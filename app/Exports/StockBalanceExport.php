<?php

namespace App\Exports;

use App\Models\{Entidad};
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockBalanceExport implements FromCollection,WithHeadings
{

    protected $search='';
    protected $filtroclipro='';
    protected $filtromaterial='';
    protected $filtroacabado='';
    protected $filtrofamilia='';
    protected $filtroproducto='';
    protected $filtrodescripcion='';
    protected $filtrosolicitante='';
    protected $filtroanyo='';
    protected $filtromes='';
    protected $filtrofecha='';
    protected $tipo='';

    function __construct($search, $filtroclipro, $filtromaterial, $filtrofamilia, $filtroacabado, $filtroproducto, $filtrodescripcion, $filtrosolicitante, $filtroanyo, $filtromes, $filtrofecha, $tipo  ) {
        $this->search=$search;
        $this->filtroclipro=$filtroclipro;
        $this->filtromaterial=$filtromaterial;
        $this->filtrofamilia=$filtrofamilia;
        $this->filtroacabado=$filtroacabado;
        $this->filtroproducto=$filtroproducto;
        $this->filtrodescripcion=$filtrodescripcion;
        $this->filtrosolicitante=$filtrosolicitante;
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
            'productos.preciocompra'
            )
        ->selectRaw('sum(stock_movimientos.cantidad) as balance')
        ->groupBy($this->tipo)
        ->get();
        // $exportacion=Entidad::join('productos','entidades.id','productos.entidad_id')
        // ->join('stock_movimientos','productos.id','stock_movimientos.producto_id')
        // ->join('producto_materiales','productos.material_id','producto_materiales.id')
        // ->join('producto_familias','productos.familia_id','producto_familias.id')
        // ->join('producto_acabados','productos.acabado_id','producto_acabados.id')
        // ->select('entidades.entidad','entidades.cuentactblepro','entidades.cuentactblecli','producto_materiales.nombre as material','producto_acabados.nombre as acabado','productos.referencia','productos.descripcion','productos.preciocompra')
        // ->selectRaw('sum(stock_movimientos.cantidad) as balance')
        // ->where('stock_movimientos.tipomovimiento','<>','R')
        // ->searchYear('fechamovimiento',$this->filtroanyo)
        // ->searchMes('fechamovimiento',$this->filtromes)
        // ->when($this->filtroproducto!='', function ($query){
        //     $query->where('producto_id',$this->filtroproducto);
        // })
        // ->when($this->filtrodescripcion!='', function ($query){
        //     $query->where('descripcion','LIKE','%'.$this->filtrodescripcion.'%');
        // })
        // ->when($this->filtromaterial!='', function ($query){
        //     $query->where('material_id',$this->filtromaterial);
        // })
        // ->when($this->filtrofamilia!='', function ($query){
        //     $query->where('familia_id',$this->filtrofamilia);
        // })
        // ->when($this->filtroacabado!='', function ($query){
        //     $query->where('acabado_id',$this->filtroacabado);
        // })
        // ->when($this->filtroclipro!='', function ($query){
        //     $query->where('entidad_id',$this->filtroclipro);
        // })
        // ->searchYear('fechamovimiento',$this->filtroanyo)
        // ->searchMes('fechamovimiento',$this->filtromes)
        // ->groupBy($this->tipo)
        // ->get();

        return $exportacion;
    }
}
