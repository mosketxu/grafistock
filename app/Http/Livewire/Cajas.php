<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductoCaja;


class Cajas extends Component
{

    use WithPagination;
    public $search='';
    public $titulo='Cajas';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:producto_cajas,nombrecorto',
            'nombre'=>'required|unique:producto_cajas,nombre',
        ];
    }

    public function render(){
        $valores=ProductoCaja::query()
        ->search('id',$this->search)
        ->orSearch('nombre',$this->search)
        ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(ProductoCaja $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:producto_cajas,nombrecorto',
        ])->validate();

        $p=ProductoCaja::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Caja Actualizada.');
    }

    public function changeNombre(ProductoCaja $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:producto_cajas,nombre',
        ])->validate();
        $p=ProductoCaja::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Caja Actualizado.');
    }

    public function save()
    {
        $this->validate();

        ProductoCaja::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Caja pago añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = ProductoCaja::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Caja de pago eliminado!');
        }
    }
}
