<div class="">
    @livewire('menu')

    <div class="h-full p-1 mx-2">

        <h1 class="text-2xl font-semibold text-gray-900">Movimientos Stock</h1>

        <div class="py-1 space-y-4">
            <x-jet-validation-errors></x-jet-validation-errors>
            <div class="flex justify-between">
                <div class="flex w-10/12 space-x-3">
                    @include('stock.stockfilters')
                </div>
                <div class="flex flex-row-reverse w-2/12">
                    <div class="pt-3">
                        <x-button.button  onclick="location.href = '{{ route('stock.create') }}'" color="blue"><x-icon.plus/>{{ __('Nueva E/S') }}</x-button.button>
                    </div>
                </div>

            </div>
            {{-- tabla movimientos --}}
            <div class="flex-col space-y-4">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading class="pl-1 text-left">{{ __('Fecha Mov.') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Proveedor') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Material') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Referencia') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Descripcion') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('E/S') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Cantidad') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Reentrada') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Rpble.Entrada') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Obs.') }}</x-table.heading>
                        <x-table.heading colspan="2"/>
                    </x-slot>

                    <x-slot name="body">
                        @forelse ($stocks as $stock)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->datemov}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->entidad->entidad}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->material->nombre}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->referencia}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->descripcion}}</td>
                                <td class="px-1 text-xs leading-5 text-{{ $stock->entrada }}-600 whitespace-no-wrap">{{ $stock->tipomovimiento}}</td>
                                <td class="px-1 text-xs leading-5 text-{{ $stock->entrada }}-600 whitespace-no-wrap text-right pr-3">{{ $stock->cantidad}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->reentrada}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->solicitante->nombre}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->observaciones}}</td>
                                <td  class="px-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        <x-icon.edit-a href="{{ route('stock.edit',$stock) }}"  title="Editar"/>
                                        <x-icon.delete-a wire:click.prevent="delete({{ $stock->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"/>
                                    </div>
                                </td >
                            </x-table.row>
                        @empty
                            <x-table.row>
                                <td  colspan="10">
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado movimientos...
                                        </span>
                                    </div>
                                </td >
                            </x-table.row>
                        @endforelse
                    </x-slot>
                </x-table>
                <div>
                    {{ $stocks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
