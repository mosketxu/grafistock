<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\ProductoUnidadcoste;

class UnidadesCoste extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Unidades Coste';

    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:producto_unidadescoste,nombrecorto',
            'nombre'=>'required|unique:producto_unidadescoste,nombre',
        ];
    }

    public function render()
    {
        $valores=ProductoUnidadcoste::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(ProductoUnidadcoste $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:producto_unidadescoste,nombrecorto',
        ])->validate();

        $p=ProductoUnidadcoste::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Acabado Actualizado.');
    }

    public function changeNombre(ProductoUnidadcoste $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:producto_unidadescoste,nombre',
        ])->validate();
        $p=ProductoUnidadcoste::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Material Actualizado.');
    }

    public function save()
    {
        $this->validate();

        ProductoUnidadcoste::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Unidad Coste añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = ProductoUnidadcoste::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Unidad Coste eliminado!');
        }
    }

}

