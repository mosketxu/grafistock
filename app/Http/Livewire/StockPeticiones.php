<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Models\{StockPeticion, Solicitante};
use Livewire\Component;

class StockPeticiones extends Component
{

    use WithPagination, WithBulkActions;

    public $search='';
    public $filtropeticion='';
    public $filtrosolicitante='';
    public $filtroanyo='';
    public $filtromes='';
    public $filtroestado='0';


    public function render()
    {
        $solicitantes=Solicitante::orderBy('nombre')->get();

        // dd($this->filtroestado<'4');
        $stockpeticiones=StockPeticion::orderByDesc('fechasolicitud')->orderBy('peticion')
            ->with('solicitante')
            ->search('peticion',$this->filtropeticion)
            ->when($this->filtrosolicitante!='', function ($query){
                $query->where('solicitante_id',$this->filtrosolicitante);
            })
            ->when($this->filtroestado<'4', function ($query){
                $query->where('estado',$this->filtroestado);
            })
            ->searchYear('fechasolicitud',$this->filtroanyo)
            ->searchMes('fechasolicitud',$this->filtromes)
            ->paginate(15);

        return view('livewire.stock-peticiones',compact('solicitantes','stockpeticiones'));
    }

    public function delete($stockpeticionId)
    {
        $stockpeticion = StockPeticion::find($stockpeticionId);
        if ($stockpeticion) {
            $stockpeticion->delete();
            $this->dispatchBrowserEvent('notify', 'La petición: '.$pedido->id.'-'.$pedido->pedido.' ha sido eliminada!');
        }
    }

}
