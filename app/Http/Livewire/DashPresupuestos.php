<?php

namespace App\Http\Livewire;

use App\Exports\ExportPresupuestos;
use Livewire\Component;
use App\Models\Presupuesto;
use App\Models\{User, Entidad};
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashPresupuestos extends Component
{
    public $filtroanyomesIni='';
    public $filtroanyomesFin='';
    public $filtroventasIni='';
    public $filtroventasFin='';
    public $filtroentidad='';
    public $filtrosolicitante='';
    public $filtroestado='';

    public function render()
    {
        $presupuestos=Presupuesto::query()
        ->join('entidades','entidades.id','presupuestos.entidad_id')
        ->join('users','users.id','presupuestos.solicitante_id')
        ->select('entidades.entidad as entidad','users.name as comercial','presupuestos.estado as estado')
        ->selectRaw('count(presupuestos.id) as numpresups')
        ->selectRaw('sum(presupuestos.precioventa - presupuestos.preciocoste ) as margenbruto')
        ->selectRaw('sum(presupuestos.precioventa) as ventas')
        ->filtrosPresupuestos($this->filtroentidad,$this->filtrosolicitante,$this->filtroestado,$this->filtroanyomesIni,$this->filtroanyomesFin,$this->filtroventasIni,$this->filtroventasFin,)
        ->groupBy('entidad','estado','comercial')
        ->get();
        $clientes = Entidad::whereIn('entidadtipo_id',['1','3'])->select('id','entidad')->orderBy('entidad')->get();
        $solicitantes=User::role('Comercial')->orderBy('name')->get();
        return view('livewire.dash-presupuestos',compact('presupuestos','solicitantes','clientes'));
    }

    public function updatingFiltroclipro(){
        $this->resetPage();
    }
    public function updatingFiltroanyo(){
        $this->resetPage();
    }
    public function updatingFiltromes(){
        $this->resetPage();
    }

    public function exportEstadisticaPresupuestosXLS()
    {
        $sel=Presupuesto::query()
        ->join('entidades','entidades.id','presupuestos.entidad_id')
        ->join('users','users.id','presupuestos.solicitante_id')
        ->select('entidades.entidad as entidad','users.name as comercial',
            DB::raw('(CASE WHEN presupuestos.estado = ' . 1 . ' THEN "Aceptado" WHEN presupuestos.estado='. 0 .' then "En Curso" ELSE "Rechazado" END) AS estado')            )
        ->selectRaw('count(presupuestos.id) as numpresups')
        ->selectRaw('sum(presupuestos.precioventa - presupuestos.preciocoste ) as margenbruto')
        ->selectRaw('sum(presupuestos.precioventa) as ventas')
        ->filtrosPresupuestos($this->filtroentidad,$this->filtrosolicitante,$this->filtroestado,$this->filtroanyomesIni,$this->filtroanyomesFin,$this->filtroventasIni,$this->filtroventasFin,)
        ->groupBy('entidad','estado','comercial')
        ->get();

        $filas=$sel->count();

        $ent=$this->filtroentidad ? Entidad::find($this->filtroentidad)->entidad:'';
        $sol=$this->filtrosolicitante ? User::find($this->filtrosolicitante):'';
        $est='';
        if($this->filtroestado!=''){
            switch ($this->filtroestado) {
                case 0:
                    $est="En Curso";
                    break;
                case 1:
                    $est="Aprobado";
                    break;
                case 2:
                    $est="Rechazado";
                    break;
            }
        }

return Excel::download(new ExportPresupuestos(
            $sel,
            $est,
            $ent,
            $sol,
            $this->filtroanyomesIni,
            $this->filtroanyomesFin,
            $this->filtroventasIni,
            $this->filtroventasFin,
            $filas,
        ), 'estadisticapresupuestos.xlsx');

    }
}
