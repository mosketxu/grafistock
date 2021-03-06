<div class="">
    @livewire('menu')

    <div class="h-full p-1 mx-2">

        <h1 class="text-2xl font-semibold text-gray-900">Stock</h1>

        <div class="py-1 space-y-4">
            @if (session()->has('message'))
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                    <span class="inline-block mx-8 align-middle">
                        {{ session('message') }}
                    </span>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            @endif
            <x-jet-validation-errors></x-jet-validation-errors>
            <div class="flex justify-between">
                <div class="flex w-10/12 space-x-3">
                    <div class="w-2/12 text-xs">
                        <label class="px-1 text-gray-600">Referencia</label>
                        <select wire:model="filtroproducto" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->referencia }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-2/12 text-xs">
                        <label class="px-1 text-gray-600">Proveedor</label>
                        <select wire:model="filtroclipro" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->entidad }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-row-reverse w-2/12">
                    <div class="pt-3">
                        {{-- <x-button.button  onclick="location.href = '{{ route('stock.create') }}'" color="blue"><x-icon.plus/>{{ __('Nueva E/S') }}</x-button.button> --}}
                    </div>
                </div>

            </div>
            {{-- tabla movimientos --}}
            <div class="flex-col space-y-4">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading class="pl-1 text-left">{{ __('Producto') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Descripcion') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-left">{{ __('Proveedor') }} </x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Cantidad') }}</x-table.heading>
                        <x-table.heading class="pl-1 text-right">{{ __('Detalle') }}</x-table.heading>
                        <x-table.heading colspan="2"/>
                    </x-slot>

                    <x-slot name="body">
                        @forelse ($stocks as $stock)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->referencia}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->descripcion}}</td>
                                <td class="px-1 text-xs leading-5 text-gray-600 whitespace-no-wrap">{{ $stock->producto->entidad->entidad}}</td>
                                <td class="px-1 text-xs leading-5 text-{{ $stock->total<0 ? 'red' : 'green' }}-600 whitespace-no-wrap text-right pr-3">{{ $stock->total}}</td>
                                <td class="px-1 text-xs text-right"><x-icon.eye-a href="{{route('stock.show',$stock->producto->id) }}" class="pt-2 ml-2" title="detalle"/></td>
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
