<?php

namespace App\Http\Livewire;

use App\Models\{Entidad, EntidadTipo, EmpresaTipo, EntidadCategoria, MetodoPago,Pais,Provincia, User};
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;



class Ent extends Component
{
    public $entidad;
    public $tipo;

    protected function rules()
    {
        return [
            'entidad.id'=>'nullable',
            'entidad.entidad'=>'required',
            'entidad.comercial_id'=>'nullable|numeric',
            'entidad.nif'=>'nullable|max:12',
            'entidad.presupuesto'=>'nullable',
            'entidad.cuentactblepro'=>'nullable|numeric',
            'entidad.cuentactblecli'=>'nullable|numeric',
            'entidad.direccion'=>'nullable',
            'entidad.cp'=>'nullable|max:10',
            'entidad.localidad'=>'nullable',
            'entidad.provincia_id'=>'nullable',
            'entidad.pais_id'=>'nullable',
            'entidad.tfno'=>'nullable',
            'entidad.emailgral'=>'nullable',
            'entidad.emailadm'=>'nullable',
            'entidad.emailaux'=>'nullable',
            'entidad.web'=>'nullable',
            'entidad.metodopago_id'=>'nullable',
            'entidad.banco1'=>'nullable',
            'entidad.banco2'=>'nullable',
            'entidad.banco3'=>'nullable',
            'entidad.iban1'=>'nullable',
            'entidad.iban2'=>'nullable',
            'entidad.iban3'=>'nullable',
            'entidad.diafactura'=>'numeric|nullable',
            'entidad.diavencimiento'=>'numeric|nullable',
            'entidad.observaciones'=>'nullable',
            'entidad.usuario'=>'nullable',
            'entidad.password'=>'nullable',
            'entidad.entidadtipo_id'=>'required',
            'entidad.empresatipo_id'=>'nullable',
            'entidad.entidadcategoria_id'=>'nullable',
        ];
    }

    public function mount(Entidad $entidad,$tipo)
    {
        $this->entidad=$entidad;
        $this->entidad->entidadtipo_id=$tipo;
        if(!$this->entidad->empresatipo_id) $this->entidad->empresatipo_id='3';
        $this->tipo=EntidadTipo::find($tipo);
        if(Auth::user()->hasRole('Comercial')) $this->entidad->comercial_id=Auth::user()->id;
    }


    public function render()
    {
        if (!$this->entidad->estado) $this->entidad->estado=true;
        $entidad=$this->entidad;
        $comerciales=User::role('Comercial')->orderBy('name')->get();
        $metodopagos=MetodoPago::all();
        $provincias=Provincia::all();
        $paises=Pais::all();
        $paises=Pais::all();
        $tiposentidad=EntidadTipo::orderBy('id')->get();
        $tiposempresa=EmpresaTipo::orderBy('nombrecorto')->get();
        $tiposcategoria=EntidadCategoria::orderBy('nombrecorto')->get();
        return view('livewire.ent',compact('metodopagos','provincias','paises','tiposentidad','tiposempresa','tiposcategoria','comerciales'));
    }

    public function UpdatedEntidadEntidadcategoriaId()
    {
        if($this->entidad->entidadcategoria_id==''){
            $this->entidad->entidadcategoria_id=null;
        }
    }


    public function save()
    {
        // dd($this->entidad->entidadcategoria_id);
        $this->validate();
        if($this->entidad->id){
            $i=$this->entidad->id;
            $this->validate([
                'entidad.entidad'=>[
                    'required',
                    Rule::unique('entidades','entidad')->ignore($this->entidad->id)],
                'entidad.nif'=>[
                    'nullable',
                    'max:12',
                    Rule::unique('entidades','nif')->ignore($this->entidad->id)],
                'entidad.cuentactblepro'=>[
                    'nullable',
                    Rule::unique('entidades','cuentactblepro')->ignore($this->entidad->id)],
                'entidad.cuentactblecli'=>[
                    'nullable',
                    Rule::unique('entidades','cuentactblecli')->ignore($this->entidad->id)],
                ]
            );
            $mensaje="Proveedor actualizado satisfactoriamente";
        }else{
            $this->validate([
                'entidad.entidad'=>'required|unique:entidades,entidad',
                'entidad.nif'=>'nullable|max:12|unique:entidades,nif',
                'entidad.cuentactblepro'=>'nullable|numeric|unique:entidades,cuentactblepro',
                'entidad.cuentactblecli'=>'nullable|numeric|unique:entidades,cuentactblecli',

                ]
            );
            $i=$this->entidad->id;
            $mensaje="Proveedor creado satisfactoriamente";
        }
        $ent=Entidad::updateOrCreate([
            'id'=>$i
            ],
            [
            'entidad'=>$this->entidad->entidad,
            'comercial_id'=>$this->entidad->comercial_id,
            'presupuesto'=>$this->entidad->presupuesto,
            'nif'=>$this->entidad->nif,
            'direccion'=>$this->entidad->direccion,
            'cp'=>$this->entidad->cp,
            'localidad'=>$this->entidad->localidad,
            'provincia_id'=>$this->entidad->provincia_id,
            'pais_id'=>$this->entidad->pais_id,
            'tfno'=>$this->entidad->tfno,
            'emailgral'=>$this->entidad->emailgral,
            'emailadm'=>$this->entidad->emailadm,
            'emailaux'=>$this->entidad->emailaux,
            'web'=>$this->entidad->web,
            'metodopago_id'=>$this->entidad->metodopago_id,
            'estado'=>$this->entidad->estado,
            'banco1'=>$this->entidad->banco1,
            'banco2'=>$this->entidad->banco2,
            'banco3'=>$this->entidad->banco3,
            'iban1'=>$this->entidad->iban1,
            'iban2'=>$this->entidad->iban2,
            'iban3'=>$this->entidad->iban3,
            'diafactura'=>$this->entidad->diafactura,
            'diavencimiento'=>$this->entidad->diavencimiento,
            'observaciones'=>$this->entidad->observaciones,
            'cuentactblepro'=>$this->entidad->cuentactblepro,
            'cuentactblecli'=>$this->entidad->cuentactblecli,
            'usuario'=>$this->entidad->usuario,
            'password'=>$this->entidad->password,
            'entidadtipo_id'=>$this->entidad->entidadtipo_id,
            'empresatipo_id'=>$this->entidad->empresatipo_id,
            'entidadcategoria_id'=>$this->entidad->entidadcategoria_id,
            ]
        );
        if(!$this->entidad->id){
            $this->entidad->id=$ent->id;
        }


        $this->dispatchBrowserEvent('notify', $mensaje);
    }
}
