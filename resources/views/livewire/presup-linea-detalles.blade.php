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
            <div class="space-y-2 ">
                @foreach($acciontipos as $actipo)
                    @include('presupuestolinea.presupuestolineadetalles',['presupacciones' => $presuplineadetalles->where('acciontipo_id',$actipo->id),'acciontipo'=>$actipo])
                @endforeach
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
