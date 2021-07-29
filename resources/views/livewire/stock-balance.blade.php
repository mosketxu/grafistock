<div class="">
    @livewire('menu')

    <div class="h-full p-1 mx-2">

        <h1 class="text-2xl font-semibold text-gray-900">Stock por {{ $titulo }}</h1>

        <div class="py-1 space-y-4">
            <x-jet-validation-errors></x-jet-validation-errors>
            <div class="flex justify-between">
                <div class="flex w-10/12 space-x-3">
                    <div class="w-2/12 text-xs">
                        <label class="px-1 text-gray-600">
                            Proveedor
                            @if($filtroproveedor!='')
                                <x-icon.filter-slash-a wire:click="$set('filtroproveedor', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtroproveedor" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->entidad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-2/12 text-xs">
                        <label class="px-1 text-gray-600">
                            Material
                            @if($filtromaterial!='')
                                <x-icon.filter-slash-a wire:click="$set('filtromaterial', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtromaterial" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($materiales as $material)
                            <option value="{{ $material->sigla }}">{{ $material->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($tipo=='producto_id')
                        <div class="w-2/12 text-xs">
                            <label class="px-1 text-gray-600">
                                Referencia
                                @if($filtroproducto!='')
                                    <x-icon.filter-slash-a wire:click="$set('filtroproducto', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </label>
                            <select wire:model="filtroproducto" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                <option value=""></option>
                                @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->referencia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-2/12 text-xs">
                            <label class="px-1 text-gray-600">
                                Descripción
                                @if($filtrodescripcion!='')
                                <x-icon.filter-slash-a wire:click="$set('filtrodescripcion', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </label>
                            <input type="text" wire:model="filtrodescripcion" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Búsqueda Entidad/Factura" autofocus/>
                        </div>
                    @endif
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Año
                            @if($filtroanyo!='')
                                <x-icon.filter-slash-a wire:click="$set('filtroanyo', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <input type="text" wire:model="filtroanyo" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Año"/>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Mes
                            @if($filtromes!='')
                                <x-icon.filter-slash-a wire:click="$set('filtromes', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <input type="text" wire:model="filtromes" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Mes (número)"/>
                    </div>


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
                        <x-table.heading class="pl-1 text-left">{{ __('Proveedor') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Material') }} </x-table.heading>
                        @if($tipo=='producto_id')
                            <x-table.heading class="pl-1 text-left">{{ __('Referencia') }} </x-table.heading>
                            <x-table.heading class="pl-1 text-left">{{ __('Descripcion') }} </x-table.heading>
                        @endif
                        <x-table.heading class="pl-1 text-right">{{ __('Cantidad') }}</x-table.heading>
                        <x-table.heading colspan="2"/>
                    </x-slot>

                    <x-slot name="body">
                        @forelse ($stocks as $stock)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->entidad->entidad}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->material->nombre}}</td>
                                @if($tipo=='producto_id')
                                    <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->referencia}}</td>
                                    <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->descripcion}}</td>
                                @endif
                                <td class="px-1 pr-3 text-xs leading-5 text-right text-gray-600 whitespace-no-wrap">{{ $stock->balance}}</td>
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

