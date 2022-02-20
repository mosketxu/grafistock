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
                    <div class="flex items-center justify-between p-1 rounded-lg shadow-md bg-blue-50">
                        <div class="">
                            <input type="number" id="presupuesto" wire:model="presupuesto"
                                    class="py-2 text-sm text-gray-600 bg-white border-none rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                    disabled>
                            @error('presupuesto') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                            <div class="items-center ">
                                <x-select wire:model="estado" selectname="estado" required
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                        <option value="0">En curso</option>
                                        <option value="1">Aceptado</option>
                                        <option value="2">Rechazado</option>
                                </x-select>
                                @error('estado') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <input type="hidden"  wire:model="presupuesto_id">
                    </div>
                    <div class="mt-2">
                        <div class="flex space-x-2">
                            <div class="mb-2">
                                <label for="entidad_id" class="px-1 text-sm text-gray-600">Cliente:</label>
                                <select wire:model.lazy="entidad_id"
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                    required autofocus>
                                    <option value="">-- choose --</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->entidad }}</option>
                                    @endforeach
                                </select>
                                @error('entidad_id') <span class="text-red-500">{{ $message }}</span>@enderror
                                <a href="{{ route('entidad.nueva','4') }}" class="text-xs text-blue-600 underline">Nuevo Prospect</a>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="w-full mb-2">
                                <label for="solicitante_id" class="px-1 text-sm text-gray-600">Solicitante:</label>
                                @if(Auth::user()->hasRole('Admin'))
                                    <x-select wire:model.defer="solicitante_id" selectname="solicitante_id"
                                        class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                        <option value="">-- choose --</option>
                                        @foreach ($solicitantes as $solicitante)
                                            <option value="{{ $solicitante->id }}">{{ $solicitante->name }}</option>
                                        @endforeach
                                    </x-select>
                                @else
                                    <input type="text" value="{{ Auth::user()->name }}"
                                        class="w-full py-2 text-sm text-gray-600 bg-white border-none rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                        disabled>
                                @endif
                                @error('solicitante_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-full mb-2">
                                <label for="entidadcontacto_id" class="px-1 text-sm text-gray-600">Contacto:</label>
                                <select wire:model.defer="entidadcontacto_id"
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                    required autofocus>
                                    <option value="">-- choose --</option>
                                    @if($contactos)
                                        @foreach ($contactos as $contacto)
                                            <option value="{{ $contacto->id }}">{{ $contacto->contacto }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('entidadcontacto_id') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="w-full mb-2">
                                <label for="fechapresupuesto" class="px-1 text-sm text-gray-600">Fecha:</label>
                                <input type="date" id="fechapresupuesto" wire:model.defer="fechapresupuesto"
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                    required>
                                    @error('fechapresupuesto') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-full mb-2">
                                <label for="incremento" class="px-1 text-sm text-gray-600">Incremento (%):</label>
                                <input type="number" step="any" id="invremento" wire:model.defer="incremento"
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none"
                                    required>
                                @error('incremento') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-full mb-2">
                                <label for="refgrafitex" class="px-1 text-sm text-gray-600">Ref.Grafitex:</label>
                                <input type="text" id="refgrafitex" wire:model.defer="refgrafitex" required
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                @error('refgrafitex') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="w-full mb-2">
                                <label for="refcliente" class="px-1 text-sm text-gray-600">Ref.Cliente:</label>
                                <input type="text" id="refcliente" wire:model.defer="refcliente" required
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                @error('refcliente') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-full mb-2">
                                <label for="descripcion" class="px-1 text-sm text-gray-600">Descripción:</label>
                                <input type="text" id="descripcion" wire:model.defer="descripcion" required
                                    class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                                @error('descripcion') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-full mb-2">
                                <label for="observaciones" class="px-1 text-sm text-gray-600">Observaciones:</label>
                                <textarea id="observaciones" wire:model.defer="observaciones"
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
