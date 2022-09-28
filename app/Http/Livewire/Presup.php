<?php

namespace App\Http\Livewire;

use App\Models\EntidadContacto;
use App\Models\Presupuesto;
use App\Models\PresupuestoControlpartida;
use App\Models\PresupuestoLinea;
use Livewire\Component;

class Presup extends Component
{
    public $presupuesto;
    public $estado;
    public $refgrafitex;
    public $refcliente;
    public $entidadcontacto_id;
    public $unidades;
    public $incremento;
    public $precioventa;
    public $preciocoste;
    public $descripcion;
    public $observaciones;
    public $mesagge;

    public $search;
    public $filtroanyo;
    public $filtromes;
    public $filtroclipro;
    public $filtrosolicitante;
    public $filtropalabra;
    public $filtroestado;

    protected $listeners = [ 'presupuestorefresh' => 'presupuestorefresh'];

    public $showPDFModal=false;

    protected function rules(){
        return [
            'precioventa'=>'nullable|numeric',
            'preciocoste'=>'nullable|numeric',
            'entidadcontacto_id'=>'nullable',
            'unidades'=>'numeric|',
            'refgrafitex'=>'nullable',
            'refcliente'=>'nullable',
            'incremento'=>'required|numeric',
            'descripcion'=>'required',
            'observaciones'=>'nullable',
        ];
    }

    public function presupuestorefresh()
    {
        $this->precioventa=$this->presupuesto->precioventa;
        $this->preciocoste=$this->presupuesto->preciocoste;
    }

    public function mount(Presupuesto $presupuesto,$search,$filtroanyo,$filtromes,$filtroclipro,$filtrosolicitante,$filtropalabra,$filtroestado)
    {
        $this->presupuesto=$presupuesto;
        $this->descripcion=$presupuesto->descripcion;
        $this->estado=$presupuesto->estado;
        $this->entidadcontacto_id=$presupuesto->entidadcontacto_id;
        $this->precioventa=$presupuesto->precioventa;
        $this->preciocoste=$presupuesto->preciocoste;
        $this->unidades=$presupuesto->unidades;
        $this->refgrafitex=$presupuesto->refgrafitex;
        $this->refcliente=$presupuesto->refcliente;
        $this->incremento=$presupuesto->incremento;
        $this->observaciones=$presupuesto->observaciones;
        $this->$search=$search;
        $this->$filtroanyo=$filtroanyo;
        $this->$filtromes=$filtromes;
        $this->$filtroclipro=$filtroclipro;
        $this->$filtrosolicitante=$filtrosolicitante;
        $this->$filtropalabra=$filtropalabra;
        $this->$filtroestado=$filtroestado;
    }

    public function render()
    {
        $contactos=EntidadContacto::where('entidad_id',$this->presupuesto->entidad_id)->orderBy('contacto')->get();
        $controlpartidas=PresupuestoControlpartida::where('presupuesto_id',$this->presupuesto->id)->get();
        return view('livewire.presup',compact(['controlpartidas','contactos']));
    }


    public function openPDFModal(){
        $this->showPDFModal = true;
    }

    public function imprimir(){
        $this->openPDFModal();
    }

    public function save()
    {
        $this->validate();

        $mensaje="Presupuesto actualizado satisfactoriamente";

        $presup=Presupuesto::findOrFail($this->presupuesto->id)
            ->update([
                'precioventa'=>$this->precioventa,
                'unidades'=>$this->unidades,
                'entidadcontacto_id'=>$this->entidadcontacto_id,
                'refgrafitex'=>$this->refgrafitex,
                'refcliente'=>$this->refcliente,
                'incremento'=>$this->incremento,
                'estado'=>$this->estado,
                'descripcion'=>$this->descripcion,
                'observaciones'=>$this->observaciones
        ]);

        $presup=Presupuesto::find($this->presupuesto->id);
        $presuplineas=PresupuestoLinea::where('presupuesto_id',$presup->id)->get();
        if($presuplineas->count()>0){
            foreach($presuplineas as $presuplinea)
            $presuplinea->recalculo(); // por si se ha modificado el %Incremento
        }

        // $presup->recalculo();

        $this->emit('presupuestorefresh');

        $this->emit('presupuestolinearefresh');

        $this->dispatchBrowserEvent('notify', $mensaje);

        return redirect()->route('presupuesto.edit',$presup);
    }

}
