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
    public $campo3='Activo';
    public $nombre='';
    public $nombrecorto='';
    public $aux='';


    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:producto_acabados,nombrecorto',
            'nombre'=>'required|unique:producto_acabados,nombre',
            'aux'=>'nullable',
        ];
    }

    public function render()
    {
        $valores=AccionTipo::query()
            ->select('id','nombre','nombrecorto','activo as aux')
            ->search('nombrecorto',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();

        // dd($valores);
        return view('livewire.auxiliarcard3',compact('valores'));
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

    public function changeAux(AccionTipo $valor,$aux)
    {
        $p=AccionTipo::find($valor->id);
        $p->activo=$aux;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Tipo Acción Actualizado.');
    }

    public function save()
    {
        $this->validate();
        AccionTipo::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
            'activo'=>$this->aux,
        ]);

        $this->dispatchBrowserEvent('notify', 'Tipo Acción  añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
        $this->aux='';
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
