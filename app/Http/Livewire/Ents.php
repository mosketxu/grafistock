<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use Livewire\Component;
use Livewire\WithPagination;

class Ents extends Component
{
    use WithPagination;

    public $search='';
    public $clipro_id='';
    public Entidad $entidad;

    public function render()
    {
        $this->entidad= new Entidad;
        $entidades=Entidad::query()
            ->search('entidad',$this->search)
            ->search('clipro_id',$this->clipro_id)
            ->search('clipro_id',$this->clipro_id)
            ->orSearch('clipro_id','3')
            ->orSearch('nif',$this->search)
            ->orderBy('entidad','asc')
            ->paginate(10);

        return view('livewire.ents',compact('entidades'));
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
