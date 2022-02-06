<div class="">
    @livewire('menu')
    <div class="p-1 mx-2">
        <h1 class="text-2xl font-semibold text-gray-900">Peticiones de Stock </h1>

        <div class="py-1 space-y-4">
            @if (session()->has('message'))
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-green-200 border-green-500 rounded border-1">
                    <span class="inline-block mx-8 align-middle">
                        {{ session('message') }}
                    </span>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            @endif

            <x-jet-validation-errors/>

            {{-- filtros y boton --}}
            <div>
                <div class="flex justify-between space-x-1">
                    <div class="inline-flex space-x-2">
                        <div class="text-xs">
                            <label class="px-1 text-gray-600">
                                Peticion
                            </label>
                            <div class="flex">
                                <input type="text" wire:model="filtropeticion" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Búsqueda" autofocus/>
                                @if($filtropeticion!='')
                                    <x-icon.filter-slash-a wire:click="$set('filtropeticion', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </div>
                        </div>
                        <div class="text-xs">
                            <label class="px-1 text-gray-600">
                                Solicitante
                            </label>
                            <div class="flex">
                                <select wire:model="filtrosolicitante" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" >
                                    <option value="">-- selecciona --</option>
                                    @foreach ($solicitantes as $solicitante )
                                    <option value="{{ $solicitante->id }}">{{ $solicitante->nombre ?? '-'}}</option>
                                    @endforeach
                                </select>
                                @if($filtrosolicitante!='')
                                    <x-icon.filter-slash-a wire:click="$set('filtrosolicitante', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </div>
                        </div>
                        <div class="text-xs">
                            <label class="px-1 text-gray-600">
                                Año
                            </label>
                            <div class="flex">
                                <input type="text" wire:model="filtroanyo" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Año"/>
                                @if($filtroanyo!='')
                                    <x-icon.filter-slash-a wire:click="$set('filtroanyo', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </div>
                        </div>
                        <div class="text-xs">
                            <label class="px-1 text-gray-600">
                                Mes
                            </label>
                            <div class="flex">
                                <input type="text" wire:model="filtromes" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Mes (número)"/>
                                @if($filtromes!='')
                                    <x-icon.filter-slash-a wire:click="$set('filtromes', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </div>
                        </div>
                        <div class="text-xs">
                            <label class="px-1 text-gray-600">
                                Estado
                            </label>
                            <select wire:model="filtroestado" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" >
                                <option value="0">Pendiente</option>
                                <option value="1">Curso</option>
                                <option value="2">Finalizado</option>
                                <option value="4">Todos</option>
                            </select>
                        </div>

                    </div>
                    <div class="inline-flex mt-3 space-x-2">
                        <div class="text-xs">
                            <x-button.button color="blue" onclick="location.href = '{{ route('stockpeticion.create') }}'">Nuevo</x-button.button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- tabla --}}

            <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="text-xs leading-4 tracking-wider text-gray-500 bg-blue-50 ">
                        <tr class="">
                            <th class="pl-4 font-medium text-left">{{ __('Petición') }}</th>
                            <th class="pl-4 font-medium text-left">{{ __('Solicitante') }} </th>
                            <th class="pl-4 font-medium text-left">{{ __('F.Solicitud') }}</th>
                            <th class="pl-4 font-medium text-left">{{ __('F.Realizado') }}</th>
                            <th class="pl-4 font-medium text-left">{{ __('Estado') }}</th>
                            <th class="pr-4 font-medium text-right">{{ __('Observaciones') }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-xs bg-white divide-y divide-gray-200">
                        @forelse ($stockpeticiones as $stockpeticion)
                            <tr wire:loading.class.delay="opacity-50" wire:key="fila-{{ $stockpeticion->id }}">
                                <td class="text-right">
                                    <input type="hidden" value="{{ $stockpeticion->id }}"/>
                                    <input type="text" value="{{ $stockpeticion->peticion }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td class="text-right">
                                    <input type="text" value="{{ $stockpeticion->solicitante->nombre ?? '-' }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td>
                                    <input type="text" value="{{ $stockpeticion->fechasolicitud->format('d/m/Y') }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td>
                                    <input type="text" value="{{ $stockpeticion->fecharealizado ? $stockpeticion->fecharealizado->format('d/m/Y') : '-' }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs leading-4 bg-{{ $stockpeticion->status_color[0] }}-100 text-green-800">
                                        {{ $stockpeticion->status_color[1] }}
                                    </span>
                                </td>
                                <td class="">
                                    <div class="flex items-center justify-center">
                                        @can('stockpeticion.edit')
                                            <x-icon.edit-a href="{{ route('stockpeticion.edit',$stockpeticion) }}" class="text-green-600" title="Editar Pedido"/>
                                        @endcan
                                        @can('stockpeticion.delete')
                                            <x-icon.delete-a wire:click.prevent="delete({{ $stockpeticion->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1 " title="Borrar"/>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado peticiones...
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $stockpeticiones->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
