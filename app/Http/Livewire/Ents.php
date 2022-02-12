<?php

namespace App\Http\Livewire;

use App\Models\EmpresaTipo;
use App\Models\Entidad;
use App\Models\EntidadTipo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Ents extends Component
{
    use WithPagination;

    public $search='';
    public $entidadtipo_id='';
    public $empresatipo_id='';
    public Entidad $entidad;

    public function render()
    {
        $enttipo=EntidadTipo::find($this->entidadtipo_id);
        $empresatipos=EmpresaTipo::get();
        $entidades=Entidad::query()
        ->with('entidadtipo')
        ->with('empresatipo')
        ->with('comercial')
        ->search('entidad',$this->search)
        ->when($this->entidadtipo_id>'3', function ($query){
            $query->where('entidadtipo_id',$this->entidadtipo_id);
        })
        ->when($this->entidadtipo_id=='1'||$this->entidadtipo_id=='2', function ($query){
            $query->where('entidadtipo_id',$this->entidadtipo_id)
            ->orWhere('entidadtipo_id','3');
        })
        ->when(Auth::user()->hasRole('Comercial'),function ($query){
            $query->where('comercial_id',Auth::user()->id);
        })
        ->orSearch('nif',$this->search)
        ->orderBy('entidad','asc')
        ->paginate(10);

        return view('livewire.ents',compact('entidades','enttipo','empresatipos'));
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function changeEmpresatipo(Entidad $entidad,$empresatipo_id)
    {
        $entidad->update(['empresatipo_id'=>$empresatipo_id]);
        $this->dispatchBrowserEvent('notify', 'Categoria Empresa actualizada.');
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
