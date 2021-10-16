<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Presupuesto,Entidad, Solicitante};
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\DataTable\WithBulkActions;

class Presups extends Component
{
    use WithPagination, WithBulkActions;

    public $search='';
    public $filtroanyo='';
    public $filtromes='';
    public $filtroclipro='';
    public $filtroestado='';
    public $entidad;
    public $message;
    public $total;

    public $presupuesto_id='',$presupuesto,$descripcion,$entidad_id,$solicitante_id,$fechapresupuesto,$precioventa,$preciocoste,$ratio,$unidades,$iva='0.21',$ruta,$fichero,$estado='0',$observaciones;

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
    }

    public function render()
    {
        if($this->selectAll) $this->selectPageRows();
        $presupuestos = $this->rows;
        $clientes = Entidad::whereIn('entidadtipo_id',['1','4'])->orderBy('entidad')->get();
        $solicitantes = Solicitante::orderBy('nombre')->get();

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


    public function openNewModal(){
        $this->showNewModal = true;
    }

    public function closeNewModal(){
        $this->showNewModal = false;
    }

    private function resetInputFields(){
        $this->presupuesto='';
        $this->descripcion='';
        $this->entidad_id='';
        $this->solicitante_id='';
        $this->fechapresupuesto='';
        $this->precioventa='0';
        $this->preciocoste='0';
        $this->ratio='1';
        $this->unidades='0';
        $this->iva='0.21';
        $this->ruta='';
        $this->fichero='';
        $this->estado='0';
        $this->observaciones='';
    }

    public function store(){

        $this->validate([
            // 'presupuesto' => 'required',
            'entidad_id' => 'required',
            'solicitante_id' => 'required|numeric',
            'descripcion' => 'required',
            'fechapresupuesto' => 'required|date',
            'preciocoste' => 'nullable|numeric',
            'precioventa' => 'nullable|numeric',
            'estado' => 'required',
            'iva' => 'required',
            'ratio' => 'required',
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
            'solicitante_id'=>$this->solicitante_id,
            'fechapresupuesto'=>$this->fechapresupuesto,
            'precioventa'=>$this->precioventa,
            'preciocoste'=>$this->preciocoste,
            'ratio'=>$this->ratio,
            'unidades'=>$this->unidades,
            'iva'=>$this->iva,
            'ruta'=>$this->ruta,
            'fichero'=>$this->fichero,
            'estado'=>$this->estado,
            'observaciones'=>$this->observaciones,
        ]);
        session()->flash('message',
            $this->id ? 'Presupuesto actualizado satisfactoriamente.' : 'Presupuesto creado satisfactoriamente.');

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
        $this->solicitante_id=$presupuesto->solicitante_id;
        $this->fechapresupuesto=$presupuesto->fechapresupuesto;
        $this->preciocoste=$presupuesto->preciocoste;
        $this->precioventa=$presupuesto->precioventa;
        $this->ratio=$presupuesto->ratio;
        $this->unidades=$presupuesto->unidades;
        $this->iva=$presupuesto->iva;
        $this->ruta=$presupuesto->ruta;
        $this->fichero=$presupuesto->fichero;
        $this->estado=$presupuesto->estado;
        $this->observaciones=$presupuesto->observaciones;
        $this->openNewModal();
    }

    public function updatedEntidadId()
    {
        $e=Entidad::find($this->entidad_id);
        if($e){

            $this->ratio=$e->ratio ? $e->ratio : '1.00';
        }else{
            $this->ratio='1.00';
        }
    }

    public function numpresupuesto()
    {
        $anyo= substr($this->fechapresupuesto,0, 4);
        $anyo2= substr($this->fechapresupuesto,2, 2);
        $p=Presupuesto::whereYear('fechapresupuesto', $anyo)->max('presupuesto') ;
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
            ->when($this->filtroestado!='', function ($query){
                $query->where('estado',$this->filtroestado);
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
        $presupuesto = Pedido::find($presupuestoId);
        if ($presupuesto) {
            $presupuesto->delete();
            // session()->flash('message', $presupuesto->entidad.' eliminado!');
            $this->dispatchBrowserEvent('notify', 'La línea de pedido: '.$presupuesto->id.'-'.$presupuesto->presupuesto.' ha sido eliminada!');
        }
    }



}
