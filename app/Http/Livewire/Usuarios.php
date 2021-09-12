<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Usuarios extends Component
{
    public $search='';
    public $name='';
    public $email='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'name'=>'required|unique:users,name',
            'email'=>'email|required|unique:users,email',
        ];
    }

    public function render()
    {
        $users=User::query()
            ->search('name',$this->search)
            ->orSearch('email',$this->search)
            ->get();
        return view('livewire.usuarios',compact('users'));
    }


    public function save()
    {
        $this->validate();

        User::create([
            'name'=>$this->name,
            'email'=>$this->email,
        ]);

        $this->dispatchBrowserEvent('notify', 'Usuario añadido con éxito');

        $this->emit('refresh');
        $this->name='';
        $this->email='';
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
