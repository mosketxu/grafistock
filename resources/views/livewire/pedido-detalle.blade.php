<div class="p-1 mx-2">

    <div class="py-1 space-y-2">
        {{-- @if (session()->has('message'))
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                <span class="inline-block mx-8 align-middle">
                    {{ session('message') }}
                </span>
                <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                    <span>×</span>
                </button>
            </div>
        @endif --}}
        <div class="bg-yellow-100 rounded-md">
            <h3 class="ml-2 font-semibold ">Detalle Pedido</h3>
        </div>
        {{-- tabla detalles --}}
        <div class="flex-col">
            <table table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-left text-gray-500 bg-yellow-50 ">{{ __('Orden') }}</th>
                        <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-left text-gray-500 bg-yellow-50">{{ __('Producto') }} </th>
                        <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-left text-gray-500 bg-yellow-50">{{ __('Descripción') }} </th>
                        <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Uds.') }}</th>
                        <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Coste') }}</th>
                        <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Ud.Compra') }}</th>
                        <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Total (€)') }}</th>
                        <th colspan="2" class="py-3 text-xs font-medium leading-4 tracking-tighter text-center text-gray-500 bg-yellow-50"> </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($detalles as $detalle)
                        <x-table.row wire:loading.class.delay="opacity-50">
                            <x-table.cell class="text-left">{{ $detalle->orden }}</x-table.cell>
                            <x-table.cell class="tracking-tighter text-left">{{ $detalle->producto->referencia }}</x-table.cell>
                            <x-table.cell class="tracking-tighter text-left">{{ $detalle->producto->descripcion }}</x-table.cell>
                            <x-table.cell class="text-right">{{ $detalle->cantidad }}</x-table.cell>
                            <x-table.cell class="text-right">{{ $detalle->coste }}</x-table.cell>
                            <x-table.cell class="text-right">{{ $detalle->unidadcompra->nombre ?? '-' }}</x-table.cell>
                            <x-table.cell class="text-right">
                                @if(is_numeric($detalle->cantidad) && is_numeric($detalle->coste))
                                    {{ number_format(round($detalle->cantidad*$detalle->coste, 2),2,',','.') }}
                                @endif
                            </x-table.cell>
                            <x-table.cell class="text-right">
                                {{-- <x-icon.save-a wire:click.prevent="saveDetalle({{$index}})" title="Actualizar"/> --}}
                                <x-icon.edit-a wire:click.prevent="editDetalle({{$detalle}})" title="Editar"/>
                                <x-icon.delete-a wire:click.prevent="delete({{ $detalle->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"  title="Eliminar detalle"/>
                            </x-table.cell>
                        </x-table.row>
                    @empty
                        <x-table.row>
                            <x-table.cell colspan="10">
                                    <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                    <span class="py-5 text-xl font-medium text-gray-500">
                                        No se han encontrado detalles...
                                    </span>
                                </div>
                            </x-table.cell>
                        </x-table.row>
                    @endforelse
                </tbody>
                <tfoot class="font-bold divide-y divide-gray-200">
                    <tr>
                        <td class="pl-2"></td>
                        <td class="pl-2"></td>
                        <td class="pl-2 "></td>
                        <td class="pr-2"></td>
                        <td class="pr-2"></td>
                        <td class="pl-2 text-right">Total</td>
                        <td class="text-right">{{ number_format($total,2,',','.') }}</td>
                        <td colspan="2" class="w-1/12"></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @if($showcrear)
            @livewire('pedido-detalle-create',['pedido'=>$pedido],key($pedido->id))
        @endif
    </div>
</div>
