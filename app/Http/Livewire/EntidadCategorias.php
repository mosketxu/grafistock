<?php

namespace App\Http\Livewire;

use App\Models\EntidadCategoria;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

use Livewire\Component;

class EntidadCategorias extends Component
{
    use WithPagination;
    public $search='';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:entidad_tipos,nombrecorto',
            'nombre'=>'required|unique:entidad_tipos,nombre',
        ];
    }
    public function render()
    {
        $valores=EntidadCategoria::query()
        ->search('id',$this->search)
        ->orSearch('nombre',$this->search)
        ->orderBy('nombrecorto')->get();
        return view('livewire.entidad-categorias',compact('valores'));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function changeCorto(EntidadCategoria $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:entidad_categorias,nombrecorto',
        ])->validate();

        $p=EntidadCategoria::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();

        $this->dispatchBrowserEvent('notify', 'Categoria Actualizada.');
    }

    public function changeNombre(EntidadCategoria $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:entidad_categorias,nombre',
        ])->validate();

        $p=EntidadCategoria::find($valor->id);
        $p->nombre=$nombre;
        $p->save();

        $this->dispatchBrowserEvent('notify', 'Categoria Actualizada.');
    }

    public function save()
    {
        $this->validate();
        EntidadCategoria::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Catagoria añadida con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = EntidadCategoria::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Categoria eliminada!');
        }
    }

}
