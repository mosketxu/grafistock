<?php

namespace App\Http\Livewire;

use App\Models\ProductoTipo;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class ProductoTipos extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Tipos';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $campo3='Merma';
    public $nombre='';
    public $nombrecorto='';
    public $aux='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:producto_tipos,nombrecorto',
            'nombre'=>'required|unique:producto_tipos,nombre',
            'aux'=>'numeric',
        ];
    }

    public function render()
    {
        $valores=ProductoTipo::query()
            ->select('id','nombre','nombrecorto','merma as aux')
            ->search('nombrecorto',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard3',compact('valores'));
    }

    public function changeCorto(ProductoTipo $valor,$nombrecorto)
    {

        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:producto_tipos,nombrecorto',
        ])->validate();

        $p=ProductoTipo::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Tipo Actualizado.');
    }

    public function changeNombre(ProductoTipo $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:producto_tipos,nombre',
        ])->validate();

        $p=ProductoTipo::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Tipo Actualizado.');
    }

    public function changeAux(ProductoTipo $valor,$aux)
    {
        Validator::make(['aux'=>$aux],[
            'aux'=>'required|numeric',
        ])->validate();

        $p=ProductoTipo::find($valor->id);
        $p->merma=$aux;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Merma Actualizado.');
    }

    public function save()
    {
        $this->validate();

        ProductoTipo::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Tipo añadido con éxito');

        $this->nombre='';
        $this->nombrecorto='';
        $this->aux='';
        $this->emit('refresh');
    }

    public function delete($valorId)
    {
        $borrar = ProductoTipo::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Tipo eliminado!');
        }
    }

}
