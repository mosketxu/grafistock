<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

use App\Models\MetodoPago as MetodoPago;

class MetodoPagos extends Component
{
    use WithPagination;

    public $search='';
    public $titulo='Métodos de Pago';
    public $campo1='Sigla';
    public $campo2='Nombre';
    public $nombre='';
    public $nombrecorto='';

    protected $listeners = [ 'refresh' => '$refresh'];

    protected function rules()
    {
        return [
            'nombrecorto'=>'required|unique:metodo_pagos,nombrecorto',
            'nombre'=>'required|unique:metodo_pagos,nombre',
        ];
    }

    public function render()
    {
        $valores=MetodoPago::query()
            ->search('nombre',$this->search)
            ->orSearch('nombrecorto',$this->search)
            ->orderBy('nombrecorto')->get();
        return view('livewire.auxiliarcard',compact('valores'));
    }

    public function changeNombre(MetodoPago $valor,$nombre)
    {
        Validator::make(['nombre'=>$nombre],[
            'nombre'=>'required|unique:metodo_pagos,nombre',
        ])->validate();
        $p=MetodoPago::find($valor->id);
        $p->nombre=$nombre;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Metodo Pago Actualizado.');
    }

    public function changeCorto(MetodoPago $valor,$corto)
    {
        Validator::make(['corto'=>$corto],[
            'corto'=>'required|unique:metodo_pagos,nombrecorto',
        ])->validate();
        $p=MetodoPago::find($valor->id);
        $p->nombrecorto=$corto;
        $p->save();
        $this->dispatchBrowserEvent('notify', 'Metodo Pago Actualizado.');
    }

    public function save()
    {
        $this->validate();

        MetodoPago::create([
            'nombre'=>$this->nombre,
            'nombrecorto'=>$this->nombrecorto,
        ]);

        $this->dispatchBrowserEvent('notify', 'Método de pago añadido con éxito');

        $this->emit('refresh');
        $this->nombre='';
        $this->nombrecorto='';
    }

    public function delete($valorId)
    {
        $borrar = MetodoPago::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', 'Método de pago eliminado!');
        }
    }

}
