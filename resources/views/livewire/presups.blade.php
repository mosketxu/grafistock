<div class="">
    @livewire('menu',['entidad'=>$entidad],key($entidad->id))
    <div class="p-1 mx-2">
        <h1 class="text-2xl font-semibold text-gray-900">Presupuesto {{ $entidad->id? 'de '. $entidad->entidad :'' }}
        </h1>
        <div class="py-1 space-y-4">
            @include('error')
        </div>
        {{-- filtros y boton --}}
        <div>
            <div class="flex justify-between space-x-1">
                <div class="inline-flex space-x-2">
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Presupuesto
                            @if($search!='')
                            <x-icon.filter-slash-a wire:click="$set('search', '')" class="pb-1" title="reset filter" />
                            @endif
                        </label>
                        <input type="text" wire:model="search"
                            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                            placeholder="Búsqueda" autofocus />
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Cliente
                            @if($filtroclipro!='')
                            <x-icon.filter-slash-a wire:click="$set('filtroclipro', '')" class="pb-1"
                                title="reset filter" />
                            @endif
                        </label>
                        <select wire:model="filtroclipro"
                            class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value="">-- selecciona --</option>
                            @foreach ($clientes as $cliente )
                            <option value="{{ $cliente->id }}">{{ $cliente->entidad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Año
                            @if($filtroanyo!='')
                            <x-icon.filter-slash-a wire:click="$set('filtroanyo', '')" class="pb-1"
                                title="reset filter" />
                            @endif
                        </label>
                        <input type="text" wire:model="filtroanyo"
                            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                            placeholder="Año" />
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Mes
                            @if($filtromes!='')
                            <x-icon.filter-slash-a wire:click="$set('filtromes', '')" class="pb-1"
                                title="reset filter" />
                            @endif
                        </label>
                        <input type="text" wire:model="filtromes"
                            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                            placeholder="Mes (número)" />
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Estado
                            @if($filtroestado!='')
                            <x-icon.filter-slash-a wire:click="$set('filtroestado', '')" class="pb-1"
                                title="reset filter" />
                            @endif
                        </label>
                        <select wire:model="filtroestado"
                            class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value="">-- selecciona --</option>
                            <option value="0">En curso</option>
                            <option value="1">Aceptado</option>
                            <option value="2">Rechazado</option>
                        </select>
                    </div>
                </div>
                {{-- Parte derecha --}}
                <div class="inline-flex mt-3 space-x-2">
                    <x-dropdown label="Actions">
                        <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                            <x-icon.csv class="text-green-400"></x-icon.csv><span>Export </span>
                        </x-dropdown.item>
                        <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')"
                            class="flex items-center space-x-2">
                            <x-icon.trash class="text-red-400"></x-icon.trash> <span>Delete </span>
                        </x-dropdown.item>
                    </x-dropdown>

                    <div class="text-xs">
                        <x-button.button wire:click="create()" color="blue">Nuevo</x-button.button>
                    </div>
                    @if($showNewModal)
                        @include('livewire.presupuestocreate')
                    @endif
                </div>
            </div>
        </div>
        {{-- tabla presupuestos --}}
        <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="text-xs leading-4 tracking-wider text-gray-500 bg-blue-50 ">
                    <tr class="">
                        <th class="w-5 py-3 pl-2 font-medium text-center">
                            <x-input.checkbox wire:model="selectPage" />
                        </th>
                        <th class="w-5 py-3 pl-2 font-medium text-center ">#</th>
                        <th class="pl-4 font-medium text-left">{{ __('Presupuesto') }}</th>
                        <th class="pl-4 font-medium text-left">{{ __('Cliente') }} </th>
                        <th class="pr-4 font-medium text-right">{{ __('F.Presupuesto') }}</th>
                        <th class="pl-4 font-medium text-left">{{ __('Solicitante') }} </th>
                        <th class="pl-4 font-medium text-left">{{ __('Descripción') }} </th>
                        <th class="pr-4 font-medium text-right">{{ __('Unidades') }}</th>
                        <th class="pr-4 font-medium text-right">{{ __('€ Tarifa') }}</th>
                        {{-- <th class="pl-4 font-medium text-left">{{ __('Ratio') }} </th> --}}
                        <th class="pr-4 font-medium text-right">{{ __('€ Venta') }}</th>
                        <th class="pr-4 font-medium text-center">{{ __('Estado') }}</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody class="text-xs bg-white divide-y divide-gray-200">
                    @if($selectPage)
                        <tr class="bg-gray-200" wire:key="row-message">
                            <td class="py-3 pl-2 font-medium" colspan="18">
                                @unless($selectAll)
                                    <span>Has seleccionado <strong>{{ $presupuestos->count() }}</strong> presupuestos, ¿quieres seleccionar el total: <strong>{{ $presupuestos->total() }}</strong> ?</span>
                                    <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select all</x-button.link>
                                @else
                                    <span>Has seleccionado <strong>todas</strong> las {{ $presupuestos->total() }} presupuestos</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                    @forelse ($presupuestos as $presupuesto)
                        <tr wire:loading.class.delay="opacity-50" wire:key="fila-{{ $presupuesto->id }}">
                            <td class="w-5 py-3 pl-2 font-medium text-center">
                                <x-input.checkbox wire:model="selected" value="{{ $presupuesto->id }}" />
                            </td>
                            <td class="text-right">
                                <a href="#" wire:click="edit"
                                    class="text-xs text-gray-200 transition duration-150 ease-in-out hover:outline-none hover:text-gray-800 hover:underline">
                                    {{ $presupuesto->id }}
                                </a>
                            </td>
                            <td class="text-right">
                                @if($presupuesto->presupuesto)
                                <input type="text" value="{{ $presupuesto->presupuesto }}"
                                    class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md" readonly />
                                @endif
                            </td>
                            <td>
                                <input type="text" value="{{ $presupuesto->entidad }}"
                                    class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md" readonly />
                            </td>
                            <td>
                                <input type="text" value="{{ $presupuesto->fechapresu }}"
                                    class="w-full text-xs font-thin text-right text-gray-500 truncate border-0 rounded-md"
                                    readonly />
                            </td>
                            <td>
                                <input type="text" value="{{ $presupuesto->solicitante->name ?? '-' }}"
                                    class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md" readonly />
                            </td>
                            <td>
                                <input type="text" value="{{ $presupuesto->descripcion }}"
                                    class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md" readonly />
                            </td>
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ $presupuesto->unidades}}</span>
                            </td>
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ $presupuesto->preciotarifa}}</span>
                            </td>
                            {{-- <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ $presupuesto->ratio}}</span>
                            </td> --}}
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ $presupuesto->precioventa}}</span>
                            </td>
                            <td>
                                <span
                                    class="inline-flex items-center text-center px-2.5 py-0.5 rounded-full text-xs leading-4 bg-{{ $presupuesto->status_color[0] }}-100 text-green-800">
                                    {{ $presupuesto->status_color[1] }}
                                </span>
                            </td>
                            <td class="">
                                <div class="flex items-center justify-center">
                                    @if(Auth::user()->id==$presupuesto->solicitante_id || Auth::user()->hasRole('Admin'))
                                    <x-icon.edit-a wire:click="edit({{ $presupuesto->id }})" class="text-green-600"
                                        title="Editar Presupuesto" />
                                    <x-icon.clipboard-a href="{{route('presupuesto.edit', $presupuesto) }}"
                                        class="text-green-600" title="Composición Presupuesto" />
                                    <x-icon.delete-a wire:click.prevent="delete({{ $presupuesto->id }})"
                                        onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()"
                                        class="pl-1 " title="Borrar" />
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <div class="flex items-center justify-center">
                                    <x-icon.inbox class="w-8 h-8 text-gray-300" />
                                    <span class="py-5 text-xl font-medium text-gray-500">
                                        No se han encontrado presupuestos...
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="font-bold divide-y divide-gray-200">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="pt-2 text-sm text-right text-gray-600">Totales:</td>
                        <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">{{
                            number_format(round($totalcoste,2),2) }}</td>
                        <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">{{
                            number_format(round($totalventa,2),2) }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
            <div>
                {{ $presupuestos->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Transactions Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Borrar Presupuesto</x-slot>

            <x-slot name="content">
                <div class="py-8 text-gray-700">¿Esás seguro? Esta acción es irreversible.</div>
            </x-slot>

            <x-slot name="footer">
                <x-button.secondary wire:click="$set('showDeleteModal', false)">Cancel</x-button.secondary>

                <x-button.primary type="submit">Delete</x-button.primary>
            </x-slot>
        </x-modal.confirmation>
    </form>
</div>
