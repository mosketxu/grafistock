<?php

namespace App\Http\Livewire;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Roles extends Component
{
    public $titulo='Roles';
    public $nombre='';
    public $nombrecorto='web';
    public $campo1='Guarda';
    public $campo2='Nombre';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombre'=>'required|unique:roles,name',
            'nombrecorto'=>'required',
        ];
    }

    public function render()
    {

        $valores=Role::select('id','name as nombre','guard_name as nombrecorto')->orderBy('name')->get();

        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(Role $valor,$nombrecorto)
    {

        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required',
        ])->validate();

        $p=Role::find($valor->id);
        $p->guard_name=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Role Actualizado.');
    }

    public function changeNombre(Role $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:roles,name',
        ])->validate();

        $p=Role::find($valor->id);
        $p->name=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Role Actualizado.');
    }

    public function save()
    {
        $this->validate();

        Role::create([
            'name'=>$this->nombre,
            'guard_name'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Role añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='web';
    }

    public function delete($valorId)
    {
        $borrar = Role::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Role eliminado!');
        }
    }
}
