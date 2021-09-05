<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Unidad;

class Unidades extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Unidades';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:unidades,nombrecorto',
            'nombre'=>'required|unique:unidades,nombre',
        ];
    }

    public function render()
    {
        $valores=Unidad::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(Unidad $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:unidades,nombrecorto',
        ])->validate();

        $p=Unidad::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Acabado Actualizado.');
    }

    public function changeNombre(Unidad $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:unidades,nombre',
        ])->validate();
        $p=Unidad::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Material Actualizado.');
    }

    public function save()
    {
        $this->validate();

        Unidad::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Unidad añadida con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = Unidad::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Unidad eliminada!');
        }
    }

}
