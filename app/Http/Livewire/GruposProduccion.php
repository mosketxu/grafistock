<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductoGrupoproduccion;

class GruposProduccion extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Grupos Producción';

    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];


    public function render()
    {
        $valores=ProductoGrupoproduccion::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(ProductoGrupoproduccion $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'unique:productgruposproduccion,nombrecorto',
        ])->validate();

        $p=ProductoGrupoproduccion::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Grupo Producción Actualizado.');
    }

    public function changeNombre(ProductoGrupoproduccion $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'unique:producto_gruposproduccion,nombre',
        ])->validate();
        $p=ProductoGrupoproduccion::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Grupo Producción Actualizado.');
    }

    public function save()
    {
        $this->validate([
            'nombre'=>[
                'required',
                Rule::unique('producto_gruposproduccion','nombre')
                ],
            'nombrecorto'=>[
                'required',
                Rule::unique('producto_gruposproduccion','nombrecorto')
                ],
            ],
        );

        ProductoGrupoproduccion::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Grupo Producción añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = ProductoGrupoproduccion::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Grupo Producción eliminado!');
        }
    }


}
