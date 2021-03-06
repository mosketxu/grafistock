<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Ubicacion;

class Ubicaciones extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Ubicaciones';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:ubicaciones,nombrecorto',
            'nombre'=>'required|unique:ubicaciones,nombre',
        ];
    }

    public function render()
    {
        $valores=Ubicacion::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(Ubicacion $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:ubicaciones,nombrecorto',
        ])->validate();

        $p=Ubicacion::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Ubicación Actualizada.');
    }

    public function changeNombre(Ubicacion $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:ubicaciones,nombre',
        ])->validate();
        $p=Ubicacion::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Ubicación Actualizada.');
    }

    public function save()
    {
        $this->validate();

        Ubicacion::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Ubicación añadida con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = Ubicacion::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Ubicación eliminada!');
        }
    }

}

