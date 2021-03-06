<div class="flex-col">
    <div class="bg-yellow-100 rounded-md">
        <h3 class="ml-2 font-semibold ">Composición Presupuesto</h3>
    </div>

    {{-- Lineas del prespuesot --}}

    @include('error')

    <table table class="min-w-full ">
        <thead>
            <tr>
                <x-table.headyellow class="pl-3 text-center">{{ __('Visible') }}</x-table.headyellow>
                <x-table.headyellow class="w-1/12 pl-3">{{ __('Orden') }}</x-table.headyellow>
                <x-table.headyellow class="w-3/12 pl-3 ">{{ __('Descripción') }} </x-table.headyellow>
                <x-table.headyellow class="w-1/12 pr-3 text-right ">{{ __('€ Compra') }}</x-table.headyellow>
                <x-table.headyellow class="w-1/12 pr-3 text-right ">{{ __('€ Venta') }}</x-table.headyellow>
                <x-table.headyellow class="w-1/12 pr-3 text-right ">{{ __('Unidades') }}</x-table.headyellow>
                <x-table.headyellow class="w-4/12 pl-3 ">{{ __('Observaciones') }} </x-table.headyellow>
                <x-table.headyellow colspan="3" class=""/>
            </tr>
        </thead>
        <tbody>
            @forelse ($presupuesto->presupuestolineas as $linea)
                <tr class="py-0 my-0">
                    <td><input type="checkbox" value="{{ $linea->visible }}" {{ $linea->visible==true ? 'checked' : ''  }} wire:change="changeVisible({{ $linea }},$event.target.value)"
                        class="ml-4 text-xs border-gray-300 rounded-sm shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                    <td><input type="text" value="{{ $linea->orden }}" wire:change="changeOrden({{ $linea }},$event.target.value)"
                        class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                    <td><input type="text" value="{{ $linea->descripcion }}" wire:change="changeDescripcion({{ $linea }},$event.target.value)"
                        class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                    <td><input type="text" value="{{ $linea->preciocoste }}"
                        class="w-full text-xs tracking-tighter text-right border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled/></td>
                    <td><input type="text" value="{{ $linea->precioventa }}"
                        class="w-full text-xs tracking-tighter text-right border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled/></td>
                    <td><input type="text" value="{{ $linea->unidades }}" wire:change="changeUnidades({{ $linea }},$event.target.value)"
                        class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                    <td><input type="text" value="{{ $linea->observaciones }}" wire:change="changeObs({{ $linea }},$event.target.value)"
                        class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/></td>
                    <td>
                        <div class="flex items-center justify-center">
                            <x-icon.calc-a href="{{route('presupuestolinea.index', $linea) }}" class="ml-2 text-green-600" title="Editar Cálculo"/>
                            <x-icon.copy-a wire:click="replicateRow({{ $linea }})" onclick="confirm('¿Estás seguro de querer copiar la linea?') || event.stopImmediatePropagation()" class="text-purple-500" title="Copiar Presupuesto" />
                            <x-icon.delete-a wire:click.prevent="delete({{ $linea->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"  title="Eliminar linea"/>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">
                            <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                            <span class="py-5 text-xl font-medium text-gray-500">
                                No se han encontrado lineas...
                            </span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>


    @livewire('presup-linea-create',['presupuestoId'=>$presupuesto->id])

    <div class="mb-2"></div>
    <hr>
</div>
