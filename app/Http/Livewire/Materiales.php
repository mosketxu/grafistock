<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductoMaterial;

class Materiales extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Materiales';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];


    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:producto_materiales,nombrecorto',
            'nombre'=>'required|unique:producto_materiales,nombre',
        ];
    }

    public function render()
    {
        $valores=ProductoMaterial::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function changeCorto(ProductoMaterial $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:producto_materiales,nombrecorto',
        ])->validate();

        $p=ProductoMaterial::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();

        $this->dispatchBrowserEvent('notify', 'Material Actualizado.');
    }

    public function changeNombre(ProductoMaterial $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:producto_materiales,nombre',
        ])->validate();

        $p=ProductoMaterial::find($valor->id);
        $p->nombre=$nombre;
        $p->save();

        $this->dispatchBrowserEvent('notify', 'Material Actualizado.');
    }

    public function save()
    {
        $this->validate();
        ProductoMaterial::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Material pago añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }
    public function delete($valorId)
    {
        $borrar = ProductoMaterial::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Material eliminado!');
        }
    }

}
