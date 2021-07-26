<div class="flex-col ">
    <div class="bg-green-100 rounded-md">
        <h3 class="ml-2 font-semibold ">Nuevo detalle</h3>
    </div>
    {{-- zona mensajes --}}
    <div class="py-1 mx-4 space-y-2">
        @if ($message)
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                <span class="inline-block mx-8 align-middle">
                    {{ $message }}
                </span>
                <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                    <span>×</span>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                    <span>×</span>
                </button>
            </div>
        @endif
    </div>
    <table table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <x-table.headgreen class="pl-2">{{ __('Orden') }}</x-table.headgreen>
                <x-table.headgreen class="w-2/12 pl-2">{{ __('Material') }}</x-table.headgreen>
                <x-table.headgreen class="w-2/12 pl-2">{{ __('Referencia') }} </x-table.headgreen>
                <x-table.headgreen class="w-3/12 pl-2">{{ __('Descripción') }} </x-table.headgreen>
                <x-table.headgreen class="w-1/12 pl-2 text-right">{{ __('Uds.') }}</x-table.headgreen>
                <x-table.headgreen class="w-1/12 pl-2 text-right">{{ __('Coste') }}</x-table.headgreen>
                <x-table.headgreen class="w-1/12 pl-2 text-right">{{ __('Ud.Compra') }}</x-table.headgreen>
                <x-table.headgreen class="w-1/12 pr-10 text-right">{{ __('Total (€)') }}</x-table.headgreen>
                <x-table.headgreen colspan="2" class="w-1/12"/>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form wire:submit.prevent="save">
                    <td>
                        <input  wire:model="detalle.orden" type="text" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    </td>
                    <td>
                        <x-select wire:model="material"  selectname="material" class="w-full tracking-tighter">
                            <option value="">-- Material--</option>
                            @foreach ($materiales as $material)
                            <option value="{{ $material->sigla }}">{{ $material->nombre }}</option>
                            @endforeach>
                        </x-select>
                    </td>
                    <td>
                        <x-select wire:model="detalle.producto_id"  selectname="producto_id" class="w-full tracking-tighter">
                            <option value="">-- Referencia--</option>
                            @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->referencia }}</option>
                            @endforeach>
                        </x-select>
                    </td>
                    <td>
                        <input  wire:model="descripcion" type="text" class="w-full text-xs tracking-tighter text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled/>
                    </td>
                    <td>
                        <input  wire:model="detalle.cantidad" type="text"  class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                    </td>

                    <td>
                        <input  wire:model="detalle.coste" type="number" step="any" class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                    </td>
                    <td>
                        <x-select wire:model="detalle.udcompra_id"  selectname="udcompra_id" class="w-full">
                            <option value="">-- ud compra--</option>
                            @foreach ($unidadescoste as $ud)
                            <option value="{{ $ud->sigla }}">{{ $ud->nombre }}</option>
                            @endforeach>
                        </x-select>
                    </td>
                    <x-table.cell>
                        <div class="flex-1 py-1 pr-10 text-sm font-bold text-right text-gray-900 rounded-lg bg-gray-50">
                            @if(is_numeric($detalle->cantidad) && is_numeric($detalle->coste))
                                {{ number_format(round($detalle->cantidad*$detalle->coste, 2),2) }}
                            @endif
                        </div>
                    </x-table.cell>

                    <td>
                        <div class="text-center">
                            <x-button.button type="submit" color="blue" class="">{{ __('Añadir') }}</x-button.button>
                        {{-- <button type='submit' class="py-2 text-xs font-semibold text-center text-white transition bg-blue-700 border border-transparent rounded-md hover:bg-blue-800 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25">
                            {{ __('Añadir') }}
                        </button> --}}
                    </div>
                    </td>
                </form>
            </tr>

        </tbody>
    </table>
</div>


