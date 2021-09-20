<?php

namespace App\Http\Livewire;

use App\Models\{Entidad,MetodoPago,Pais,Provincia};
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
            'entidad.cuentactble'=>'numeric|nullable|unique:entidades,cuentactble',
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
            'entidad.diafactura'=>'numeric|nullable',
            'entidad.diavencimiento'=>'numeric|nullable',
            'entidad.observaciones'=>'nullable',
            'entidad.usuario'=>'nullable',
            'entidad.password'=>'nullable',
            'entidad.cliente'=>'required_without:entidad.proveedor',
            'entidad.proveedor'=>'required_without:entidad.cliente',
        ];
    }

    public function mount(Entidad $entidad,$tipo)
    {
        $this->entidad=$entidad;
        if($tipo=='Cliente') $this->entidad->cliente=true;
        if($tipo=='Proveedor') $this->entidad->proveedor=true;
    }


    public function render()
    {
        if (!$this->entidad->estado) $this->entidad->estado=true;
        $entidad=$this->entidad;

        $metodopagos=MetodoPago::all();
        $provincias=Provincia::all();
        $paises=Pais::all();
        return view('livewire.ent',compact('metodopagos','provincias','paises'));
    }

    public function save()
    {
        if($this->cliente=null) $this->cliente='0';
        if($this->proveedor=null) $this->proveedor='0';

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
            $mensaje="Proveedor actualizad satisfactoriamente";
        }else{
            $this->validate([
                'entidad.entidad'=>'required|unique:entidades,entidad',
                'entidad.nif'=>'max:12|unique:entidades,nif',
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
            'cuentactble'=>$this->entidad->cuentactble,
            'usuario'=>$this->entidad->usuario,
            'password'=>$this->entidad->password,
            'cliente'=>$this->entidad->cliente,
            'proveedor'=>$this->entidad->proveedor,
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
