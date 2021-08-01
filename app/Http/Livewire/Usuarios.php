<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    use WithPagination;
    public $search='';

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $users=User::query()
            ->search('name',$this->search)
            ->orSearch('email',$this->search)
            ->paginate(15);
        return view('livewire.usuarios',compact('users'));
    }

    public function delete($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            $this->dispatchBrowserEvent('notify', 'El usurario: '.$user->name.' ha sido eliminado!');
        }
    }
}
