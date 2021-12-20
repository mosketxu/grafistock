<div class="">
    <div class="flex flex-row items-center justify-between p-1 mx-2 my-0">
        <div class="w-8/12 py-0 my-0">
            <p class="text-lg font-semibold text-gray-900">Descripción: {{ $presuplinea->descripcion}}</p>
        </div>
        <div class="w-4/12">
            <div class="flex flex-row justify-between mr-3">
                <div class="">
                    <p class="font-semibold text-right text-gray-900 text-md">€ Compra: {{ $presuplinea->preciocoste }}</p>
                </div>
                <div class="">
                    <p class="font-semibold text-right text-gray-900 text-md">Unidades: {{ $presuplinea->unidades }}</p>
                </div>
                <div class="">
                    <p class="font-semibold text-right text-gray-900 text-md">€ Venta: {{ $presuplinea->precioventa}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
