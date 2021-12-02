<div class="w-full px-2 mb-4 md:w-1/3 lg:w-2/4">
    <div class="relative bg-white border rounded">
        <div class="p-4 ">
            <div class="flex justify-between">
                <div class="flex space-x-2">
                    <div>
                        <h3 class="text-lg font-bold">Acciones</h3>
                    </div>
                    <div class="text-xs">
                        <div class="flex">
                            <label class="px-1 text-gray-600">
                                Referencia/ Descripción
                                @if($search!='')
                                <x-icon.filter-slash-a wire:click="$set('search', '')" class="pb-1" title="reset filter" />
                                @endif
                            </label>
                            <input type="text" wire:model="search"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                placeholder="Búsqueda" autofocus />
                        </div>
                    </div>
                    <div class="text-xs">
                        <div class="flex">
                            <label class="px-1 text-gray-600">
                                Tipo Acción
                                @if($acciontipofiltro!='')
                                    <x-icon.filter-slash-a wire:click="$set('acciontipofiltro', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </label>
                            <select wire:model="acciontipofiltro" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                <option value=""></option>
                                @foreach ($acciontipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {{-- Parte derecha --}}
                <div class="">
                    @can('accion.edit')
                        <div class="text-xs">
                            <x-button.button wire:click="create()" color="blue">Nuevo</x-button.button>
                        </div>
                        @if($showNewModal)
                            @include('livewire.accioncreate')
                        @endif
                    @endcan
                </div>
            </div>
            <div class="py-1 space-y-1">
                @include('error')
            </div>

            {{-- @if ($errors->any())
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
            @endif --}}

            <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-t-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-2 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" >Referencia</th>
                            <th class="px-2 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" >Descripcion</th>
                            <th class="px-2 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" >Tipo</th>
                            <th class="px-2 py-2 text-xs font-medium leading-4 tracking-wider text-right text-gray-500 bg-blue-50" >€ Tarifa</th>
                            <th class="px-2 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" >Ud.</th>
                            {{-- <th class="px-2 py-2 text-xs font-medium leading-4 tracking-wider text-right text-gray-500 bg-blue-50" >€ Venta</th> --}}
                            <th class="px-2 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" >Observaciones</th>
                            <th class="px-2 py-2 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 bg-blue-50" ></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 ">
                        @foreach ($acciones as $accion)
                            <tr wire:loading.class.delay="opacity-50">
                                <td class="px-3 py-1 text-xs leading-5 tracking-tighter text-left text-gray-600 whitespace-no-wrap background-blue" >
                                    {{ $accion->referencia }}
                                </td>
                                <td class="px-3 py-1 text-xs leading-5 tracking-tighter text-left text-gray-600 whitespace-no-wrap">
                                    {{ $accion->descripcion }}
                                </td>
                                <td class="px-3 py-1 text-xs leading-5 tracking-tighter text-left text-gray-600 whitespace-no-wrap">
                                    {{ $accion->acciontipo->nombre }}
                                </td>
                                <td class="px-3 py-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">
                                    {{ $accion->preciotarifa }}
                                </td>
                                <td class="px-3 py-1 text-xs leading-5 tracking-tighter text-left text-gray-600 whitespace-no-wrap text">
                                    {{ $accion->unidad->nombre }}
                                </td>
                                {{-- <td class="px-3 py-1 text-xs leading-5 tracking-tighter text-right text-gray-600 whitespace-no-wrap">
                                    {{ $accion->precioventa }}
                                </td> --}}
                                <td class="px-3 py-1 text-xs leading-5 tracking-tighter text-left text-gray-600 whitespace-no-wrap">
                                    {{ $accion->observaciones }}
                                </td>
                                <td class="">
                                    <div class="flex items-center justify-center">
                                        <x-icon.edit-a wire:click="edit({{ $accion->id }})" class="text-green-600"
                                            title="Editar Acción" />
                                        <x-icon.delete-a wire:click.prevent="delete({{ $accion->id }})"
                                            onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()"
                                            class="pl-1 " title="Borrar" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $acciones->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
