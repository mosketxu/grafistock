<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoLineaDetalle extends Model
{
    use HasFactory;

    protected $fillable= ['presupuestolinea_id','acciontipo_id','accionproducto_id','entidad_id','empresatipo_id','visible','orden','descripcion',
    'preciocoste_ud','preciocoste','precioventa_ud','precioventa','udpreciocoste_id','factor','merma','aux','unidades','minutos','ancho','alto','ruta','fichero','observaciones'];

    public function presupuestolinea(){return $this->belongsTo(PresupuestoLinea::class);}
    public function producto(){return $this->belongsTo(Producto::class,'accionproducto_id');}
    public function empresatipo(){return $this->belongsTo(EmpresaTipo::class,'empresatipo_id');}
    public function accion(){return $this->belongsTo(Accion::class,'accionproducto_id');}
    public function acciontipo(){return $this->belongsTo(AccionTipo::class,'acciontipo_id');}
    public function unidadpreciocoste(){return $this->belongsTo(UnidadCoste::class,'udpreciocoste_id');}
    public function proveedor(){return $this->belongsTo(Entidad::class,'entidad_id');}

    public function getDeshabilitadoPcosteAttribute(){
        $acciontipo=$this->acciontipo->nombrecorto;
        if($acciontipo=="PFM" ||$acciontipo=="EXT" ||$acciontipo=="COM"  )
            return '';
        else
            return 'disabled';
    }

    public function getDeshabilitadoColorpCosteAttribute(){
        $acciontipo=$this->acciontipo->nombrecorto;
        if($acciontipo=="PFM" ||$acciontipo=="EXT" ||$acciontipo=="COM" )
            return '';
        else
            return 'bg-gray-100';
    }

    public function getAnchoaltoColorAttribute(){
        return [
            '0'=>['bg-gray-100','disabled'],
            '1'=>['','']
        ][$this->unidadpreciocoste->nombrecorto=='e_m2'] ?? ['gray',''];
    }

    public function getMinutosColorAttribute(){
        return [
            '0'=>['bg-gray-100','disabled'],
            '1'=>['','']
        ][$this->unidadpreciocoste->nombrecorto=='e_min'] ?? ['gray',''];
    }

    public function clonarlinea(){
        $clonelineadetalle = $this->replicate();
        $clonelineadetalle->save();
    }
}
