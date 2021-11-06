<div class="items-center">
    <div class="flex flex-row items-center justify-between mx-2 my-0 mt-1">
        <div class="w-8/12 py-0 my-0">
            <div class="flex flex-row items-center ml-1 space-x-2">
                <div class="py-0 my-0">
                    <p class="text-xl font-semibold text-gray-900">Presupuesto: {{ $presuplinea->presupuesto->presupuesto ?? '-'}}</p>
                </div>
                <div class="">
                    <p class="text-xl font-semibold text-gray-900">Cliente: {{ $presuplinea->presupuesto->entidad->entidad ?? '-' }}</p>
                </div>
                <div class="">
                    <p class="text-sm font-semibold text-gray-900">Descripción: {{ $presuplinea->presupuesto->descripcion ?? '-'}}</p>
                </div>
            </div>
        </div>
        <div class="items-center w-4/12">
            <div class="flex flex-row items-center justify-between mr-6">
                <div class="">
                    <p class="text-sm font-semibold text-gray-900">€ Tarifa: {{ $presuplinea->presupuesto->preciotarifa ?? '-'}}</p>
                </div>
                <div class="">
                    <p class="text-sm font-semibold text-gray-900">Unidades: {{ $presuplinea->presupuesto->unidades ?? '-'}} </p>
                </div>
                <div class="">
                    <p class="text-sm font-semibold text-gray-900">€ Venta: {{ $presuplinea->presupuesto->precioventa ?? '-'}}</p>
                </div>
           </div>
        </div>
    </div>
</div>
