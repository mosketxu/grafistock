<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Solicitante;

class Solicitantes extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Solicitantes';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:solicitantes,nombrecorto',
            'nombre'=>'required|unique:solicitantes,nombre',
        ];
    }

    public function render()
    {
        $valores=Solicitante::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(Solicitante $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:solicitantes,nombrecorto',
        ])->validate();

        $p=Solicitante::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Solicitante Actualizado.');
    }

    public function changeNombre(Solicitante $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:solicitantes,nombre',
        ])->validate();
        $p=Solicitante::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Solicitante Actualizado.');
    }

    public function save()
    {
        $this->validate();

        Solicitante::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Solcitante añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = Solicitante::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Solcitante eliminado!');
        }
    }

}

