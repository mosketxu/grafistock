<?php

namespace App\Http\Livewire;

use App\Models\{ProductoMaterial,ProductoAcabado, ProductoGrupoproduccion,Entidad,Producto, ProductoCaja, ProductoCalidad, ProductoClase, ProductoTipo, ProductoUnidadcoste, Seccion, Ubicacion, Unidad};
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class Prod extends Component
{

    use WithFileUploads;

    public $producto;
    public $ficheropdf;

    protected function rules()
    {
        return [
            'producto.id'=>'nullable',
            'producto.referencia'=>'required|unique:productos,referencia',
            'producto.descripcion'=>'nullable',
            'producto.tipo_id'=>'required',
            'producto.material_id'=>'required',
            'producto.grosor_mm'=>'nullable',
            'producto.ancho'=>'required',
            'producto.udancho_id'=>'nullable|required_with:producto.ancho',
            'producto.alto'=>'required',
            'producto.udalto_id'=>'nullable|required_with:producto.alto',
            'producto.acabado_id'=>'nullable',
            'producto.grupoproduccion_id'=>'nullable',
            'producto.clase_id'=>'nullable',
            'producto.calidad_id'=>'nullable',
            'producto.udsolicitud_id'=>'required',
            'producto.costeprov'=>'nullable',
            'producto.udcoste_id'=>'nullable|required_with:producto.costeprov',
            'producto.costegrafitex'=>'nullable',
            'producto.udproducto_id'=>'nullable|required_with:producto.costegrafitex',
            'producto.entidad_id'=>'required',
            'producto.caja_id'=>'nullable',
            'producto.costecaja'=>'nullable',
            'producto.fichaproducto'=>'nullable',
            'producto.observaciones'=>'nullable',
        ];
    }

    public function mount(Producto $producto)
    {
        $this->producto=$producto;
    }

    public function render()
    {
        $materiales=ProductoMaterial::orderBy('nombre')->get();
        $tipos=ProductoTipo::orderBy('nombre')->get();
        $acabados=ProductoAcabado::orderBy('nombre')->get();
        $clases=ProductoClase::orderBy('nombre')->get();
        $calidades=ProductoCalidad::orderBy('nombre')->get();
        $gruposprod=ProductoGrupoproduccion::orderBy('nombre')->get();
        $proveedores=Entidad::orderBy('entidad')->get();
        $unidades=Unidad::orderBy('nombre','asc')->get();
        $unidadescoste=ProductoUnidadcoste::orderBy('nombre')->get();
        $cajas=ProductoCaja::orderBy('nombre')->get();
        $ubicaciones=Ubicacion::orderBy('nombre')->get();
        return view('livewire.prod',compact('materiales','tipos','acabados','clases','calidades','gruposprod','proveedores','unidades','unidadescoste','unidades','cajas','ubicaciones'));
    }

    public function updatedProducto(){
        $p='';
        if($this->producto->entidad_id){
            $p=Entidad::find($this->producto->entidad_id);
            $p=$p->entidad5;
        }
        $this->producto->referencia=$this->producto->tipo_id.'-'.$this->producto->material_id.'-'.str_pad($this->producto->ancho, 4, '0', STR_PAD_LEFT).'-'.str_pad($this->producto->alto, 4, '0', STR_PAD_LEFT).'-'.$this->producto->acabado_id.'-'.$p;

        if($this->producto->tipo_id && $this->producto->material_id && $this->producto->ancho && $this->producto->alto  && $this->producto->acabado_id && $p){
            $this->validate(['producto.referencia'=>'unique:productos,referencia']);
        }
    }

    public function updatedficheropdf()
    {
        $this->validate(['ficheropdf'=>'file|max:5000']);
    }


    public function save()
    {
        // dd($this->ficheropdf);
        $this->validate();
        if($this->producto->id){
            $i=$this->producto->id;
            $this->validate([
                'producto.referencia'=>[
                    'required',
                    Rule::unique('productos','referencia')->ignore($this->producto->id)
                    ],

                ],
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

        // $filename=$this->ficheropdf->store('/','fichasproducto');
        // $filename=$this->ficheropdf->storeAs('/','pp.pdf','fichasproducto');
        $filename="";
        if ($this->ficheropdf) {
            $nombre=$this->producto->referencia.'.'.$this->ficheropdf->extension();
            $filename=$this->ficheropdf->storeAs('/', $nombre, 'fichasproducto');
        }

        $prod=Producto::updateOrCreate([
            'id'=>$i
            ],
            [
            'referencia'=>$this->producto->referencia,
            'descripcion'=>$this->producto->descripcion,
            'tipo_id'=>$this->producto->tipo_id,
            'material_id'=>$this->producto->material_id,
            'grosor_mm'=>$this->producto->grosor_mm,
            'ancho'=>$this->producto->ancho,
            'udancho_id'=>$this->producto->udancho_id,
            'alto'=>$this->producto->alto,
            'udalto_id'=>$this->producto->udalto_id,
            'acabado_id'=>$this->producto->acabado_id,
            'grupoproduccion_id'=>$this->producto->grupoproduccion_id,
            'clase_id'=>$this->producto->clase_id,
            'calidad_id'=>$this->producto->calidad_id,
            'udsolicitud_id'=>$this->producto->udsolicitud_id,
            'costeprov'=>$this->producto->costeprov,
            'udcoste_id'=>$this->producto->udcoste_id,
            'costegrafitex'=>$this->producto->costegrafitex,
            'udproducto_id'=>$this->producto->udproducto_id,
            'entidad_id'=>$this->producto->entidad_id,
            'caja_id'=>$this->producto->caja_id,
            'costecaja'=>$this->producto->costecaja,
            'fichaproducto'=>$filename,
            'observaciones'=>$this->producto->observaciones,
            ]
        );

        if(!$this->producto->id){
            $this->producto->id=$prod->id;
            $mensaje=$this->producto->referencia . " creado satisfactoriamente";
            session()->flash('message', $mensaje);
        }

        session()->flash('message', $mensaje);
        // return redirect()->route('pedido.create');
        // $this->emitSelf('notify-saved');
    }

}
