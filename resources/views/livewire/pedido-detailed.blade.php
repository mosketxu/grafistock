<div class="flex-col">
    <div class="bg-yellow-100 rounded-md">
        <h3 class="ml-2 font-semibold ">Detalle Pedido</h3>
    </div>
    {{-- zona mensajes --}}
    <div class="py-1 mx-4 space-y-2">
        @if (session()->has('message'))
            <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                <span class="inline-block mx-8 align-middle">
                    {{ session('message') }}
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

    {{-- tabla detalles --}}

    <table table class="min-w-full ">
        <thead>
            <tr>
                <x-table.headyellow class="pl-2">{{ __('Orden') }}</x-table.headyellow>
                <x-table.headyellow class="w-2/12 pl-2">{{ __('Material') }}</x-table.headyellow>
                <x-table.headyellow class="w-2/12 pl-2">{{ __('Referencia') }} </x-table.headyellow>
                <x-table.headyellow class="w-3/12 pl-2">{{ __('Descripción') }} </x-table.headyellow>
                <x-table.headyellow class="w-1/12 pr-3 text-right">{{ __('Uds.') }}</x-table.headyellow>
                <x-table.headyellow class="w-1/12 pr-3 text-right">{{ __('Coste') }}</x-table.headyellow>
                <x-table.headyellow class="w-1/12 pr-3 text-right">{{ __('Ud.Compra') }}</x-table.headyellow>
                <x-table.headyellow class="w-1/12 pr-3 text-right">{{ __('Total (€)') }}</x-table.headyellow>
                <x-table.headyellow colspan="2" class="w-1/12"/>
            </tr>
        </thead>
        <tbody>
            @forelse ($detalles as $detalle)
                <tr wire:loading.class.delay="opacity-50" class="py-0 my-0">
                    <td><input type="text" value="{{ $detalle->orden }}" wire:change="changeOrden({{ $detalle }},$event.target.value)" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                    <td><input type="text" value="{{ $detalle->producto->material->nombre }}" class="w-full text-xs tracking-tighter bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly/></td>
                    <td><input type="text" value="{{ $detalle->producto->referencia }}" class="w-full text-xs tracking-tighter bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly/></td>
                    <td><input type="text" value="{{ $detalle->producto->descripcion }}" class="w-full text-xs tracking-tighter bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly/></td>
                    <td><input type="text" value="{{ $detalle->cantidad }}" wire:change="changeCantidad({{ $detalle }},$event.target.value)" class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                    <td><input type="text" value="{{ $detalle->coste }}" wire:change="changeCoste({{ $detalle }},$event.target.value)" class="w-full text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/></td>
                    <td><input type="text" value="{{ $detalle->unidadcompra->nombre ?? '-' }}" class="w-full text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly/></td>
                    <td>
                        @if(is_numeric($detalle->cantidad) && is_numeric($detalle->coste))
                            <input type="text" value="{{ number_format(round($detalle->cantidad*$detalle->coste, 2),2,',','.') }}" class="w-full text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly/>
                        @else
                            <input type="text" value="-" class="w-full text-xs bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly/>
                        @endif
                    </td>
                    <td>
                        @if($bloqueado!=true)
                            <div class="text-center">
                                {{-- <x-icon.edit-a wire:click.prevent="editDetalle({{$detalle}})" title="Editar"/> --}}
                                <x-icon.delete-a wire:click.prevent="delete({{ $detalle->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"  title="Eliminar detalle"/>
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">
                            <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                            <span class="py-5 text-xl font-medium text-gray-500">
                                No se han encontrado detalles...
                            </span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="font-bold ">
            <tr>
                <td class="pl-2"></td>
                <td class="pl-2"></td>
                <td class="pl-2 "></td>
                <td class="pr-2"></td>
                <td class="pr-2"></td>
                <td class="pr-2"></td>
                <td class="pl-2 text-right">Total</td>
                <td class="pr-3 text-right">{{ number_format($total,2,',','.') }}</td>
                <td colspan="2" class="w-1/12"></td>
            </tr>
        </tfoot>
    </table>


    @if($bloqueado!=true)
        @if($showcrear)
            @livewire('pedido-detalle-create',['pedido'=>$pedido],key($pedido->id))
        @endif
    @endif
</div>
