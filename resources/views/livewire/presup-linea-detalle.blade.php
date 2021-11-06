<div class="">
    @livewire('menu')
    <div class="">
        @include('presupuestolinea.presupuestocabecera')
        <div class="py-1 space-y-4">
            @include('errormessages')
        </div>
        <div class="mx-2 border rounded">
            @include('presupuestolinea.presupuestolineacabecera')
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
                            <label for="preciotarifa" class="px-1 text-sm text-gray-600">€ Tarifa:</label>
                            <input type="number" id="preciotarifa" wire:model.defer="preciotarifa" disabled
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('preciotarifa') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label for="ratio" class="px-1 text-sm text-gray-600">Ratio:</label>
                            <input type="number" id="ratio" wire:model.defer="ratio" disabled
                            class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-gray-100 border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                            @error('ratio') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-2">
                            <label for="unidades" class="px-1 text-sm text-gray-600">Unidades:</label>
                            <input type="number" id="unidades" wire:model="unidades"
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
                            onclick="location.href = '{{route('presupuestolinea.index',$presuplinea)}}'">{{ __('Volver') }}</x-jet-secondary-button>
                    </div>
                </div>
            </form>
            <div class="space-y-2 ">
                @include('presupuestolinea.acciones',['presupacciones' => $presupacciones,'acciontipoId'=>$acciontipo->id,'accion'=>$acciontipo->nombre])
            </div>
        </div>
    </div>
</div>
