<?php

namespace App\Http\Livewire;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Permisos extends Component
{
    public $titulo='Permisos';
    public $search='';
    public $nombre='';
    public $nombrecorto='web';
    public $campo1='Guarda';
    public $campo2='Nombre';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombre'=>'required|unique:permissions,name',
            'nombrecorto'=>'required',
        ];
    }

    public function render()
    {

        $valores=Permission::select('id','name as nombre','guard_name as nombrecorto')
        ->search('name',$this->search)
        ->orSearch('guard_name',$this->search)
        ->orderBy('name')->get();

        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeCorto(Permission $valor,$nombrecorto)
    {

        Validator::make(['nombrecorto'=>$nombrecorto],[
            'nombrecorto'=>'required',
        ])->validate();

        $p=Permission::find($valor->id);
        $p->guard_name=$nombrecorto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Permiso Actualizado.');
    }

    public function changeNombre(Permission $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:roles,name',
        ])->validate();

        $p=Permission::find($valor->id);
        $p->name=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Permiso Actualizado.');
    }

    public function save()
    {
        $this->validate();

        Permission::create([
            'name'=>$this->nombre,
            'guard_name'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Permiso añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='web';
    }

    public function delete($valorId)
    {
        $borrar = Permission::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Permiso eliminado!');
        }
    }
}
