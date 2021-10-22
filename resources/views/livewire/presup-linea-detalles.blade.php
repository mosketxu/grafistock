<div class="">
    @livewire('menu')
    <div class="">
        @include('presupuestolinea.presupuestocabecera')
        <div class="py-1 space-y-4">
            @include('errormessages')
        </div>

        {{-- @livewire('presup-conceptos',['presuplinea'=>$presuplinea],key($presuplinea->id)) --}}

        <div class="mx-2 border rounded">
            @include('presupuestolinea.presupuestolineacabecera')
            {{-- <div class="">
                <div class="flex flex-row items-center justify-between p-1 mx-2 my-0">
                    <div class="w-8/12 py-0 my-0">
                        <p class="text-xl font-semibold text-gray-900">Descripción línea: {{ $presuplinea->descripcion}}</p>
                    </div>
                    <div class="w-2/12">
                        <p class="text-lg font-semibold text-right text-gray-900">€ Coste: {{ $presuplinea->preciocoste }}</p>
                    </div>
                    <div class="w-2/12">
                        <p class="text-lg font-semibold text-right text-gray-900">€ Venta: {{ $presuplinea->precioventa}}</p>
                    </div>
                </div>
            </div> --}}
            <div class="space-y-2 ">
                @include('presupuestolinea.acciones',['presupacciones' => $presupproductos,'acciontipoId'=>'1','accion'=>'Material'])
                @include('presupuestolinea.acciones', ['presupacciones' => $presupimpresion,'acciontipoId'=>'2','accion'=>'Impresión'])
                @include('presupuestolinea.acciones', ['presupacciones' => $presupacabados,'acciontipoId'=>'3','accion'=>'Acabados'])
                @include('presupuestolinea.acciones', ['presupacciones' => $presupmanipulados,'acciontipoId'=>'4','accion'=>'Manipulados'])
                @include('presupuestolinea.acciones', ['presupacciones' => $presupembalajes,'acciontipoId'=>'5','accion'=>'Embalajes'])
                @include('presupuestolinea.acciones', ['presupacciones' => $presuptransportes,'acciontipoId'=>'6','accion'=>'Trasnportes'])
                @include('presupuestolinea.acciones', ['presupacciones' => $presupexternos,'acciontipoId'=>'7','accion'=>'Externos'])
            </div>
        </div>

        <div class="flex my-2 ml-2 space-x-4">
            <div class="space-x-3">
                <x-jet-secondary-button
                    onclick="location.href = '{{route('presupuesto.edit',$presuplinea->presupuesto->id)}}'">{{
                    __('Volver') }}</x-jet-secondary-button>
            </div>
        </div>
    </div>
</div>
