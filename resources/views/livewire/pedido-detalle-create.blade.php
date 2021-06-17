<div class="flex-col space-y-2">
    <div class="bg-green-100 rounded-md">
        <h3 class="ml-2 font-semibold ">Nuevo detalle</h3>
    </div>

    <table table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <x-table.headgreen class="pl-2">{{ __('Orden') }}</x-table.headgreen>
                <x-table.headgreen class="pl-2">{{ __('Producto') }} </x-table.headgreen>
                <x-table.headgreen class="pl-2">{{ __('Uds.') }}</x-table.headgreen>
                <x-table.headgreen class="pl-2">{{ __('Coste') }}</x-table.headgreen>
                <x-table.headgreen class="pl-2">{{ __('% IVA') }}</x-table.headgreen>
                <x-table.headgreen class="pr-10 text-right">{{ __('Base (€)') }}</x-table.headgreen>
                <x-table.headgreen class="pr-10 text-right">{{ __('IVA (€)') }}</x-table.headgreen>
                <x-table.headgreen class="pr-10 text-right">{{ __('Total (€)') }}</x-table.headgreen>
                <x-table.headgreen colspan="2" class="w-1/12"/>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form wire:submit.prevent="save">
                    <td>
                        <x-jet-input  wire:model="detalle.orden" type="text" id="orden" class="w-full" :value="old('orden') "/>
                        <x-jet-input-error for="detalle.orden" class="mt-2" />
                    </td>

                    <td>
                        <x-select wire:model="detalle.producto_id"  selectname="producto_id" class="w-full">
                            <option value="">-- Producto--</option>
                            @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->referencia }}</option>
                            @endforeach>
                        </x-select>
                        <x-jet-input-error for="detalle.producto_id" class="mt-2" />
                    </td>

                    <td>
                        <x-jet-input  wire:model="detalle.cantidad" type="text"  id="cantidad" class="w-full" :value="old('cantidad') "/>
                        <x-jet-input-error for="detalle.cantidad" class="mt-2" />
                    </td>

                    <td>
                        <x-jet-input  wire:model="detalle.coste" type="number" step="any" id="coste" class="w-full text-right" :value="old('coste') "/>
                        <x-jet-input-error for="detalle.coste" class="mt-2" />
                    </td>

                    <td>
                        <x-select wire:model="detalle.iva"  selectname="iva" class="w-full text-right">
                            <option value="0">0%</option>
                            <option value="0.04">4%</option>
                            <option value="0.10">10%</option>
                            <option value="0.21">21%</option>
                        </x-select>
                        <x-jet-input-error for="detalle.iva" class="mt-2" />
                    </td>

                    <x-table.cell>
                        <div class="flex-1 py-1 pr-10 text-sm font-bold text-right text-gray-900 rounded-lg bg-gray-50">
                            @if(is_numeric($detalle->cantidad) && is_numeric($detalle->coste))
                                {{ number_format(round($detalle->cantidad*$detalle->coste, 2),2) }}
                            @endif
                        </div>
                    </x-table.cell>

                    <x-table.cell>
                        <div class="flex-1 py-1 pr-10 text-sm font-bold text-right text-gray-900 bg-gray-100 rounded-lg">
                            @if(is_numeric($detalle->iva) && is_numeric($detalle->cantidad) && is_numeric($detalle->coste))
                                {{ number_format(round($detalle->iva*$detalle->cantidad*$detalle->coste, 2),2) }}
                            @endif
                        </div>
                    </x-table.cell>
                    <x-table.cell>
                        <div class="flex-1 py-1 pr-10 text-sm font-bold text-right text-gray-900 bg-gray-200 rounded-lg">
                            @if(is_numeric($detalle->iva) && is_numeric($detalle->cantidad) && is_numeric($detalle->coste))
                                {{ number_format(round((1+$detalle->iva)*$detalle->cantidad*$detalle->coste, 2),2) }}
                            @endif
                        </div>
                    </x-table.cell>

                    <td>
                        <x-jet-button class="w-full text-center bg-blue-600">
                            {{ __('Añadir detalle') }}
                        </x-jet-button>
                    </td>
                </form>
            </tr>
        </tbody>
    </table>
</div>


