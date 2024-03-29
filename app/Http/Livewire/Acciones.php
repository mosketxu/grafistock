<?php

namespace App\Http\Livewire;

use App\Models\Accion;
use App\Models\AccionTipo;
use App\Models\UnidadCoste;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class Acciones extends Component
{

    use WithPagination;
    public $search='';
    public $acciontipofiltro='';
    public $accion_id='';
    public $referencia='';
    public $descripcion='';
    public $acciontipo_id='';
    public $preciocoste='';
    public $preciominimo='';
    public $precioventa='';
    public $precioventa2='';
    public $precioventa3='';
    public $precioventa4='';
    public $udpreciocoste_id='';
    public $observaciones='';
    public $deshabilitado='disabled';



    protected function rules()
    {
        return [
            'referencia'=>'required|max:4|unique:acciones,referencia',
            'descripcion'=>'nullable',
            'acciontipo_id'=>'required|numeric',
            'preciocoste'=>'numeric|nullable',
            'preciominimo'=>'numeric|nullable',
            'precioventa'=>'numeric|nullable',
            'precioventa2'=>'numeric|nullable',
            'precioventa3'=>'numeric|nullable',
            'precioventa4'=>'numeric|nullable',
            'udpreciocoste_id'=>'numeric|nullable',
            'observaciones'=>'string|nullable',
        ];
    }


    public function render()
    {
        $acciontipos=AccionTipo::orderBy('nombre')->get();
        $unidades=UnidadCoste::orderBy('nombre')->get();

        $acciones=Accion::query()
            ->with('acciontipo','unidadpreciocoste')
            ->search('referencia',$this->search)
            ->orSearch('descripcion',$this->search)
            ->when($this->acciontipofiltro!='', function ($query){$query->where('acciontipo_id',$this->acciontipofiltro);})
            ->orderBy('acciontipo_id')
            ->orderBy('referencia')->get();
        return view('livewire.acciones',compact('acciones','acciontipos','unidades'));
    }

    public function changeDescripcion(Accion $valor,$descripcion)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->descripcion=$descripcion;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }

    public function changeAcciontipo(Accion $valor,$acciontipo_id)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->acciontipo_id=$acciontipo_id;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }

    public function changePreciocoste(Accion $valor,$preciocoste)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->preciocoste=$preciocoste;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }

    public function changePrecioventa(Accion $valor,$precioventa)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->precioventa=$precioventa;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }
    public function changePrecioventa2(Accion $valor,$precioventa2)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->precioventa2=$precioventa2;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }
    public function changePrecioventa3(Accion $valor,$precioventa3)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->precioventa3=$precioventa3;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }
    public function changePrecioventa4(Accion $valor,$precioventa4)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->precioventa4=$precioventa4;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }

    public function changeUdpreciocoste(Accion $valor,$udpreciocoste_id)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->udpreciocoste_id=$udpreciocoste_id;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }

    public function changePreciominimo(Accion $valor,$preciominimo)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            if ($preciominimo<$valor->preciocoste) {
                $this->dispatchBrowserEvent('notifyred', 'El precio mínimo no puede ser inferior al precio de coste. No se realizará la actualización');
            }else{
                $a->preciominimo=$preciominimo;
                $a->save();
                $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
            }
        }
    }

    public function changeObservaciones(Accion $valor,$observaciones)
    {
        if (Auth::user()->can('accion.edit')==true) {
            $a=Accion::find($valor->id);
            $a->observaciones=$observaciones;
            $a->save();
            $this->dispatchBrowserEvent('notify', 'Acción Actualizada.');
        }
    }

    public function updatedAcciontipoId()
    {
        if(AccionTipo::find($this->acciontipo_id)->nombrecorto=='IMP')
            $this->deshabilitado='';
    }

    private function resetInputFields(){
        $this->referencia='';
        $this->descripcion='';
        $this->acciontipo_id='';
        $this->preciocoste='';
        $this->preciominimo='';
        $this->precioventa='';
        $this->precioventa2='';
        $this->precioventa3='';
        $this->precioventa4='';
        $this->udpreciocoste_id='';
        $this->observaciones='';
    }

    public function store(){
        if (Auth::user()->can('accion.edit')==true) {
            $this->validate();
            $this->validate(['referencia'=>'required|max:4|unique:acciones,referencia']);

            $this->preciominimo =($this->preciominimo=='' || $this->preciominimo=='0' ) ? $this->preciocoste : $this->preciominimo;
            if ($this->preciominimo<$this->preciocoste) {
                $this->preciominimo=$this->preciocoste;
                $this->dispatchBrowserEvent('notify', 'El precio mínimo no puede ser inferior al precio de coste. Se asignará el precio de coste');
            }
            // $accion=Accion::updateOrCreate(['id'=>$this->accion_id], [
            $accion=Accion::create([
                'referencia'=>$this->referencia,
                'descripcion'=>$this->descripcion,
                'acciontipo_id'=>$this->acciontipo_id,
                'preciocoste'=>$this->preciocoste,
                'preciominimo'=>$this->preciominimo,
                'precioventa'=>$this->precioventa,
                'precioventa2'=>$this->precioventa2,
                'precioventa3'=>$this->precioventa3,
                'precioventa4'=>$this->precioventa4,
                'udpreciocoste_id'=>$this->udpreciocoste_id,
                'observaciones'=>$this->observaciones,
            ]);

            $this->resetInputFields();

            $this->dispatchBrowserEvent('notify', 'Accion añadida con éxito');

        }
    }

    public function delete($valorId)
    {
        $borrar = Accion::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', '¡Acción eliminada!');
        }
    }
}
