<div class="flex-col">
    <div class="bg-yellow-100 rounded-md">
        <div class="inline-flex space-x-3">
        <h3 class="ml-2 font-semibold ">Composición Presupuesto</h3>
        <x-dropdownmin class="py-0 mx-2" label="Actions">
            {{-- <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                <x-icon.csv class="text-green-400"></x-icon.csv><span>Export </span>
            </x-dropdown.item> --}}
            <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')"
                class="flex items-center space-x-2">
                <x-icon.trash class="text-red-400"></x-icon.trash> <span>Borrar seleccionados</span>
            </x-dropdown.item>
        </x-dropdownmin>
    </div>

    </div>

    {{-- Lineas del prespuesot --}}

    @include('error')

    <table table class="min-w-full ">
        <thead>
            <tr>
                <x-table.headyellow class="pl-3 text-center">{{ __('Sel.') }}</x-table.headyellow>
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
            {{-- @forelse ($presupuesto->presupuestolineas as $linea) --}}
            @forelse ($lineas as $linea)

            <tr wire:loading.class.delay="opacity-50" wire:key="fila-{{ $presupuesto->id }}">
                <tr class="py-0 my-0" wire:key="fila-{{ $linea->id }}">
                    <td class="w-5 py-3 pl-2 font-medium text-center">
                        <x-input.checkbox wire:model="selected" value="{{ $linea->id }}" /></td>

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
                            @if($presupuesto->pminimo->count()==0)
                                <x-icon.p-a wire:click="pedidominimo({{ $linea }} )" class="ml-2 text-gray-600 cursor-pointer" title="Pedido Mínimo"/>
                            @endif
                            @if($linea->pminimo->count()>0)
                                <x-icon.p-a class="ml-2 text-green-600" title="Pedido Mínimo"/>
                            @endif
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

    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Borrar Líneas</x-slot>

            <x-slot name="content">
                <div class="py-8 text-gray-700">¿Estás seguro? <br>Se eliminarán las líneas de detalle. <br>Esta acción es irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$toggle('showDeleteModal')">Cancelar</x-button.secondary>

                <x-button.primary type="submit">Borrar</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>
</div>
