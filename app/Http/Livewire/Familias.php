<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductoFamilia;

class Familias extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Familias';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:producto_familias,nombrecorto',
            'nombre'=>'required|unique:producto_familias,nombre',
        ];
    }

    public function render()
    {
        $valores=ProductoFamilia::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();

        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(ProductoFamilia $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:producto_familias,nombrecorto',
        ])->validate();

        $p=ProductoFamilia::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Familia Actualizada.');
    }

    public function changeNombre(ProductoFamilia $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:producto_familias,nombre',
        ])->validate();
        $p=ProductoFamilia::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Familia Actualizada.');
    }

    public function save()
    {
        $this->validate();

        ProductoFamilia::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Familia añadida con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = ProductoFamilia::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', '¡Familia eliminada!');
        }
    }
}
