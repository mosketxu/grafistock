<div class="w-full px-2 mb-4 sm:w-1/2 md:w-1/3">
    <div class="relative bg-white border rounded">
        <div class="p-4 space-y-4">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-bold">{{ $titulo }}</h3>
                </div>
                <div>
                    <input type="text" wire:model="search" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Búsqueda" autofocus/>
                </div>
            </div>
            @if ($errors->any())
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                    <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            @endif
                <x-table>
                    <x-slot name="head">
                        <x-table.heading class="pl-3 text-left" width="75%" >{{ __('Metodo Pago') }}</x-table.heading>
                        <x-table.heading class="pl-3 text-left" width="25%">{{ __('M.P.Corto') }} </x-table.heading>
                        <x-table.heading colspan="2"/>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($metodopagos as $valor)
                        <x-table.row wire:loading.class.delay="opacity-50">
                            <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap" >
                                <input type="text" value="{{ $valor->nombre }}"
                                wire:change="changeMetodo({{ $valor }},$event.target.value)"
                                class="w-full text-xs font-thin text-gray-500 border-0 rounded-md"/>
                            </td>
                            <td class="px-1 text-xs leading-5 tracking-tighter text-gray-600 whitespace-no-wrap">
                                <input type="text" value="{{ $valor->nombrecorto }}"
                                wire:change="changeCorto({{ $valor }},$event.target.value)"
                                class="w-full text-xs font-thin text-gray-500 border-0 rounded-md"/>
                            </td>
                            <td  class="px-4">
                                <div class="flex items-center justify-center space-x-3">
                                    <x-icon.delete-a wire:click.prevent="delete({{ $valor->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"  title="Eliminar detalle"/>
                                </div>
                            </td >
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div>
                    {{ $metodopagos->links() }}
                </div>

        </div>
    </div>
</div>
