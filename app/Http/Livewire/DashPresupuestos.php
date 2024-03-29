<?php

namespace App\Http\Livewire;

use App\Exports\ExportPresupuestos;
use App\Exports\ExportPresupuestosSinAgrupar;
use Livewire\Component;
use App\Models\Presupuesto;
use App\Models\{User, Entidad};
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DashPresupuestos extends Component
{
    public $filtroPmin='';
    public $filtroFi='';
    public $filtroFf='';
    public $filtroventasIni='';
    public $filtroventasFin='';
    public $filtroentidad='';
    public $filtrosolicitante='';
    public $filtroestado='';
    public $mesanyo='';
    public $ccliente='1';
    public $ccomercial='1';
    public $qmes='';
    public $alerta='';



    public function render(){
        // $presupuestos=$this->estadistica();
        $presupuestos=Presupuesto::presupuestos(
            $this->mesanyo,
            $this->filtroentidad,
            $this->filtrosolicitante,
            $this->filtroestado,
            $this->filtroFi,
            $this->filtroFf,
            $this->filtroventasIni,
            $this->filtroventasFin,
            $this->ccliente,
            $this->ccomercial);

        $clientes = Entidad::whereIn('entidadtipo_id',['1','3'])->select('id','entidad')->orderBy('entidad')->get();
        $solicitantes=User::role('Comercial')->orderBy('name')->get();
        return view('livewire.dash-presupuestos',compact('presupuestos','solicitantes','clientes'));
    }

    public function updatedCcliente(){if($this->ccliente!='1') $this->filtroentidad='';}

    public function updatedCcomercial(){if($this->ccomercial!='1') $this->filtrosolicitante='';}

    public function UpdatedFiltroFi(){
        $this->alerta='';
        if($this->filtroFf && $this->filtroFi>$this->filtroFf){
            $this->alerta='La fecha inicial no puede ser superior a la fecha final.';
            $this->filtroFi=null;
        }
    }

    public function UpdatedFiltroFf(){
        $this->alerta='';
        if($this->filtroFi && $this->filtroFf<$this->filtroFi){
            $this->alerta='La fecha final no puede ser inferior a la fecha inicial.';
            $this->filtroFf=null;
        }
    }

    public function exportEstadisticaPresupuestosXLS(){
        $sel=Presupuesto::presupuestosXLS($this->mesanyo,$this->filtroentidad,$this->filtrosolicitante,$this->filtroestado,$this->filtroFi,$this->filtroFf,$this->filtroventasIni,$this->filtroventasFin);
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
            $this->mesanyo,
            $sel,
            $est,
            $ent,
            $sol,
            $this->filtroFi,
            $this->filtroFf,
            $this->filtroventasIni,
            $this->filtroventasFin,
            $filas,
        ), 'estadisticapresupuestos.xlsx');

    }

    public function exportEstadisticaPresupuestosSinAgruparXLS(){
        $sel=Presupuesto::presupuestossinagruparXLS($this->mesanyo,$this->filtroentidad,$this->filtrosolicitante,$this->filtroestado,$this->filtroFi,$this->filtroFf,$this->filtroventasIni,$this->filtroventasFin);

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

        return Excel::download(new ExportPresupuestosSinAgrupar(
            $this->mesanyo,
            $sel,
            $est,
            $ent,
            $sol,
            $this->filtroFi,
            $this->filtroFf,
            $this->filtroventasIni,
            $this->filtroventasFin,
            $filas,
        ), 'estadisticapresupuestossinagrupar.xlsx');

    }
}
