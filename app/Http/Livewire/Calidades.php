<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
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

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:producto_calidades,nombrecorto',
            'nombre'=>'required|unique:producto_calidades,nombre',
        ];
    }

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
            'nombrecorto'=>'required|unique:producto_calidades,nombrecorto',
        ])->validate();

        $p=ProductoCalidad::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Calidad Actualizada.');
    }

    public function changeNombre(ProductoCalidad $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:producto_calidades,nombre',
        ])->validate();
        $p=ProductoCalidad::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Calidad Actualizada.');
    }

    public function save()
    {
        $this->validate();

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
