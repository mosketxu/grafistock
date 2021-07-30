<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ProductoAcabado;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class Acabados extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Acabados';
    public $nombre='';
    public $nombrecorto='';

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
            'nombrecorto'=>'unique:producto_acabados,nombrecorto',
        ])->validate();

        $p=ProductoAcabado::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Acabado Actualizado.');
    }

    public function changeNombre(ProductoAcabado $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'unique:producto_acabados,nombre',
        ])->validate();

        $p=ProductoAcabado::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Acabado Actualizado.');
    }

    public function save()
    {
        $this->validate([
            'nombre'=>[
                'required',
                Rule::unique('producto_acabados','nombre')
                ],
            'nombrecorto'=>[
                'required',
                Rule::unique('producto_acabados','nombrecorto')
                ],
            ],
        );
        // // dd($this->nombrecorto);
        // $p=new ProductoAcabado;
        // $p->nombre=$this->nombre;
        // $p->nombrecorto=$this->nombrecorto;
        // $p->save();
        ProductoAcabado::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);
        // dd($p);

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
