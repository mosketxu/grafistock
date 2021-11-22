<div class="flex-col mt-2">
    <div class="bg-green-100 rounded-md">
        <h3 class="ml-2 font-semibold ">Nueva composición</h3>
    </div>
    {{-- zona mensajes --}}
    @include('error')

    <table table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <x-table.headgreen class="pl-3 text-left">{{ __('Visible') }}</x-table.headgreen>
                <x-table.headgreen class="w-1/12 pl-3">{{ __('Orden') }}</x-table.headgreen>
                <x-table.headgreen class="w-3/12 pl-3 ">{{ __('Descripción') }} </x-table.headgreen>
                <x-table.headgreen class="w-1/12 pr-3 text-right ">{{ __('€ Tarifa') }}</x-table.headgreen>
                {{-- <x-table.headgreen class="w-1/12 pr-3 text-right ">{{ __('Ratio') }}</x-table.headgreen> --}}
                <x-table.headgreen class="w-1/12 pr-3 text-right ">{{ __('€ Venta') }}</x-table.headgreen>
                <x-table.headgreen class="w-1/12 pr-3 text-right ">{{ __('Unidades') }}</x-table.headgreen>
                <x-table.headgreen class="w-4/12 pl-3 ">{{ __('Observaciones') }} </x-table.headgreen>
                <x-table.headgreen colspan="2" class=""/>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form wire:submit.prevent="save">
                    <td>
                        <input  wire:model="visible" type="checkbox"
                            class="ml-4 text-xs border-gray-300 rounded-sm shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                    </td>
                    <td>
                        <input  wire:model="orden" type="number"
                            class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    </td>
                    <td>
                        <input  wire:model="descripcion" type="text"
                            class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    </td>
                    <td>
                        <input  wire:model="preciotarifa" type="number" step="any"
                            class="w-full text-xs tracking-tighter text-right border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            disabled/>
                    </td>
                    {{-- <td>
                        <input  wire:model="ratio" type="number" step="any"
                            class="w-full text-xs tracking-tighter text-right border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            disabled/>
                    </td> --}}
                    <td>
                        <input  wire:model="precioventa" type="number" step="any"
                        class="w-full text-xs tracking-tighter text-right border-gray-300 rounded-md shadow-sm bg-gray-50 focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        disabled/>
                </td>
                    <td>
                        <input  wire:model="unidades" type="number"
                            class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                    </td>

                    <td>
                        <input  wire:model="observaciones" type="text"
                            class="w-full text-xs text-left border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    </td>
                    <td>
                        <div class="text-center">
                            <x-button.button type="submit" color="blue" class="focus:bg-blue-900">{{ __('Añadir') }}</x-button.button>
                        </div>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>


