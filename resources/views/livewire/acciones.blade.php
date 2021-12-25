{{-- <div class="w-full px-2 mb-4"> --}}
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
                            </label>
                            <input type="text" wire:model="search"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                placeholder="Búsqueda" autofocus />
                        </div>
                    </div>
                    <div class="text-xs">
                        <div class="flex">
                            <label class="px-1 text-gray-600">
                                Tipo
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
            </div>
            <div class="py-1 space-y-1">
                @include('error')
            </div>

            <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-t-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="w-1/12 px-2 py-2 text-xs font-medium leading-4 text-left text-gray-500 bg-blue-50" >Referencia</th>
                            <th class="w-2/12 px-2 py-2 text-xs font-medium leading-4 text-left text-gray-500 bg-blue-50" >Descripcion</th>
                            <th class="w-1/12 px-2 py-2 text-xs font-medium leading-4 text-left text-gray-500 bg-blue-50" >Tipo</th>
                            <th class="w-1/12 px-2 py-2 text-xs font-medium leading-4 text-right text-gray-500 bg-blue-50" >€ Compra</th>
                            <th class="w-1/12 px-2 py-2 text-xs font-medium leading-4 text-right text-gray-500 bg-blue-50" >€ Venta</th>
                            <th class="w-1/12 px-2 py-2 text-xs font-medium leading-4 text-right text-gray-500 bg-blue-50" >€ Mínimo</th>
                            <th class="w-1/12 ml-12 text-xs font-medium leading-4 text-center text-gray-500 bg-blue-50" >Ud.</th>
                            <th class="w-3/12 px-2 py-2 text-xs font-medium leading-4 text-left text-gray-500 bg-blue-50" >Observaciones</th>
                            <th class="w-10 px-2 py-2 text-xs font-medium leading-4 text-left text-gray-500 bg-blue-50" ></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="min-w-full overflow-x-auto overflow-y-auto align-middle shadow max-h-64 sm:rounded-b-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200 ">
                        @foreach ($acciones as $accion)
                            <tr wire:loading.class.delay="opacity-50">
                                <td class="w-1/12 px-2 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <input type="text" value="{{ $accion->referencia }}"
                                    class="w-full text-xs font-thin bg-gray-100 text-gray-500 border-0 rounded-md"
                                    disabled/>
                                </td>
                                <td class="w-2/12 px-2 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 ">
                                    <input type="text" value="{{ $accion->descripcion }}"
                                    wire:change="changeDescripcion({{ $accion }},$event.target.value)"
                                    class="w-full text-xs font-thin text-gray-500 border-0 rounded-md"/>
                                </td>
                                <td class="w-1/12 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 ">
                                    <select value="{{ $accion->acciontipo_id }}"
                                        wire:change="changeAcciontipo({{ $accion }},$event.target.value)"
                                        required
                                        class="w-full text-xs text-gray-600 bg-white border-none rounded-md appearance-none 300 hover:border-gray-400 focus:outline-none">
                                        @foreach ($acciontipos as $tipo)
                                            <option value="{{ $tipo->id }}" {{ $tipo->id== $accion->acciontipo_id? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="w-1/12 px-2 py-2 text-xs font-medium leading-4 tracking-tighter text-right text-gray-600 ">
                                    <input type="number" step="any" value="{{ $accion->preciocoste }}"
                                    wire:change="changePreciocoste({{ $accion }},$event.target.value)"
                                    class="w-full text-xs font-thin text-right text-gray-500 border-0 rounded-md"/>
                                </td>
                                <td class="w-1/12 px-2 py-2 text-xs font-medium leading-4 tracking-tighter text-right text-gray-600 ">
                                    <input type="number" step="any" value="{{ $accion->precioventa }}"
                                    wire:change="changePrecioventa({{ $accion }},$event.target.value)"
                                    class="w-full text-xs font-thin text-right text-gray-500 border-0 rounded-md"/>
                                </td>
                                <td class="w-1/12 px-2 py-2 text-xs font-medium leading-4 tracking-tighter text-right text-gray-600 ">
                                    <input type="number" step="any" value="{{ $accion->preciominimo }}"
                                    wire:change="changePreciominimo({{ $accion }},$event.target.value)"
                                    class="w-full text-xs font-thin text-right text-gray-500 border-0 rounded-md"/>
                                </td>
                                <td class="w-1/12 px-2 py-2 text-xs font-medium leading-4 tracking-tighter text-right text-gray-600 ">
                                    <select value="{{ $accion->udpreciocoste_id }}"
                                        wire:change="changeUdpreciocoste({{ $accion }},$event.target.value)"
                                        required
                                        class="w-full  text-xs text-gray-600 bg-white border-none rounded-md appearance-none 300 hover:border-gray-400 focus:outline-none">
                                        @foreach ($unidades as $unidad)
                                            <option value="{{ $unidad->id }}" {{ $unidad->id== $accion->udpreciocoste_id? 'selected' : '' }}>{{ $unidad->nombre }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="w-3/12 py-2 pl-5 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 ">
                                    <input type="text"  value="{{ $accion->observaciones }}"
                                    wire:change="changeObservaciones({{ $accion }},$event.target.value)"
                                    class="w-full text-xs font-thin text-left text-gray-500 border-0 rounded-md"/>
                                </td>
                                <td class="w-1/12 px-2 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 ">
                                    <div class="flex items-center justify-center">
                                        <x-icon.delete-a wire:click.prevent="delete({{ $accion->id }})"
                                            onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()"
                                            class="pl-1 " title="Borrar" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="min-w-full overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
                <form wire:submit.prevent="store">
                    <table min-w-full divide-y divide-gray-200>
                        <tbody>
                            <tr>
                                <td class="w-1/12 py-2 pl-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <input type="text" wire:model.defer="referencia"
                                    class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                </td>
                                <td class="w-2/12 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <input type="text" wire:model.defer="descripcion"
                                    class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                </td>
                                <td class="w-1/12 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <x-select wire:model.defer="acciontipo_id" selectname="acciontipo_id" required
                                        class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                        <option value="">-- choose --</option>
                                        @foreach ($acciontipos as $tipo)
                                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                        @endforeach
                                    </x-select>
                                    @error('acciontipo_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td class="w-1/12 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <input type="number" step="any" wire:model.defer="preciocoste"
                                    class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    @error('preciocoste') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td class="w-1/12 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <input type="number" step="any" wire:model.defer="precioventa"
                                    class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    @error('precioventa') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td class="w-1/12 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <input type="number" step="any" wire:model.lazy="preciominimo"
                                    class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    @error('preciominimo') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td class="w-1/12 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <x-select wire:model.defer="udpreciocoste_id" selectname="udpreciocoste_id" required
                                        class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                        <option value="">-- choose --</option>
                                        @foreach ($unidades as $ud)
                                            <option value="{{ $ud->id }}">{{ $ud->nombre }}</option>
                                        @endforeach
                                    </x-select>
                                    @error('udpreciocoste_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td class="w-3/12 py-2 text-xs font-medium leading-4 tracking-tighter text-left text-gray-600 " >
                                    <input type="text" step="any" wire:model.defer="observaciones"
                                    class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                                    @error('observaciones') <span class="text-red-500">{{ $message }}</span>@enderror
                                </td>
                                <td class="w-1/12 py-2 text-gray-600 ">
                                    <div class="flex text-center">
                                        <button type="submit" class="w-5 h-5 ml-10 text-center"><x-icon.save-a class="h-5 text-blue"></x-icon.save-a></button>
                                    </div>
                                </td >
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
{{-- </div> --}}
