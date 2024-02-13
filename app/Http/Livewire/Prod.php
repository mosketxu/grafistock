<?php

namespace App\Http\Livewire;

use App\Models\{ProductoMaterial,ProductoAcabado, ProductoGrupoproduccion,Entidad,Producto, ProductoCaja, ProductoFamilia, ProductoTipo, UnidadCoste, Ubicacion, Unidad};
use Illuminate\Support\Facades\Storage;
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
            'producto.entidad_id'=>'required',
            'producto.referencia'=>'required',
            'producto.descripcion'=>'nullable',
            'producto.tipo_id'=>'required',
            'producto.favorito'=>'required',
            'producto.material_id'=>'required',
            'producto.grosor_mm'=>'nullable',
            'producto.ancho'=>'required',
            'producto.udancho_id'=>'nullable|required_with:producto.ancho',
            'producto.alto'=>'required',
            'producto.udalto_id'=>'nullable|required_with:producto.alto',
            'producto.acabado_id'=>'nullable',
            'producto.grupoproduccion_id'=>'nullable',
            'producto.familia_id'=>'nullable',
            'producto.udsolicitud_id'=>'required',
            'producto.ubicacion_id'=>'nullable',
            'producto.preciocoste'=>'nullable',
            'producto.costereal'=>'nullable',
            'producto.udpreciocoste_id'=>'nullable|required_with:producto.preciocoste',
            'producto.preciocompra'=>'nullable',
            'producto.udpreciocompra_id'=>'nullable|required_with:producto.preciocompra',
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
        $familias=ProductoFamilia::orderBy('nombre')->get();
        $gruposprod=ProductoGrupoproduccion::orderBy('nombre')->get();
        $proveedores=Entidad::orderBy('entidad')->whereIn('entidadtipo_id',['2','3'])->get();
        $unidades=Unidad::orderBy('nombre','asc')->get();
        $unidadescoste=UnidadCoste::orderBy('nombre')->get();
        $cajas=ProductoCaja::orderBy('nombre')->get();
        $ubicaciones=Ubicacion::orderBy('nombre')->get();
        return view('livewire.prod',compact('materiales','tipos','acabados','familias','gruposprod','proveedores','unidades','unidadescoste','unidades','cajas','ubicaciones'));
    }

    public function updatedProducto(){
        $p='';
        if($this->producto->entidad_id){
            $p=Entidad::find($this->producto->entidad_id);
            $p=$p->id;
        }

        $tipo=$this->producto->tipo->nombrecorto ?? '';
        $material=$this->producto->material->nombrecorto ?? '';
        $acabado=$this->producto->acabado->nombrecorto ?? '';

        $this->producto->referencia=$tipo.'-'.$material.'-'.str_pad($this->producto->grosor_mm, 4, '0', STR_PAD_LEFT).'-'.str_pad($this->producto->ancho, 4, '0', STR_PAD_LEFT).'-'.str_pad($this->producto->alto, 4, '0', STR_PAD_LEFT).'-'.$acabado.'-'.$p;

        if($this->producto->tipo_id && $this->producto->material_id && $this->producto->ancho && $this->producto->alto  && $this->producto->acabado_id && $p){
            $this->validate(['producto.referencia'=>'unique:productos,referencia']);
        }
    }

    public function updatedficheropdf(){
        $this->validate(['ficheropdf'=>'file|max:5000']);
    }

    public function favorito(){
        $this->producto->favorito=$this->producto->favorito=='1' ? '0' : '1';
    }

    public function presentaPDF(Producto $producto){
        $existe=Storage::disk('fichasproducto')->exists($producto->fichaproducto);
        if ($existe)
            return Storage::disk('fichasproducto')->download($producto->fichaproducto);
    }

    public function save(){
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
        $filename="";
        if ($this->ficheropdf) {
            $nombre=$this->producto->referencia.'.'.$this->ficheropdf->extension();
            $filename=$this->ficheropdf->storeAs('/', $nombre, 'fichasproducto');
        }

        if (!$this->producto->favorito)
            $this->producto->favorito=0;
        if (!$this->producto->costereal)
            $this->producto->costereal=0;
        if (!$this->producto->preciocoste)
            $this->producto->preciocoste=0;

        $prod=Producto::updateOrCreate([
            'id'=>$i
            ],
            [
            'referencia'=>$this->producto->referencia,
            'descripcion'=>$this->producto->descripcion,
            'tipo_id'=>$this->producto->tipo_id,
            'favorito'=>$this->producto->favorito,
            'material_id'=>$this->producto->material_id,
            'grosor_mm'=>$this->producto->grosor_mm,
            'ancho'=>$this->producto->ancho,
            'udancho_id'=>$this->producto->udancho_id,
            'alto'=>$this->producto->alto,
            'udalto_id'=>$this->producto->udalto_id,
            'acabado_id'=>$this->producto->acabado_id,
            'grupoproduccion_id'=>$this->producto->grupoproduccion_id,
            'familia_id'=>$this->producto->familia_id,
            'udsolicitud_id'=>$this->producto->udsolicitud_id,
            'ubicacion_id'=>$this->producto->ubicacion_id,
            'preciocoste'=>$this->producto->preciocoste,
            'costereal'=>$this->producto->costereal,
            'udpreciocoste_id'=>$this->producto->udpreciocoste_id,
            'preciocompra'=>$this->producto->preciocompra,
            'udpreciocompra_id'=>$this->producto->udpreciocompra_id,
            'entidad_id'=>$this->producto->entidad_id,
            'caja_id'=>$this->producto->caja_id,
            'costecaja'=>$this->producto->costecaja,
            // 'fichaproducto'=>$filename,
            'observaciones'=>$this->producto->observaciones,
            ]
        );
        if($this->ficheropdf){
            $prod->fichaproducto=$filename;
            $prod->save();
        }

        if(!$this->producto->id){
            $this->producto->id=$prod->id;
            $mensaje=$this->producto->referencia . " creado satisfactoriamente";
        }
        $this->dispatchBrowserEvent('notify', $mensaje);
    }
}
