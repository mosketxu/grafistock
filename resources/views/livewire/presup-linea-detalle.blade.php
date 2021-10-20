<div class="">
    @livewire('menu')
    <div class="">
        <div class="flex flex-row items-center justify-between p-1 mx-2 my-0">
            <div class="py-0 my-0">
                <p class="text-2xl font-semibold text-gray-900">Presupuesto: {{ $presupuestolinea->presupuesto->presupuesto ?? '-'}}
                </p>
            </div>
            <div class="">
                <p class="text-xl font-semibold text-gray-900">Cliente: {{ $presupuestolinea->presupuesto->entidad->entidad ?? '-'
                    }}</p>
            </div>
            <div class="">
                <p class="text-sm font-semibold text-gray-900">Descripción: {{ $presupuestolinea->presupuesto->descripcion ?? '-'}}
                </p>
            </div>
        </div>
        <div class="py-1 space-y-4">
            @include('errormessages')
        </div>
        <div class="mx-2 border rounded">
            <div class="">
                <div class="flex flex-row items-center justify-between p-1 mx-2 my-0">
                    <div class="w-8/12 py-0 my-0">
                        <p class="text-xl font-semibold text-gray-900">Descripción línea: {{ $presupuestolinea->descripcion}}</p>
                    </div>
                    <div class="w-8/12 py-0 my-0">
                        <p class="text-xl font-semibold text-gray-900">{{ $acciontipo->nombre}}</p>
                    </div>
                    <div class="w-2/12">
                        <p class="text-lg font-semibold text-right text-gray-900">€ Coste: {{ $presupuestolinea->preciocoste }}</p>
                    </div>
                    <div class="w-2/12">
                        <p class="text-lg font-semibold text-right text-gray-900">€ Venta: {{ $presupuestolinea->precioventa}}</p>
                    </div>
                </div>
            </div>
            <form>
                <div class="mx-2 mt-2">
                    <div class="flex space-x-2">
                        <div class="mb-2">
                            <label for="visible" class="px-1 text-sm text-gray-600">Visible:</label>
                            <input wire:model="visible" type="checkbox"
                            class="ml-4 text-xs border-gray-300 rounded-sm shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                        </div>
                        <div class="mb-2">
                            <label for="orden" class="px-1 text-sm text-gray-600">Orden:</label>
                            <input wire:model="orden" type="number"
                            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('orden') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label for="accion_id" class="px-1 text-sm text-gray-600">{{ $acciontipo->nombre }}</label>
                            <x-select wire:model.lazy="accion_id" selectname="accion_id" required
                                class="py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                    <option value="">-- choose --</option>
                                @foreach ($acciones as $accion)
                                    <option value="{{ $accion->id }}">{{ $accion->descripcion }}</option>
                                @endforeach
                            </x-select>
                            @error('accion_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="w-full mb-2">
                            <label for="descripcion" class="px-1 text-sm text-gray-600">Descripción:</label>
                            <input type="text" id="descripcion" wire:model.defer="descripcion" required
                            class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label for="preciocoste" class="px-1 text-sm text-gray-600">€ Coste:</label>
                            <input type="number" id="preciocoste" wire:model.defer="preciocoste" disabled
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('preciocoste') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label for="ratio" class="px-1 text-sm text-gray-600">Ratio:</label>
                            <input type="number" id="ratio" wire:model.defer="ratio" disabled
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('ratio') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label for="unidades" class="px-1 text-sm text-gray-600">Unidades:</label>
                            <input type="number" id="unidades" wire:model.defer="unidades"
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('unidades') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label for="precioventa" class="px-1 text-sm text-gray-600">€ Venta:</label>
                            <input type="number" id="precioventa" wire:model.defer="precioventa"
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('precioventa') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-full mb-2">
                            <label for="observaciones"
                                class="px-1 text-sm text-gray-600">Observaciones:</label>
                            <textarea id="observaciones" wire:model="observaciones"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                placeholder="Introduce las observaciones"></textarea>
                            @error('observaciones') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="flex pl-2 mt-2 mb-2 ml-2 space-x-4">
                    <div class="space-x-3">
                        <x-jet-button wire:click.prevent="save()" class="bg-blue-600">{{ __('Guardar') }}
                        </x-jet-button>
                        <x-jet-secondary-button
                            onclick="location.href = '{{route('presupuestolinea.index',$presupuestolinea)}}'">{{ __('Volver') }}</x-jet-secondary-button>
                    </div>
                </div>
            </form>
    </div>
</div>
