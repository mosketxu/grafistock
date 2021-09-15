    <div class="">
    @livewire('menu',['entidad'=>$entidad],key($entidad->id))
    <div class="p-1 mx-2">
        <h1 class="text-2xl font-semibold text-gray-900">Pedido {{ $entidad->id? 'de '. $entidad->entidad  :'' }} </h1>

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
                                Pedido
                                @if($search!='')
                                    <x-icon.filter-slash-a wire:click="$set('search', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </label>
                            <input type="text" wire:model="search" class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" placeholder="Búsqueda" autofocus/>
                        </div>
                        <div class="text-xs">
                            <label class="px-1 text-gray-600">
                                Proveedor
                                @if($filtroproveedor!='')
                                    <x-icon.filter-slash-a wire:click="$set('filtroproveedor', '')" class="pb-1" title="reset filter"/>
                                @endif
                            </label>
                            <select wire:model="filtroproveedor" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none" >
                                <option value="">-- selecciona --</option>
                                @foreach ($proveedores as $proveedor )
                                <option value="{{ $proveedor->id }}">{{ $proveedor->entidad }}</option>
                                @endforeach
                            </select>
                        </div>
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
                    <div class="inline-flex mt-3 space-x-2">
                        <x-dropdown label="Actions">
                            {{-- <x-dropdown.item type="button" wire:click="zipSelected" class="flex items-center space-x-2">
                                <x-icon.download class="text-gray-400"></x-icon.download> <span>Generar Zip </span>
                            </x-dropdown.item>
                            <x-dropdown.item type="button" wire:click="mailSelected" class="flex items-center space-x-2">
                                <x-icon.arroba class="text-gray-400"></x-icon.arroba> <span>Enviar Mail </span>
                            </x-dropdown.item> --}}
                            <x-dropdown.item type="button" wire:click="exportSelected" class="flex items-center space-x-2">
                                <x-icon.csv class="text-green-400"></x-icon.csv><span>Export </span>
                            </x-dropdown.item>
                            {{-- <x-dropdown.item type="button" onclick="confirm('¿Estas seguro?') || event.stopImmediatePropagation()" wire:click="deleteSelected" class="flex items-center space-x-2"> --}}
                            <x-dropdown.item type="button" wire:click="$toggle('showDeleteModal')" class="flex items-center space-x-2">
                                <x-icon.trash class="text-red-400"></x-icon.trash> <span>Delete </span>
                            </x-dropdown.item>
                        </x-dropdown>

                        <div class="text-xs">
                            <x-button.button color="blue" onclick="location.href = '{{ route('pedido.create') }}'">Nuevo</x-button.button>
                            {{-- <input type="button" onclick="location.href = '{{ route('pedido.create') }}'" class="w-full px-2 py-2 text-xs text-white bg-blue-700 rounded-md shadow-sm hover:bg-blue-500 " value="{{ __('Nuevo Pedido') }}"/> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- tabla pedidos --}}

            <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="text-xs leading-4 tracking-wider text-gray-500 bg-blue-50 ">
                        <tr class="">
                            <th class="w-5 py-3 pl-2 font-medium text-center"><x-input.checkbox wire:model="selectPage"/></th>
                            <th class="w-5 py-3 pl-2 font-medium text-center ">#</th>
                            <th class="pl-4 font-medium text-left">{{ __('Pedido') }}</th>
                            <th class="pl-4 font-medium text-left">{{ __('Proveedor') }} </th>
                            <th class="pl-4 font-medium text-left">{{ __('F.Pedido') }}</th>
                            <th class="pl-4 font-medium text-left">{{ __('F.Recep.Prev.') }}</th>
                            <th class="pl-4 font-medium text-left">{{ __('F.Recep.') }}</th>
                            <th class="pr-4 font-medium text-right">{{ __('Total (€)') }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-xs bg-white divide-y divide-gray-200">
                        @if($selectPage)
                            <tr class="bg-gray-200" wire:key="row-message">
                                <td  class="py-3 pl-2 font-medium" colspan="18">
                                @unless($selectAll)
                                    <span>Has seleccionado <strong>{{ $pedidos->count() }}</strong> pedidos, ¿quieres seleccionar el total: <strong>{{ $pedidos->total() }}</strong> ?</span>
                                    <x-button.link wire:click="selectAll" class="ml-1 text-blue-600">Select all</x-button.link>
                                @else
                                    <span>Has seleccionado <strong>todas</strong> las {{ $pedidos->total() }} pedidos</span>
                                @endif
                                </td>
                            </tr>
                        @endif
                        @forelse ($pedidos as $pedido)
                            <tr wire:loading.class.delay="opacity-50" wire:key="fila-{{ $pedido->id }}">
                                <td  class="w-5 py-3 pl-2 font-medium text-center">
                                    <x-input.checkbox wire:model="selected" value="{{ $pedido->id }}"/>
                                </td>
                                <td class="text-right">
                                    <a href="#" wire:click="edit" class="text-xs text-gray-200 transition duration-150 ease-in-out hover:outline-none hover:text-gray-800 hover:underline">
                                        {{ $pedido->id }}
                                    </a>
                                </td>
                                <td class="text-right">
                                    @if($pedido->pedido)
                                        <input type="text" value="{{ $pedido->pedido }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                    @endif
                                </td>
                                <td>
                                    <input type="text" value="{{ $pedido->entidad }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td>
                                    <input type="text" value="{{ $pedido->fechapedido->format('d/m/Y') }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td>
                                    <input type="text" value="{{ $pedido->fecharecepcionprevista ? $pedido->fecharecepcionprevista->format('d/m/Y') : '-' }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td>
                                    <input type="text" value="{{ $pedido->fecharecepcion ? $pedido->fecharecepcion->format('d/m/Y') : '-' }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>

                                <td class="text-right">
                                    <span class="pr-4 text-xs text-blue-500">{{ number_format(round($pedido->pedidodetalles->sum('base'),2),2)}}</span>
                                </td>

                                <td class="">
                                    <div class="flex items-center justify-center">
                                        <x-icon.purchase-a href="{{ route('pedido.edit',$pedido) }}" class="text-green-600" title="Editar Pedido"/>
                                        {{-- @if($pedido->pedido)
                                            <x-icon.pdf-a href="{{route('facturacion.imprimirfactura',$pedido) }}" title="PDF"/>
                                        @else
                                            <x-icon.pdf-b title="PDF" disabled/>
                                        @endif
                                        &nbsp;&nbsp;&nbsp; --}}
                                        <x-icon.delete-a wire:click.prevent="delete({{ $pedido->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1 " title="Borrar"/>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado pedidos...
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="font-bold divide-y divide-gray-200">
                        <tr>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td ></td>
                            <td class="pt-2 text-sm text-right text-gray-600">Total:</td>
                            {{-- <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">{{ number_format(round($pedidos.detallepedido->sum('cantidad * ') ,2),2) }}</td> --}}
                            <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">{{ number_format(round($totales,2),2) }}</td>
                            <td ></td>
                            <td ></td>
                            <td colspan="2"></td>
                        </tr>

                    </tfoot>
                </table>
                <div>
                    {{ $pedidos->links() }}
                </div>
            </div>
        </div>

    </div>
    <!-- Delete Transactions Modal -->
    <form wire:submit.prevent="deleteSelected">
        <x-modal.confirmation wire:model.defer="showDeleteModal">
            <x-slot name="title">Borrar Pedido</x-slot>

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
