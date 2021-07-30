<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductoCalidad;

class Calidades extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Calidades';

    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    public function render()
    {
        $valores=ProductoCalidad::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();

        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(ProductoCalidad $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'unique:producto_cajas,nombrecorto',
        ])->validate();

        $p=ProductoCalidad::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Calidad Actualizada.');
    }

    public function changeNombre(ProductoCalidad $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'unique:producto_cajas,nombre',
        ])->validate();
        $p=ProductoCalidad::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Calidad Actualizada.');
    }

    public function save()
    {
        $this->validate([
            'nombre'=>[
                'required',
                Rule::unique('producto_calidades','nombre')
                ],
            'nombrecorto'=>[
                'required',
                Rule::unique('producto_calidades','nombrecorto')
                ],
            ],
        );

        ProductoCalidad::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Calidad añadida con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = ProductoCalidad::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Calidad añadida eliminado!');
        }
    }
}
