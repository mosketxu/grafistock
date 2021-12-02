<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Pone el fondo gris -->
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <!-- Aquí el modal. -->
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full md:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="mt-2">
                        <div class="flex space-x-2">
                            {{-- <input type="hidden" id="accion_id" wire:model.defer="accion_id"/> --}}
                            <div class="w-full mb-2">
                                <label for="referencia" class="px-1 text-sm text-gray-600">Referencia:</label>
                                <input type="text" id="referencia" wire:model.defer="referencia" required
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                @error('referencia') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-full mb-2">
                                <label for="descripcion" class="px-1 text-sm text-gray-600">Descripcion:</label>
                                <input type="text" id="descripcion" wire:model.defer="descripcion" required
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="mb-2">
                                <label for="acciontipo_id" class="px-1 text-sm text-gray-600">Tipo:</label>
                                <x-select wire:model.defer="acciontipo_id" selectname="acciontipo_id" required
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                    <option value="">-- choose --</option>
                                    @foreach ($acciontipos as $tipo)
                                        <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </x-select>
                                @error('acciontipo_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2">
                                <label for="preciotarifa" class="px-1 text-sm text-gray-600">€ Tarifa:</label>
                                <input type="number" id="preciotarifa" wire:model.defer="preciotarifa"
                                class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                @error('preciotarifa') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-2">
                                <label for="udpreciotarifa_id" class="px-1 text-sm text-gray-600">Uds:</label>
                                <x-select wire:model.defer="udpreciotarifa_id" selectname="udpreciotarifa_id" required
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                    <option value="">-- choose --</option>
                                    @foreach ($unidades as $ud)
                                        <option value="{{ $ud->id }}">{{ $ud->nombre }}</option>
                                    @endforeach
                                </x-select>
                                @error('udpreciotarifa_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            {{-- <div class="mb-2">
                                <label for="precioventa" class="px-1 text-sm text-gray-600">€ Venta:</label>
                                <input type="number" id="precioventa" wire:model.defer="precioventa"
                                class="w-full py-2 text-xs text-right text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                @error('precioventa') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div> --}}
                        </div>
                        <div class="flex">
                            <div class="w-full mb-2">
                                <label for="observaciones" class="px-1 text-sm text-gray-600">Observaciones:</label>
                                <textarea id="observaciones" wire:model="observaciones"
                                class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                placeholder="Introduce las observaciones"></textarea>
                                @error('observaciones') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex pl-2 mt-2 mb-2 ml-2 space-x-4">
                    <div class="space-x-3">
                        <x-jet-button wire:click.prevent="store()" class="bg-blue-600">{{ __('Guardar') }}</x-jet-button>
                        <x-jet-secondary-button  wire:click="closeNewModal()">{{ __('Cancelar') }}</x-jet-secondary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
