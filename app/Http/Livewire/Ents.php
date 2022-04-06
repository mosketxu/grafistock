<?php

namespace App\Http\Livewire;

use App\Models\{EmpresaTipo,Entidad,EntidadTipo,User};
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Ents extends Component
{
    use WithPagination;

    public $search='';
    public $filtrocomercial='';
    public $Fini='';
    public $Ffin='';
    public $entidadtipo_id='';
    public $empresatipo_id='';
    public Entidad $entidad;

    public function render()
    {
        $entidadtipo=EntidadTipo::find($this->entidadtipo_id);
        $empresatipos=EmpresaTipo::get();
        $comerciales=User::role('Comercial')->orderBy('name')->get();

        $entidades=Entidad::query()
            ->with('entidadtipo')
            ->with('empresatipo')
            ->with('comercial')
            ->filtrosEntidad($this->search,$this->filtrocomercial,$this->entidadtipo_id,$this->Fini,$this->Ffin)
            ->orderBy('entidad','asc')
            ->paginate(10);

        return view('livewire.ents',compact('entidades','entidadtipo','empresatipos','comerciales'));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function changeValor(Entidad $entidad,$campo,$valor)
    {
        $entidad->update([$campo=>$valor]);
        $this->dispatchBrowserEvent('notify', 'Actulizada con éxito.');
    }

    public function delete($entidadId)
    {
        $entidad = Entidad::find($entidadId);
        if ($entidad) {
            $entidad->delete();
            $this->dispatchBrowserEvent('notify', 'La entidad: '.$entidad->entidad.' ha sido eliminada!');
        }
    }
}
