<div class="">
    @livewire('menu',['entidad'=>$entidad],key($entidad->id))
    <div class="p-1 mx-2">
        <h1 class="text-2xl font-semibold text-gray-900">Presupuestos
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
                        </label>
                        <div class="flex">
                            <input type="text" wire:model.lazy="search"
                            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                            placeholder="Búsqueda" autofocus />
                            @if($search!='')
                                <x-icon.filter-slash-a wire:click="$set('search', '')" class="pb-1" title="reset filter" />
                            @endif
                        </div>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Cliente
                        </label>
                        <div class="flex">
                            <select wire:model="filtroclipro"
                                class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                <option value="">-- selecciona --</option>
                                @foreach ($clientes as $cliente )
                                <option value="{{ $cliente->id }}">{{ $cliente->entidad }}</option>
                                @endforeach
                            </select>
                            @if($filtroclipro!='')
                                <x-icon.filter-slash-a wire:click="$set('filtroclipro', '')" class="pb-1" title="reset filter" />
                            @endif
                       </div>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Palabra clave
                        </label>
                        <div class="flex">
                            <input type="text" wire:model.lazy="filtropalabra"
                            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                            placeholder="palabra clave" autofocus />
                            @if($filtropalabra!='')
                                <x-icon.filter-slash-a wire:click="$set('filtropalabra', '')" class="pb-1" title="reset filter" />
                            @endif
                        </div>
                    </div>
                    @if(Auth::user()->hasRole('Admin'))
                        <div class="text-xs">
                            <label class="px-1 text-gray-600">
                                Comercial
                            </label>
                            <div class="flex">
                                <select wire:model="filtrosolicitante"
                                    class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                    <option value="">-- selecciona --</option>
                                    @foreach ($solicitantes as $solicitante )
                                    <option value="{{ $solicitante->id }}">{{ $solicitante->name }}</option>
                                    @endforeach
                                </select>
                                @if($filtrosolicitante!='')
                                    <x-icon.filter-slash-a wire:click="$set('filtrosolicitante', '')" class="pb-1" title="reset filter" />
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Año
                        </label>
                        <div class="flex">
                            <input type="text" wire:model="filtroanyo"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                placeholder="Año" />
                            @if($filtroanyo!='')
                            <x-icon.filter-slash-a wire:click="$set('filtroanyo', '')" class="pb-1" title="reset filter" />
                            @endif
                        </div>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Mes
                        </label>
                        <div class="flex">
                            <input type="text" wire:model="filtromes"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                placeholder="Mes (número)" />
                            @if($filtromes!='')
                            <x-icon.filter-slash-a wire:click="$set('filtromes', '')" class="pb-1" title="reset filter" />
                            @endif
                        </div>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Estado
                        </label>
                        <div class="flex">
                            <select wire:model="filtroestado"
                                class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                <option value="">-- selecciona --</option>
                                <option value="0">En curso</option>
                                <option value="1">Aceptado</option>
                                <option value="2">Rechazado</option>
                            </select>
                            @if($filtroestado!='')
                                <x-icon.filter-slash-a wire:click="$set('filtroestado', '')" class="pb-1" title="reset filter" />
                            @endif
                        </div>
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
                        <th class="pr-4 font-medium text-right">{{ __('€ Coste') }}</th>
                        <th class="pr-4 font-medium text-right">{{ __('% Inc') }}</th>
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
                                <span class="pr-4 text-xs text-blue-500">{{ number_format($presupuesto->unidades,2)}}</span>
                            </td>
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ $presupuesto->preciocoste}}</span>
                            </td>
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ number_format($presupuesto->incremento,2)}} %</span>
                            </td>
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ number_format($presupuesto->precioventa,2)}}</span>
                            </td>
                            <td>
                                <span
                                    class="inline-flex items-center text-center px-2.5 py-0.5 rounded-full text-xs leading-4 bg-{{ $presupuesto->status_color[0] }}-100 text-green-800">
                                    {{ $presupuesto->status_color[1] }}
                                </span>
                            </td>
                            <td class="">
                                <div class="flex items-center justify-center">
                                    @if(Auth::user()->id==$presupuesto->ent->comercial_id || Auth::user()->hasRole('Admin'))
                                        <x-icon.edit-a wire:click="edit({{ $presupuesto->id }})" class="text-green-600" title="Editar Presupuesto" />
                                        <x-icon.calc-a
                                            href="{{route('presupuesto.composicion', [
                                                $presupuesto,
                                                $search ? $search : '@_' ,
                                                $filtroanyo ? $filtroanyo : '@_',
                                                $filtromes ? $filtromes : '@_',
                                                $filtroclipro ? $filtroclipro : '@_',
                                                $filtrosolicitante ? $filtrosolicitante : '@_',
                                                $filtropalabra ? $filtropalabra : '@_',
                                                $filtroestado ? $filtroestado : '@_']) }}"
                                            class="text-green-600" title="Composición Presupuesto" />
                                        <x-icon.copy-a wire:click="replicateRow({{ $presupuesto }})" onclick="confirm('¿Estás seguro de querer copiar el presupuesto?') || event.stopImmediatePropagation()" class="text-purple-500" title="Copiar Presupuesto" />
                                        <x-icon.delete-a wire:click.prevent="delete({{ $presupuesto->id }})" onclick="confirm('¿Estás seguro de querer eliminar el presupuesto?') || event.stopImmediatePropagation()" class="pl-1 " title="Borrar" />
                                    @endif
                                    {{-- <a href="{{ route('presupuesto.imprimir',[$presupuesto,'con']) }}" target="_blank" class="w-6 h-6 ml-2 text" title="Imprimir Presupuesto"><x-icon.pdfred></x-icon.pdfred></a> --}}
                                    <x-icon.pdf-a wire:click="imprimir({{ $presupuesto }})" class="text-green-600" title="PDF" />
                                    <a href="{{ route('presupuesto.html',[$presupuesto,'con']) }}" target="_blank" class="w-6 h-6 text" title="Imprimir Ficha Presupuesto"><x-icon.html ></x-icon.html></a>
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

    <!-- PDF Transactions Modal -->
    <x-modal.confirmationPDF wire:model.defer="showPDFModal">
        <x-slot name="title">Generar Presupuesto en PDF</x-slot>

        <x-slot name="content">
            <div class="py-8 text-gray-700">Selecciona el tipo de Presupuesto a imprimir</div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button  onclick="location.href = '{{route('presupuesto.imprimir', [$presupPDF,'con']) }}'">{{ __('Con totales') }}</x-jet-button>
            <x-jet-secondary-button  onclick="location.href = '{{route('presupuesto.imprimir', [$presupPDF,'sin']) }}'">{{ __('Sin totales') }}</x-jet-secondary-button>
        </x-slot>
    </x-modal.confirmationPDF>
</div>
