<div class="w-full mr-1 bg-white rounded-lg ">
    <div class="mx-2 border border-blue-500 rounded-md shadow-md bg-blue-50">
        <div class="flex flex-row mt-1 ml-3 border-b-2">
            <h3 class="w-1/12 font-semibold ">{{ $accion }}</h3>
            <x-icon.plus-a  href="{{route('presupuestolinea.create',[$presuplinea,$acciontipoId])}}" class="pl-1 ml-3 w-7 h-7"  title="'Añadir línea"/>
        </div>
        <table table class="min-w-full text-xs ">
            <thead>
                <tr>
                    <td class="pl-3 text-center">{{ __('Visible') }}</td>
                    <td class="w-1/12 pl-3">{{ __('Orden') }}</td>
                    <td class="w-3/12 pl-3 ">{{ __('Descripción') }} </td>
                    <td class="w-3/12 pl-3 ">{{ $accion }} </td>
                    <td class="w-1/12 pr-3 text-right ">{{ __('€ Coste') }}</td>
                    <td class="w-1/12 pr-3 text-right ">{{ __('Ratio') }}</td>
                    <td class="w-1/12 pr-3 text-right ">{{ __('€ Venta') }}</td>
                    <td class="w-1/12 pr-3 text-right ">{{ __('Unidades') }}</td>
                    <td class="w-4/12 pl-3 ">{{ __('Ud') }} </td>
                    <td class="w-4/12 pl-3 ">{{ __('Observaciones') }} </td>
                    <td colspan="3" class=""></td>
                </tr>
            </thead>
            <tbody>
                @forelse ($presupacciones as $presupaccion)
                    <tr class="py-0 my-0">
                        <td><input type="checkbox" value="{{ $presupaccion->visible }}" {{ $presupaccion->visible==true ? 'checked' : ''  }} wire:change="changeVisible({{ $presupaccion }},$event.target.value)"
                            class="py-1 ml-4 text-xs border-gray-300 rounded-sm shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                        <td><input type="text" value="{{ $presupaccion->orden }}" wire:change="changeOrden({{ $presupaccion }},$event.target.value)"
                            class="w-full py-1 text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                        <td><input type="text" value="{{ $presupaccion->descripcion }}" wire:change="changeDescripcion({{ $presupaccion }},$event.target.value)"
                            class="w-full py-1 text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                        <td>
                            <input type="text" value="{{ $accion=="Material" ? $presupaccion->producto->referencia ?? '-' : $presupaccion->accion->referencia ?? '-'  }}"
                            class="w-full py-1 text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                        <td><input type="text" value="{{ $presupaccion->preciocoste }}"
                            class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly/></td>
                        <td><input type="text" value="{{ $presupaccion->ratio }}"
                            class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" readonly/></td>
                        <td><input type="text" value="{{ $presupaccion->precioventa }}" wire:change="changeVenta({{ $presupaccion }},$event.target.value)"
                            class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                        <td><input type="text" value="{{ $presupaccion->unidades }}" wire:change="changeUnidades({{ $presupaccion }},$event.target.value)"
                            class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" /></td>
                        <td><input type="text" value="{{ $presupaccion->observaciones }}" wire:change="changeObs({{ $presupaccion }},$event.target.value)"
                            class="w-full py-1 text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/></td>
                        <td>
                            <div class="flex items-center justify-center">
                                <x-icon.delete-a wire:click.prevent="delete({{ $presupaccion->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"  title="Eliminar linea"/>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="">
                        <td colspan="10" class="text-center ">
                            <div class="mx-2 bg-yellow-200 rounded">
                            {{-- <span class="px-2 py-5 mx-2 text-base font-medium text-gray-500"> --}}
                                No hay {{ $accion }} en el presupuesto
                            {{-- </span> --}}
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            {{-- <tfoot class="font-bold ">
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
            </tfoot> --}}
        </table>
    </div>
</div>
