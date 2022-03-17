<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{AccionTipo, Presupuesto,Entidad, EntidadContacto, PresupuestoControl, PresupuestoControlpartida, PresupuestoLinea, PresupuestoLineaDetalle, User};
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\DataTable\WithBulkActions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Presups extends Component
{
    use WithPagination, WithBulkActions;

    public $search='';
    public $filtroanyo='';
    public $filtromes='';
    public $filtroclipro='';
    public $filtrosolicitante='';
    public $filtroestado='';
    public $entidad;
    public $message;
    public $total;
    public $contactos='';

    public $presupuesto_id='',$presupuesto,$descripcion,$entidad_id,$entidadcontacto_id,$solicitante_id,$fechapresupuesto,$refgrafitex,$refcliente,$precioventa,$preciocoste,$unidades,$incremento,$iva='0.21',$ruta,$fichero,$estado='0',$observaciones;

    public $showDeleteModal=false;
    public $showNewModal = false;

    protected function rules(){
        return[
            'filtroanyo'=>'required',
            'filtromes'=>'required',
        ];
    }

    public function mount(Entidad $entidad)
    {
        $this->filtroanyo=date('Y');
        $this->entidad=$entidad;
        if($this->entidad)
            $this->contactos=EntidadContacto::where('entidad_id',$entidad->id)->orderBy('contacto')->get();
    }

    public function render()
    {
        if($this->selectAll) $this->selectPageRows();
        $presupuestos = $this->rows;
        $clientes = Entidad::query()
            ->when(Auth::user()->hasRole('Comercial'),function ($query){
                $query->where('comercial_id',Auth::user()->id);
            })
            ->whereIn('entidadtipo_id',['1','3','4'])->orderBy('entidad')->get();
        $solicitantes=User::role('Comercial')->orderBy('name')->get();
        $totalcoste=$presupuestos->sum('preciocoste');
        $totalventa=$presupuestos->sum('precioventa');
        return view('livewire.presups',compact('presupuestos','clientes','solicitantes','totalcoste','totalventa'));
    }


    public function updatingFiltroclipro(){
        $this->resetPage();
    }
    public function updatingFiltroanyo(){
        $this->resetPage();
    }
    public function updatingFiltromes(){
        $this->resetPage();
    }

    public function create(){
        $this->resetInputFields();
        $this->openNewModal();
    }

    public function updatedEntidadId(){
        $this->entidadcontacto_id='';
        $e=Entidad::find($this->entidad_id);
        $this->contactos=EntidadContacto::where('entidad_id',$e->id)->orderBy('contacto')->get();
    }

    public function replicateRow(Presupuesto $presupuesto){
        // inicializo las vbles nuevas
        $this->fechapresupuesto=now();
        $this->numpresupuesto();
        // clono la cabecera del presupuesto
        $clone = $presupuesto->replicate()->fill([
            'fechapresupuesto'=>$this->fechapresupuesto,
            'presupuesto'=>$this->presupuesto,
        ]);
        $clone->save();
        // clono las acciones
        $partidas= PresupuestoControlpartida::where('presupuesto_id',$presupuesto->id)->get();
        foreach ($partidas as $partida) {
            $partida->replicate()->fill([
                'presupuesto_id'=>$clone->id,
            ])->save();
            // $clonepartida->save();
        }
        // clono las lineas del presupuesto
        foreach($presupuesto->presupuestolineas as $presupuestolinea)
        {
            $clonelinea = $presupuestolinea->replicate()->fill([
                'presupuesto_id'=>$clone->id,
            ]);
            $clonelinea->save();
            // clono las lineasdetalle del presupuesto
            $detallelineas=PresupuestoLineaDetalle::where('presupuestolinea_id',$presupuestolinea->id)->get();
            foreach ($detallelineas as $detallelinea) {
                $clonedetallelinea = $detallelinea->replicate()->fill([
                    'presupuestolinea_id'=>$clonelinea->id,
                ])->save();
            }
        }
        $this->dispatchBrowserEvent('notify', 'Presupuestos copiado!');
    }


    public function openNewModal(){
        $this->showNewModal = true;
    }

    public function closeNewModal(){
        $this->resetInputFields();
        $this->showNewModal = false;
    }

    private function resetInputFields(){
        $this->presupuesto='';
        $this->descripcion='';
        $this->entidad_id='';
        $this->solicitante_id='';
        $this->entidadcontacto_id='';
        $this->fechapresupuesto='';
        $this->refgrafitex='';
        $this->refcliente='';
        $this->precioventa='0';
        $this->preciocoste='0';
        $this->unidades='0';
        $this->incremento='0';
        $this->iva='0.21';
        $this->ruta='';
        $this->fichero='';
        $this->estado='0';
        $this->observaciones='';
    }

    public function store(){
        if($this->solicitante_id=='') $this->solicitante_id= Auth()->user()->id;
        if($this->entidadcontacto_id=='') $this->entidadcontacto_id= null;

        $this->validate([
            'entidad_id' => 'required',
            'solicitante_id' => 'required|numeric',
            'entidadcontacto_id' => 'nullable|numeric',
            'descripcion' => 'required',
            'fechapresupuesto' => 'required|date',
            'refgrafitex' => 'nullable',
            'refcliente' => 'nullable',
            'preciocoste' => 'nullable|numeric',
            'precioventa' => 'nullable|numeric',
            'incremento' => 'required|numeric',
            'estado' => 'required',
            'iva' => 'required',
        ]);

        $destino="editar";
        if(!$this->presupuesto){
            $this->numpresupuesto();
            $destino="nuevo";
        }
        $presupuesto = Presupuesto::updateOrCreate(['id' => $this->presupuesto_id], [
            'presupuesto'=>$this->presupuesto,
            'descripcion'=>$this->descripcion,
            'entidad_id'=>$this->entidad_id,
            'entidadcontacto_id'=>$this->entidadcontacto_id,
            'solicitante_id'=>$this->solicitante_id,
            'fechapresupuesto'=>$this->fechapresupuesto,
            'refgrafitex'=>$this->refgrafitex,
            'refcliente'=>$this->refcliente,
            'precioventa'=>$this->precioventa,
            'preciocoste'=>$this->preciocoste,
            'unidades'=>$this->unidades,
            'incremento'=>$this->incremento,
            'iva'=>$this->iva,
            'ruta'=>$this->ruta,
            'fichero'=>$this->fichero,
            'estado'=>$this->estado,
            'observaciones'=>$this->observaciones,
        ]);

        $presuplineas=PresupuestoLinea::where('presupuesto_id',$this->presupuesto_id)->get();
        if($presuplineas->count()>0){
            foreach($presuplineas as $presuplinea)
            $presuplinea->recalculo(); // por si se ha modificado el %Incremento
        }

        $presupuesto->recalculo(); // por si se ha modificado el %Incremento

        if ($presupuesto->presupuestocontrolpartidas->count()<AccionTipo::count()) {
            $acciontipos=AccionTipo::get();
            foreach ($acciontipos as $acciontipo) {
                $existe=PresupuestoControlpartida::where('acciontipo_id',$acciontipo->id)->where('presupuesto_id',$presupuesto->id)->count();
                if ($existe==0) {
                    $activo=in_array($acciontipo->nombrecorto,['COM','PFM','EXT']) ? '0' : 1;
                    PresupuestoControlpartida::create([
                        'presupuesto_id'=>$presupuesto->id,
                        'acciontipo_id'=>$acciontipo->id,
                        'activo'=>$acciontipo->activo
                    ]);
                }
            }
        }
        $this->message='';
        $message="Prespuesto creado satisfactoriamente";

        session()->flash('message',$message);

        if($destino=="editar"){
            $this->closeNewModal();
            $this->resetInputFields();
        }else{
            return redirect()->route('presupuesto.edit',$presupuesto);
        }
    }

    public function edit($id) {
        $presupuesto = Presupuesto::findOrFail($id);
        $this->presupuesto_id=$presupuesto->id;
        $this->presupuesto=$presupuesto->presupuesto;
        $this->descripcion=$presupuesto->descripcion;
        $this->entidad_id=$presupuesto->entidad_id;
        $this->entidadcontacto_id=$presupuesto->entidadcontacto_id;
        $this->solicitante_id=$presupuesto->solicitante_id;
        $this->fechapresupuesto=$presupuesto->fechapresupuesto;
        $this->refgrafitex=$presupuesto->refgrafitex;
        $this->refcliente=$presupuesto->refcliente;
        $this->preciocoste=$presupuesto->preciocoste;
        $this->precioventa=$presupuesto->precioventa;
        $this->unidades=$presupuesto->unidades;
        $this->incremento=$presupuesto->incremento;
        $this->iva=$presupuesto->iva;
        $this->ruta=$presupuesto->ruta;
        $this->fichero=$presupuesto->fichero;
        $this->estado=$presupuesto->estado;
        $this->observaciones=$presupuesto->observaciones;
        $this->contactos=EntidadContacto::where('entidad_id',$this->entidad_id)->orderBy('contacto')->get();
        $this->openNewModal();
    }

    public function numpresupuesto()
    {
        $anyo= Carbon::parse($this->fechapresupuesto)->year;
        $anyo2= Carbon::parse($this->fechapresupuesto)->format('y');
        $p=Presupuesto::withTrashed()->whereYear('fechapresupuesto', $anyo)->max('presupuesto') ;
        $this->presupuesto= $p ? $p + 1 : ($anyo2 * 100000 +1) ;
    }


    public function getRowsQueryProperty(){
        return Presupuesto::query()
            ->join('entidades','presupuestos.entidad_id','=','entidades.id')
            ->select('presupuestos.*', 'entidades.entidad', 'entidades.nif','entidades.emailadm')
            ->when($this->entidad->id!='', function ($query){
                $query->where('entidad_id',$this->entidad->id);
                })
            ->when($this->filtroclipro!='', function ($query){
                $query->where('entidad_id',$this->filtroclipro);
                })
            ->when($this->filtrosolicitante!='', function ($query){
                $query->where('solicitante_id',$this->filtrosolicitante);
                })
            ->when($this->filtroestado!='', function ($query){
                $query->where('presupuestos.estado',$this->filtroestado);
            })
            ->when(Auth::user()->hasRole('Comercial'),function ($query){
                    $query->when(!Auth::user()->hasRole('Admin'),function ($q){
                            $q->where('solicitante_id',Auth::user()->id);});
            })
            ->searchYear('fechapresupuesto',$this->filtroanyo)
            ->searchMes('fechapresupuesto',$this->filtromes)
            ->search('entidades.entidad',$this->search)
            ->orSearch('presupuestos.presupuesto',$this->search)
            ->orderBy('presupuestos.fechapresupuesto','desc')
            ->orderBy('presupuestos.id','desc');
            // ->paginate(5); solo contemplo la query, no el resultado. Luego pongo el resultado: get, paginate o lo que quiera
    }

    public function getRowsProperty(){
        return $this->rowsQuery->paginate(10);
    }


    public function exportSelected(){
        //toCsv es una macro a n AppServiceProvider
        return response()->streamDownload(function(){
            echo $this->selectedRowsQuery->toCsv();
        },'presupuestos.csv');

        $this->dispatchBrowserEvent('notify', 'CSV Presupuestos descargado!');
    }

    public function deleteSelected(){
        $deleteCount = $this->selectedRowsQuery->count();
        $this->selectedRowsQuery->delete();
        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('notify', $deleteCount . ' Presupuestos eliminados!');
    }

    public function delete($presupuestoId)
    {
        $presupuesto = Presupuesto::find($presupuestoId);
        if ($presupuesto) {
            // $pl=PresupuestoLinea::where('prespuesto_id',$presupuesto->id);
            $presupuesto->presupuestocontrolpartidas()->delete();
            $presupuesto->delete();
            // session()->flash('message', $presupuesto->entidad.' eliminado!');
            $this->dispatchBrowserEvent('notify', 'Presupuesto borrado, ');
        }
    }
}
