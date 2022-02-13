<?php

namespace App\Http\Livewire;

use App\Models\EmpresaTipo;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;


class EmpresaTipos extends Component
{

    use WithPagination;
    public $search='';
    public $nombre='';
    public $nombrecorto='';
    public $factor='';
    public $factormin='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:empresa_tipos,nombrecorto',
            'nombre'=>'required|unique:empresa_tipos,nombre',
            'factor'=>'required|numeric',
            'factormin'=>'required|numeric',
        ];
    }

    public function render()
    {
        $valores=EmpresaTipo::query()
            ->search('id',$this->search)
            ->orSearch('nombre',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.empresa-tipos',compact('valores'));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function changeCorto(EmpresaTipo $valor,$nombrecorto)
    {
        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required|unique:empresa_tipos,nombrecorto',
        ])->validate();

        $p=EmpresaTipo::find($valor->id);
        $p->nombrecorto=$nombrecorto;
        $p->save();

        $this->dispatchBrowserEvent('notify', 'Empresa Tipo Actualizada.');
    }

    public function changeNombre(EmpresaTipo $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:empresa_tipos,nombre',
        ])->validate();

        $p=EmpresaTipo::find($valor->id);
        $p->nombre=$nombre;
        $p->save();

        $this->dispatchBrowserEvent('notify', 'Empresa Tipo Actualizada.');
    }

    public function changeFactor(EmpresaTipo $valor,$factor)
    {
        Validator::make(['factor'=>$factor],[
            'factor'=>'required|numeric',
        ])->validate();

        $p=EmpresaTipo::find($valor->id);
        $p->factor=$factor;
        $p->save();

        $this->dispatchBrowserEvent('notify', 'Empresa Tipo Actualizada.');
    }

    public function changeFactormin(EmpresaTipo $valor,$factormin)
    {
        Validator::make(['factormin'=>$factormin],[
            'factormin'=>'required|numeric',
        ])->validate();

        $p=EmpresaTipo::find($valor->id);
        $p->factormin=$factormin;
        $p->save();

        $this->dispatchBrowserEvent('notify', 'Empresa Tipo Actualizada.');
    }

    public function save()
    {
        $this->validate();
        EmpresaTipo::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
            'factor'=>$this->factor,
            'factormin'=>$this->factormin,
        ]);

        $this->dispatchBrowserEvent('notify', 'Empresa Tipo añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
        $this->factor='';
        $this->factormin='';
    }

    public function delete($valorId)
    {
        $borrar = EmpresaTipo::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Empresa Tipo eliminado!');
        }
    }

}
