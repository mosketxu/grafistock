<div class="items-center">
    <div class="flex flex-row items-center justify-between mx-2 my-0 mt-1">
        <div class="w-8/12 py-0 my-0">
            <div class="flex flex-row items-baseline ml-1 space-x-2">
                <div class="py-0 my-0">
                    <p class="text-xl font-semibold text-gray-900">Presupuesto: <span class="font-light"> {{ $presuplinea->presupuesto->presupuesto ?? '-'}} </span></p>
                </div>
                <div class="">
                    <p class="text-xl font-semibold text-gray-900">Cliente: <span class="font-light">{{ $presuplinea->presupuesto->entidad->entidad ?? '-' }} </span></p>
                </div>
                <div class="">
                    <p class="text-sm font-semibold text-gray-900">Descripción: <span class="font-light">{{ $presuplinea->presupuesto->descripcion ?? '-'}} </span></p>
                </div>
            </div>
        </div>
        <div class="items-center w-4/12">
            <div class="flex flex-row items-baseline justify-between mr-6">
                <div class="">
                    <p class="text-sm font-semibold text-gray-900">€ Tarifa: {{ $presuplinea->presupuesto->preciotarifa ?? '-'}}</p>
                </div>
                <div class="">
                    <p class="text-sm font-semibold text-gray-900">Unidades: {{ $presuplinea->presupuesto->unidades ?? '-'}} </p>
                </div>
                <div class="">
                    <p class="text-sm font-semibold text-gray-900">€ Venta: {{ $presuplinea->presupuesto->precioventa ?? '-'}}</p>
                </div>
                <div class="flex">
                    <a href="{{ route('presupuesto.show',$presuplinea->presupuesto) }}" target="_blank" class="w-6 h-6 ml-2 text" title="Imprimir Presupuesto"><x-icon.printer></x-icon.printer></a>
                    <a href="{{ route('presupuesto.imprimir',$presuplinea->presupuesto) }}" target="_blank" class="w-6 h-6 text" title="Imprimir Ficha Presupuesto"><x-icon.pdfred ></x-icon.pdfred></a>
                </div>
            </div>
        </div>
    </div>
</div>
