<?php

namespace App\Http\Livewire;

use App\Models\{ProductoMaterial,Producto,Seccion,Unidad};
use Livewire\Component;
use Illuminate\Validation\Rule;

class Prod extends Component
{
    public $producto;

    protected function rules()
    {
        return [
            'producto.id'=>'nullable',
            'producto.referencia'=>'required',
            'producto.material_id'=>'nullable',
            'producto.grosor'=>'nullable',
            'producto.ud_grosor'=>'nullable',
            'producto.seccion'=>'nullable',
            'producto.ancho'=>'nullable',
            'producto.alto'=>'nullable',
            'producto.ud_tamanyo'=>'nullable',
            'producto.ubicacion'=>'nullable',
            'producto.coste'=>'nullable',
            'producto.ud_coste'=>'nullable',
            'producto.ud_compra'=>'nullable',
            'producto.pdf'=>'nullable',
            'producto.observaciones'=>'nullable',
        ];
    }

    public function mount(Producto $producto)
    {
        $this->producto=$producto;
    }

    public function render()
    {
        $materiales=ProductoMaterial::orderBy('nombre','asc')->get();
        $unidades=Unidad::orderBy('nombre','asc')->get();
        return view('livewire.prod',compact('materiales','unidades'));
    }

    public function save()
    {
        $this->validate();
        if($this->producto->id){
            $i=$this->producto->id;
            $this->validate([
                'producto.referencia'=>[
                    'required',
                    Rule::unique('productos','referencia')->ignore($this->producto->id)],
                ]
            );
            $mensaje=$this->producto->referencia . " actualizado satisfactoriamente";
        }else{
            $this->validate([
                'producto.referencia'=>'required|unique:productos,referencia',
                ]
            );
            $i=$this->producto->id;
            $message=$this->producto->referencia . " creado satisfactoriamente";
        }

        $prod=Producto::updateOrCreate([
            'id'=>$i
            ],
            [
            'referencia'=>$this->producto->referencia,
            'material_id'=>$this->producto->material_id,
            'grosor'=>$this->producto->grosor,
            'ud_grosor'=>$this->producto->ud_grosor,
            'seccion'=>$this->producto->seccion,
            'ancho'=>$this->producto->ancho,
            'alto'=>$this->producto->alto,
            'ud_tamanyo'=>$this->producto->ud_tamanyo,
            'ubicacion'=>$this->producto->ubicacion,
            'coste'=>$this->producto->coste,
            'ud_coste'=>$this->producto->ud_coste,
            'ud_compra'=>$this->producto->ud_compra,
            'pdf'=>$this->producto->pdf,
            ]
        );
        if(!$this->producto->id){
            $this->producto->id=$prod->id;
            $mensaje=$this->producto->referencia . " creado satisfactoriamente";
            session()->flash('message', $mensaje);
        }

        session()->flash('message', $mensaje);
        return redirect()->route('pedido.create');
        // $this->emitSelf('notify-saved');
    }

}
