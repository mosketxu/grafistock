<?php

namespace App\Http\Livewire;

use App\Http\Controllers\PresupuestoController;
use App\Models\PresupuestoControlpartida as ModelPresupuestoControlpartida;
use Livewire\Component;

class PresupControlpartida extends Component
{
    public $controlpartida;
    public $partidaId;
    public $partida;
    public $contador;
    public $activo;

    public function mount(ModelPresupuestoControlpartida $controlpartida)
    {
        $this->controlpartida=$controlpartida;
        $this->activo=$controlpartida->activo;
        $this->partida=$controlpartida->acciontipo->nombre ?? 'No Activo';
        $this->contador=$controlpartida->contador;
    }

    public function render()
    {
        return view('livewire.presup-controlpartida');
    }

    public function UpdatedActivo(){
        $this->controlpartida->activo=$this->activo;
        $this->controlpartida->save();
        $this->dispatchBrowserEvent("notify", "Partida actualizada.");

    }
}
