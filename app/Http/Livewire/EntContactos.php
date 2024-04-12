<?php

namespace App\Http\Livewire;

use App\Models\{Entidad, EntidadContacto, User};
use Livewire\Component;


class EntContactos extends Component
{
    public $entidad;
    public $search='';

    public function mount($entidadId){
        $this->entidad=Entidad::findOrFail($entidadId);
    }

    public function render(){
        // dd('asd');
        $users=User::get();
        $contactos=EntidadContacto::query()
        ->search('contacto',$this->search)
        ->where('entidad_id',$this->entidad->id)->paginate(15);
        return view('livewire.ent-contactos',compact(['contactos']));
    }

    public function delete($entidadcontactoId){
        $entidadcontacto = EntidadContacto::find($entidadcontactoId);
        if ($entidadcontacto) {
            $entidadcontacto->delete();
            $this->dispatchBrowserEvent('notify', 'El contacto ha sido eliminado!');
        }
    }
}
