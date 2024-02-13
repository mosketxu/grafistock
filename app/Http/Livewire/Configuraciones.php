<?php

namespace App\Http\Livewire;

use App\Models\Configuracion;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use Livewire\Component;

class Configuraciones extends Component
{

    use WithPagination;
    public $search='';
    public $titulo='Configuración';
    public $campo1='Nombre';
    public $campo2='Alias';
    public $campo3='Valor';
    public $nombre='';
    public $nombrecorto='';
    public $aux='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:configuracion,nombrecorto',
            'nombre'=>'required|unique:configuracion,nombre',
            'aux'=>'numeric',
        ];
    }

    public function render(){
        $valores=Configuracion::query()
        ->select('id','nombre','nombrecorto','valor as aux')
        ->search('nombrecorto',$this->search)
        ->orSearch('nombre',$this->search)
        ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard3',compact('valores'));
    }

    public function changeCorto(Configuracion $valor,$nombrecorto)
    {

        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:configuracion,nombrecorto',
        ])->validate();

        $p=Configuracion::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Actualizado.');
    }

    public function changeNombre(Configuracion $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:configuracion,nombre',
        ])->validate();

        $p=Configuracion::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Actualizado.');
    }

    public function changeAux(Configuracion $valor,$aux)
    {
        Validator::make(['aux'=>$aux],[
            'aux'=>'required|numeric',
        ])->validate();

        $p=Configuracion::find($valor->id);
        $p->valor=$aux;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Valor Actualizado.');
    }

    public function save()
    {
        $this->validate();

        Configuracion::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
            'valor'=>$this->aux,
        ]);

        $this->dispatchBrowserEvent('notify', 'Añadido con éxito');

        $this->nombre='';
        $this->nombrecorto='';
        $this->aux='';
        $this->emit('refresh');
    }

    public function delete($valorId)
    {
        $borrar = Configuracion::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Eliminado!');
        }
    }

}
