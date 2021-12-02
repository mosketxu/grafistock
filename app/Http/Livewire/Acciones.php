<?php

namespace App\Http\Livewire;

use App\Models\Accion;
use App\Models\AccionTipo;
use App\Models\Unidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;


class Acciones extends Component
{

    use WithPagination;
    public $search='';
    public $acciontipofiltro='';
    public $accion_id='';
    public $referencia='';
    public $descripcion='';
    public $acciontipo_id='';
    public $preciotarifa='';
    public $udpreciotarifa_id='';
    public $precioventa='';
    public $observaciones='';

    // protected $listeners = [ 'refresh' => '$refresh'];

    public $showDeleteModal=false;
    public $showNewModal = false;

    protected function rules()
    {
        return [
            'descripcion'=>'nullable',
            'acciontipo_id'=>'required|numeric',
            'preciotarifa'=>'numeric|nullable',
            'udpreciotarifa_id'=>'numeric|nullable',
            'precioventa'=>'numeric|nullable',
            'observaciones'=>'string|nullable',
        ];
    }


    public function render()
    {
        $acciontipos=AccionTipo::orderBy('nombre')->get();
        $unidades=Unidad::orderBy('nombre')->get();

        $acciones=Accion::query()
            ->search('referencia',$this->search)
            ->orSearch('descripcion',$this->search)
            ->when($this->acciontipofiltro!='', function ($query){$query->where('acciontipo_id',$this->acciontipofiltro);})
            ->orderBy('referencia')->paginate(15);
        return view('livewire.acciones',compact('acciones','acciontipos','unidades'));
    }

    public function create(){
        $this->resetInputFields();
        $this->openNewModal();
    }


    public function openNewModal(){
        $this->showNewModal = true;
    }

    public function closeNewModal(){
        $this->showNewModal = false;
    }

    private function resetInputFields(){
        $this->referencia='';
        $this->descripcion='';
        $this->acciontipo_id='';
        $this->preciotarifa='';
        $this->udpreciotarifa_id='';
        $this->precioventa='';
        $this->observaciones='';
    }

    public function store()
    {
        $cond=Auth::user()->can('accion.edit');
        if ($cond==true) {
            $this->validate();
            if ($this->accion_id) {
                $this->validate(
                    [
                    'referencia'=>[
                        'required',
                        Rule::unique('acciones', 'referencia')->ignore($this->accion_id)],
                    ]
                );
            } else {
                $this->validate(
                    [
                    'referencia'=>'required|unique:acciones,referencia'
                    ]
                );
            }

            $accion=Accion::updateOrCreate(['id'=>$this->accion_id], [
                'referencia'=>$this->referencia,
                'descripcion'=>$this->descripcion,
                'acciontipo_id'=>$this->acciontipo_id,
                'preciotarifa'=>$this->preciotarifa,
                'udpreciotarifa_id'=>$this->udpreciotarifa_id,
                'precioventa'=>$this->precioventa,
                'observaciones'=>$this->observaciones,
            ]);

            $this->dispatchBrowserEvent('notify', 'Accion añadida con éxito');

            $this->closeNewModal();
        }
    }

    public function edit($id) {
        $this->accion_id=$id;
        $accion = Accion::findOrFail($id);
        $this->referencia=$accion->referencia;
        $this->descripcion=$accion->descripcion;
        $this->acciontipo_id=$accion->acciontipo_id;
        $this->preciotarifa=$accion->preciotarifa;
        $this->udpreciotarifa_id=$accion->udpreciotarifa_id;
        $this->precioventa=$accion->precioventa;
        $this->observaciones=$accion->observaciones;
        $this->openNewModal();
    }


    public function delete($valorId)
    {
        $borrar = Accion::find($valorId);

        if ($borrar) {
            $borrar->delete();
            $this->dispatchBrowserEvent('notify', '¡Acción eliminada!');
        }
    }


}
