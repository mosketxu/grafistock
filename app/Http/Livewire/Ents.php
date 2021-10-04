<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use App\Models\EntidadTipo;
use Livewire\Component;
use Livewire\WithPagination;

class Ents extends Component
{
    use WithPagination;

    public $search='';
    public $entidadtipo_id='';
    public Entidad $entidad;

    public function render()
    {
        $enttipo=EntidadTipo::find($this->entidadtipo_id);
        $entidades=Entidad::query()
        ->with('entidadtipo')
        ->search('entidad',$this->search)
        ->when($this->entidadtipo_id>'3', function ($query){
            $query->where('entidadtipo_id',$this->entidadtipo_id);
        })
        ->when($this->entidadtipo_id=='1'||$this->entidadtipo_id=='2', function ($query){
            $query->where('entidadtipo_id',$this->entidadtipo_id)
            ->orWhere('entidadtipo_id','3');
        })
        ->orSearch('nif',$this->search)
        ->orderBy('entidad','asc')
        ->paginate(10);
        return view('livewire.ents',compact('entidades','enttipo'));
    }

    public function updatingSearch(){
        $this->resetPage();
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
