<?php

namespace App\Http\Livewire;

use App\Models\{Entidad, EntidadTipo, EmpresaTipo, MetodoPago,Pais,Provincia};
use Livewire\Component;
use Illuminate\Validation\Rule;


class Ent extends Component
{
    public $entidad;
    public $tipo;

    protected function rules()
    {
        return [
            'entidad.id'=>'nullable',
            'entidad.entidad'=>'required',
            'entidad.nif'=>'max:12',
            'entidad.cuentactblepro'=>'numeric|nullable|unique:entidades,cuentactblepro',
            'entidad.cuentactblecli'=>'numeric|nullable|unique:entidades,cuentactblecli',
            'entidad.direccion'=>'nullable',
            'entidad.cp'=>'max:10|nullable',
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
            'entidad.ratio'=>'nullable|numeric',
            'entidad.diafactura'=>'numeric|nullable',
            'entidad.diavencimiento'=>'numeric|nullable',
            'entidad.observaciones'=>'nullable',
            'entidad.usuario'=>'nullable',
            'entidad.password'=>'nullable',
            'entidad.entidadtipo_id'=>'required',
            'entidad.empresatipo_id'=>'nullable',
        ];
    }

    public function mount(Entidad $entidad,$tipo)
    {
        $this->entidad=$entidad;
        $this->entidad->entidadtipo_id=$tipo;
        $this->tipo=EntidadTipo::find($tipo);
    }


    public function render()
    {
        // dd($this->tipo);
        if (!$this->entidad->estado) $this->entidad->estado=true;
        $entidad=$this->entidad;

        $metodopagos=MetodoPago::all();
        $provincias=Provincia::all();
        $paises=Pais::all();
        $paises=Pais::all();
        $tiposentidad=EntidadTipo::orderBy('id')->get();
        $tiposempresa=EmpresaTipo::orderBy('nombrecorto')->get();
        return view('livewire.ent',compact('metodopagos','provincias','paises','tiposentidad','tiposempresa'));
    }

    public function save()
    {
        $this->validate();
        if($this->entidad->id){
            $i=$this->entidad->id;
            $this->validate([
                'entidad.entidad'=>[
                    'required',
                    Rule::unique('entidades','entidad')->ignore($this->entidad->id)],
                'entidad.nif'=>[
                    'max:12',
                    Rule::unique('entidades','nif')->ignore($this->entidad->id)],
                ]
            );
            $mensaje="Proveedor actualizado satisfactoriamente";
        }else{
            $this->validate([
                'entidad.entidad'=>'required|unique:entidades,entidad',
                'entidad.nif'=>'max:12|unique:entidades,nif',
                ]
            );
            $i=$this->entidad->id;
            $mensaje="Proveedor creado satisfactoriamente";
        }

        // dd($this->entidad);
        $ent=Entidad::updateOrCreate([
            'id'=>$i
            ],
            [
            'entidad'=>$this->entidad->entidad,
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
            'ratio'=>$this->entidad->ratio,
            'diafactura'=>$this->entidad->diafactura,
            'diavencimiento'=>$this->entidad->diavencimiento,
            'observaciones'=>$this->entidad->observaciones,
            'cuentactblepro'=>$this->entidad->cuentactblepro,
            'cuentactblecli'=>$this->entidad->cuentactblecli,
            'usuario'=>$this->entidad->usuario,
            'password'=>$this->entidad->password,
            'entidadtipo_id'=>$this->entidad->entidadtipo_id,
            'empresatipo_id'=>$this->entidad->empresatipo_id,
            ]
        );
        if(!$this->entidad->id){
            $this->entidad->id=$ent->id;
            // $mensaje=$this->entidad->entidad . " creada satisfactoriamente";
            // session()->flash('message', $mensaje);
        }

        // session()->flash('message', $mensaje);
        // $this->emitSelf('notify-saved');
        $this->dispatchBrowserEvent('notify', $mensaje);
    }
}
