<div class="">
    @livewire('menu')
    <div class="p-1 mx-2">
        <h1 class="text-2xl font-semibold text-gray-900">Stock por {{ $titulo }}</h1>

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
            <div class="flex justify-between space-x-1">
                <div class="inline-flex space-x-2">
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Proveedor
                            @if($filtroclipro!='')
                                <x-icon.filter-slash-a wire:click="$set('filtroclipro', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtroclipro" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}">{{ $proveedor->entidad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Familia
                            @if($filtrofamilia!='')
                                <x-icon.filter-slash-a wire:click="$set('filtrofamilia', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtrofamilia" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($familias as $familia)
                            <option value="{{ $familia->id }}">{{ $familia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Material
                            @if($filtromaterial!='')
                                <x-icon.filter-slash-a wire:click="$set('filtromaterial', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtromaterial" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($materiales as $material)
                            <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-xs">
                        <label class="px-1 text-gray-600">
                            Acabado
                            @if($filtroacabado!='')
                                <x-icon.filter-slash-a wire:click="$set('filtroacabado', '')" class="pb-1" title="reset filter"/>
                            @endif
                        </label>
                        <select wire:model="filtroacabado" class="w-full py-2 text-xs text-gray-600 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            <option value=""></option>
                            @foreach ($acabados as $acabado)
                            <option value="{{ $acabado->id }}">{{ $acabado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($tipo=='producto_id')
                        {{-- <div class="text-xs">
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
                        </div> --}}
                        <div class="text-xs">
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
                {{-- Parte derecha --}}
                <div class="inline-flex mt-3 space-x-2">
                    <div class="items-center text-xs">
                        <x-button.button  wire:click="exportXLS" color="green"><x-icon.xls/></x-button.button>
                    </div>
                    <div class="items-center text-xs">
                        <x-button.button  onclick="location.href = '{{ route('stock.create') }}'" color="blue">{{ __('Nueva') }}</x-button.button>
                    </div>
                </div>
            </div>

            {{-- tabla movimientos --}}
            <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="text-xs leading-4 tracking-wider text-gray-500 bg-blue-50 ">
                        <tr class="">
                            {{-- <th class="w-5 py-3 pl-2 font-medium text-center"><x-input.checkbox wire:model="selectPage"/></th> --}}
                            {{-- <th class="w-5 py-3 pl-2 font-medium text-center ">#</th> --}}
                            <th class="pl-4 font-medium text-left">{{ __('Proveedor') }}</th>
                            @if($tipo=='producto_id')
                                <th class="pl-4 font-medium text-left">{{ __('Referencia') }}</th>
                                <th class="pl-4 font-medium text-left">{{ __('Descripcion') }}</th>
                            @endif
                            <th class="pl-4 font-medium text-left">{{ __('Familia') }} </th>
                            <th class="pl-4 font-medium text-left">{{ __('Material') }} </th>
                            <th class="pl-4 font-medium text-left">{{ __('Acabado') }} </th>
                            <th class="pr-4 font-medium text-right">{{ __('Ancho') }} </th>
                            <th class="pr-4 font-medium text-right">{{ __('Alto') }} </th>
                            <th class="pr-4 font-medium text-right">{{ __('Ubicación') }}</th>
                            <th class="pr-4 font-medium text-right">{{ __('Cantidad') }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody class="text-xs bg-white divide-y divide-gray-200">
                        @forelse ($stocks as $stock)
                            <tr wire:loading.class.delay="opacity-50" wire:key="fila-{{ $stock->id }}">
                                <td class="text-left">
                                    <input type="text" value="{{ $stock->producto->entidad->entidad }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                @if($tipo=='producto_id')
                                    <td class="text-left">
                                        <input type="text" value="{{ $stock->producto->referencia }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                    </td>
                                    <td class="text-left">
                                        <input type="text" value="{{ $stock->producto->descripcion }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                    </td>
                                @endif
                                <td  class="text-left">
                                    <input type="text" value="{{ $stock->producto->familia->nombre }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td  class="text-left">
                                    <input type="text" value="{{ $stock->producto->material->nombre }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td  class="text-left">
                                    <input type="text" value="{{ $stock->producto->acabado->nombre }}" class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td  class="text-left">
                                    <input type="text" value="{{ $stock->producto->ancho }} {{ $stock->producto->unidadancho->nombrecorto ?? '-' }}" class="w-full text-xs font-thin text-right text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td  class="text-left">
                                    <input type="text" value="{{ $stock->producto->alto }} {{ $stock->producto->unidadalto->nombrecorto ?? '-' }}" class="w-full text-xs font-thin text-right text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td  class="text-right">
                                    <input type="text" value="{{ $stock->producto->ubicacion->nombre ?? '-' }} " class="w-full text-xs font-thin text-right text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                                <td  class="text-right">
                                    <input type="text" value="{{ $stock->balance }}" class="w-full text-xs font-thin text-right text-gray-500 truncate border-0 rounded-md"  readonly/>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <div class="flex items-center justify-center">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado movimientos...
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div>
                    {{ $stocks->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

