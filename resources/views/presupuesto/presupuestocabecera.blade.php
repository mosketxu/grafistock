<form wire:submit.prevent="save" >
    <div class="flex ">
        <div class="flex-initial w-full py-2 mr-1 space-y-2 bg-white rounded-lg shadow-md">
            <div class="px-2 mx-2 my-1 bg-blue-100 rounded-md">
                <h3 class="font-semibold ">Datos del Presupuesto</h3>
            </div>
            <div class="flex flex-col justify-between ml-3 space-x-3 text-xs font-medium md:flex-row">
                <div class="w-full form-item sm:w-3/12">
                    <label class="block text-gray-700">{{ __('Cliente') }}</label>
                    <input type="text" value="{{ $presupuesto->ent->entidad }}"
                        class="w-full text-xs tracking-tighter text-left border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        disabled/>
                </div>
                <div class="w-full form-item sm:w-2/12">
                    <label class="block text-gray-700">{{ __('Solicitante') }}</label>
                    <input type="text" value="{{ $presupuesto->solicitante->name }}"
                        class="w-full text-xs tracking-tighter text-left border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        disabled/>
                </div>
                <div class="w-full form-item sm:w-2/12">
                    <label class="block text-gray-700">{{ __('Contacto') }}</label>
                    <input type="text" value="{{ $presupuesto->contacto->contacto }}"
                        class="w-full text-xs tracking-tighter text-left border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        disabled/>
                </div>
                <div class="w-full form-item sm:w-1/12">
                    <label class="block text-center text-gray-700">{{ __('F.Presupuesto') }}</label>
                    <input type="date" value="{{ $presupuesto->fechapresu }}"
                        class="w-full text-xs tracking-tighter text-center border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        disabled/>
                </div>
                <div class="w-full form-item sm:w-1/12">
                    <label class="block text-center text-gray-700">{{ __('Ref.Grafitex') }}</label>
                    <input type="text" wire:model.defer="refgrafitex"
                    class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
                <div class="w-full form-item sm:w-1/12">
                    <label class="block text-center text-gray-700">{{ __('Ref.Cliente') }}</label>
                    <input type="text" wire:model.defer="refcliente"
                    class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
                <div class="w-full form-item sm:w-1/12">
                    <label class="block text-gray-700">{{ __('Unidades') }}</label>
                    <input type="number" wire:model="unidades"
                        class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
                <div class="w-full form-item sm:w-1/12">
                    <label class="block text-gray-700">{{ __('€ Compra') }}</label>
                    <input type="text" wire:model.defer="preciocoste"
                        class="w-full text-xs tracking-tighter text-right border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        disabled/>
                </div>
                <div class="w-full form-item sm:w-1/12">
                    <label class="block text-gray-700">{{ __('%Incremento') }}</label>
                    <input type="number" step="any" wire:model="incremento"
                        class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
                <div class="w-full form-item sm:w-1/12">
                    <label class="block text-gray-700">{{ __('€ Venta') }}</label>
                    <input type="number" step="any" wire:model.defer="precioventa"
                        class="w-full text-xs tracking-tighter text-right border-gray-300 rounded-md shadow-sm {{ Auth::user()->hasRole('Admin') ? '' : 'bg-gray-50' }}  focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        {{ Auth::user()->hasRole('Admin') ? '' : 'disabled' }}  />
                </div>
                <div class="w-full form-item sm:w-2/12">
                    <label class="block text-gray-700">{{ __('Estado') }}</label>
                    <x-select wire:model.defer="estado" selectname="estado" required
                        class="w-full py-2 text-xs text-gray-600 placeholder-gray-300 bg-white border-blue-300 rounded-md shadow-sm appearance-none hover:border-gray-400 focus:outline-none">
                        <option value="0">En curso</option>
                        <option value="1">Aceptado</option>
                        <option value="2">Rechazado</option>
                    </x-select>
                </div>
            </div>
            <div class="flex flex-col justify-between ml-3 space-x-3 text-xs font-medium md:flex-row">
                <div class="w-full form-item">
                    <label class="block text-gray-700">{{ __('Descripción') }}</label>
                    <input type="text" wire:model.defer="descripcion"
                        class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
                <div class="w-full form-item">
                    <label class="block text-gray-700">{{ __('Observaciones') }}</label>
                    <input type="text" wire:model.defer="observaciones"
                        class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                </div>
                <div class="w-full pr-4 mr-4 text-right form-item lg:w-2/12">
                    <x-button.button type="submit" color="blue" class="mt-4 focus:bg-blue-900">{{ __('Guardar') }}</x-button.button>
                </div>
            </div>
        </div>
    </div>
</form>
