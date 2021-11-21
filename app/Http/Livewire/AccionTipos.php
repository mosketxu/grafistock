<?php

namespace App\Http\Livewire;

use App\Models\AccionTipo;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;

class AccionTipos extends Component
{
    use WithPagination;
    public $search='';
    public $titulo='Tipos Acción';
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
        $valores=AccionTipo::query()
            ->search('nombrecorto',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(AccionTipo $valor,$nombrecorto)
    {

        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:accion_tipos,nombrecorto',
        ])->validate();

        $p=AccionTipo::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Tipo Acción Actualizado.');
    }

    public function changeNombre(AccionTipo $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:accion_tipos,nombre',
        ])->validate();

        $p=AccionTipo::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Tipo Acción Actualizado.');
    }

    public function save()
    {
        $this->validate();
        AccionTipo::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Tipo Acción  añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = AccionTipo::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Tipo Acción  eliminado!');
        }
    }
}
