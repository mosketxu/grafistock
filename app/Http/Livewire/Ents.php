<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use Livewire\Component;
use Livewire\WithPagination;

class Ents extends Component
{
    use WithPagination;

    public $search='';
    public $filtrocliente=1;
    public Entidad $entidad;

    public function render()
    {
        $this->entidad= new Entidad;
        $entidades=Entidad::query()
            ->search('entidad',$this->search)
            ->orSearch('nif',$this->search)
            ->orderBy('entidad','asc')
            ->paginate(10);

        return view('livewire.ents',compact('entidades'));
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
