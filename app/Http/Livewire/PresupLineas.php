<?php

namespace App\Http\Livewire;

use App\Models\{Presupuesto, PresupuestoControlpartida, PresupuestoLinea,PresupuestoLineaDetalle};
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithBulkActions;

class PresupLineas extends Component
{

    use WithPagination, WithBulkActions;

    public $presupuesto;
    public $selected=[];
    public $showDeleteModal=false;


    protected $listeners = [ 'linearefresh' => '$refresh'];

    public function render()
    {
        // $lineas=PresupuestoLinea::where('presupuesto_id',$this->presupuesto->id)->orderBy('orden')->get();
        $lineas= $this->rows;
        return view('livewire.presup-lineas',compact(['lineas']));
}

    public function changeVisible(PresupuestoLinea $linea,$visible)
    {
        Validator::make(['visible'=>$visible],[
            'visible'=>'boolean',
        ])->validate();
        $linea->visible=$linea->visible=='1'? '0' : '1';
        $linea->update(['visible'=>$linea->visible]);
        $this->emit('linearefresh');
        $this->dispatchBrowserEvent('notify', 'Visible Actualizado.');
    }

    public function changeOrden(PresupuestoLinea $linea,$orden)
    {
        Validator::make(['orden'=>$orden],[
            'orden'=>'numeric',
        ])->validate();
        $linea->update(['orden'=>$orden]);
        $this->dispatchBrowserEvent('notify', 'Orden Actualizado.');
        $this->emit('linearefresh');
    }

    public function changeDescripcion(PresupuestoLinea $linea,$descripcion)
    {
        Validator::make(['descripcion'=>$descripcion],[
            'descripcion'=>'required',
        ])->validate();
        $linea->update(['descripcion'=>$descripcion]);
        $this->dispatchBrowserEvent('notify', 'Descripción Actualizada.');
    }


    public function changeUnidades(PresupuestoLinea $linea,$unidades)
    {
        Validator::make(['unidades'=>$unidades],[
            'unidades'=>'numeric|required|gt:0',
        ])->validate();
        $linea->update(['unidades'=>$unidades]);

        $p=Presupuesto::find($this->presupuesto->id)->recalculo();
        $this->emit('presupuestorefresh');
        $this->emit('linearefresh');
        $this->dispatchBrowserEvent('notify', 'Unidades Actualizadas.');
    }

    public function changeVenta(PresupuestoLinea $linea,$precioventa)
    {
        Validator::make(['precioventa'=>$precioventa],[
            'precioventa'=>'numeric|nullable',
        ])->validate();
        $linea->update(['precioventa'=>$precioventa]);
        $p=Presupuesto::find($this->presupuesto->id)->recalculo();
        // $this->recalculo();
        $this->emit('presupuestorefresh');
        $this->emit('linearefresh');
        $this->dispatchBrowserEvent('notify', 'Precio Venta Actualizado.');
    }

    public function changeObs(PresupuestoLinea $linea,$observaciones)
    {
        Validator::make(['observaciones'=>$observaciones],[
            'observaciones'=>'nullable',
        ])->validate();
        $linea->update(['observaciones'=>$observaciones]);
        $this->dispatchBrowserEvent('notify', 'Observaciones Actualizado.');
    }

    public function actualizaPartida($presuplinea)
    {
        $partidas=PresupuestoControlpartida::where('presupuesto_id',$presuplinea->presupuesto->id)->get();
        foreach ($partidas as $partida) {
            $contador=PresupuestoLinea::query()
            ->join('presupuesto_linea_detalles', 'presupuesto_lineas.id', '=', 'presupuesto_linea_detalles.presupuestolinea_id')
            ->select('presupuesto_lineas.presupuesto_id', 'presupuesto_linea_detalles.acciontipo_id')
            ->where('presupuesto_lineas.presupuesto_id', $presuplinea->presupuesto_id)
            ->where('presupuesto_linea_detalles.acciontipo_id', $partida->acciontipo_id)
            ->count();

            $p=PresupuestoControlpartida::query()
            ->where('presupuesto_id', $presuplinea->presupuesto_id)
            ->where('acciontipo_id', $partida->acciontipo_id)
            ->update([
                'contador'=>$contador
            ]);
        }
    }

    public function replicateRow(PresupuestoLinea $linea)
    {
        // clono la linea
        $clonelinea = $linea->replicate();
        // $clonelinea = $linea->replicate()->fill([
        //     'presupuesto_id'=>$this->presupuesto_id,
        // ]);
        $clonelinea->save();
        // clono las lineasdetalle
        $detallelineas=PresupuestoLineaDetalle::where('presupuestolinea_id',$linea->id)->get();
        foreach ($detallelineas as $detallelinea) {
            $detallelinea->replicate()->fill([
                'presupuestolinea_id'=>$clonelinea->id,
            ])->save();
        }
        $this->dispatchBrowserEvent('notify', 'Linea del Presupuesto copiada!');
        $this->emit('linearefresh');
    }

    public function delete($lineaId)
    {
        $lineaBorrar = PresupuestoLinea::find($lineaId);
        $presupuesto=Presupuesto::find($lineaBorrar->presupuesto_id);
        if ($lineaBorrar) {
            $lineasdetalle = PresupuestoLineaDetalle::where('presupuestolinea_id', $lineaBorrar->id)->delete();
            $this->actualizaPartida($lineaBorrar);
            $lineaBorrar->delete();
            $this->dispatchBrowserEvent('notify', 'Detalle de presupuesto eliminado!');

            return redirect()->route('presupuesto.edit',$presupuesto);
        }
    }

    public function deleteSelected(){
        $deleteCount = $this->selectedRowsQuery->count();
        $this->selectedRowsQuery->delete();
        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('notify', $deleteCount . ' Líneas eliminados!');
    }

    public function getRowsQueryProperty(){

        return PresupuestoLinea::where('presupuesto_id',$this->presupuesto->id)->orderBy('orden');
    }

    public function getRowsProperty(){
        return $this->rowsQuery->paginate(10);
    }

}
