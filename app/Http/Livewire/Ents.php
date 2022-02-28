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
        ->search('entidad',$this->search)
        ->when($this->filtrocomercial!='', function ($query){$query->where('comercial_id',$this->filtrocomercial);})
        ->when($this->entidadtipo_id=='1', function ($query){
            $query->whereIn('entidadtipo_id',[1,3]);
        })
        ->when($this->entidadtipo_id=='2', function ($query){
            $query->whereIn('entidadtipo_id',[2,3]);
        })
        ->when($this->entidadtipo_id=='4', function ($query){
            $query->where('entidadtipo_id','4');
        })
        ->when(Auth::user()->hasRole('Comercial'),function ($query){
            $query->where('comercial_id',Auth::user()->id);
        })
        ->orSearch('nif',$this->search)
        ->orderBy('entidad','asc')
        ->paginate(10);

        return view('livewire.ents',compact('entidades','entidadtipo','empresatipos','comerciales'));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function changeEmpresatipo(Entidad $entidad,$empresatipo_id)
    {
        $entidad->update(['empresatipo_id'=>$empresatipo_id]);
        $this->dispatchBrowserEvent('notify', 'Categoria Empresa actualizada.');
    }

    public function changeComercial(Entidad $entidad,$comercial_id)
    {
        $entidad->update(['comercial_id'=>$comercial_id]);
        $this->dispatchBrowserEvent('notify', 'Comercial asignado.');
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
