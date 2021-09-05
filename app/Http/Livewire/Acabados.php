<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductoAcabado;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class Acabados extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Acabados';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:producto_acabados,nombrecorto',
            'nombre'=>'required|unique:producto_acabados,nombre',
        ];
    }

    public function render()
    {
        $valores=ProductoAcabado::query()
            ->search('nombrecorto',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(ProductoAcabado $valor,$nombrecorto)
    {

        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:producto_acabados,nombrecorto',
        ])->validate();

        $p=ProductoAcabado::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Acabado Actualizado.');
    }

    public function changeNombre(ProductoAcabado $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:producto_acabados,nombre',
        ])->validate();

        $p=ProductoAcabado::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Acabado Actualizado.');
    }

    public function save()
    {
        $this->validate();

        ProductoAcabado::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Acabado añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = ProductoAcabado::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Acabado eliminado!');
        }
    }
}
