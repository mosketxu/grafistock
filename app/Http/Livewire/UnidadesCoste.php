<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\UnidadCoste;

class UnidadesCoste extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Unidades Coste';
    public $campo1='Sigla';
    public $campo2='Nombre';

    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:unidadescoste,nombrecorto',
            'nombre'=>'required|unique:unidadescoste,nombre',
        ];
    }

    public function render()
    {
        $valores=UnidadCoste::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(UnidadCoste $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:unidadescoste,nombrecorto',
        ])->validate();

        $p=UnidadCoste::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Acabado Actualizado.');
    }

    public function changeNombre(UnidadCoste $valor, $nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:unidadescoste,nombre',
        ])->validate();
        $p=UnidadCoste::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Material Actualizado.');
    }

    public function save()
    {
        $this->validate();

        UnidadCoste::create([
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
        $borrar = UnidadCoste::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Unidad Coste eliminado!');
        }
    }

}

