<div class="mx-1 mb-1 bg-white border border-blue-500 rounded-md shadow-md  {{ $presupacciones->count()>0 ? 'bg-blue-100' : 'bg-white' }}">
    <div class="mx-2 ">
        <div class="flex flex-row mt-1 ml-3 border-b-2">
            <div class="flex w-8/12">
                <h3 class="font-semibold ">{{ $acciontipo->nombre }}</h3>
                {{-- <p>{{ Route::currentRouteName() }}</p> --}}
                {{-- @if(!request()->routeIs('presupuestolinea.create') ) --}}
                <x-icon.plus-a  href="{{route('presupuestolinea.create',[$presuplinea,$acciontipo->id])}}" class="pl-1 ml-3 w-7 h-7"  title="'Añadir línea"/>
                {{-- @endif --}}
            </div>
            <div class="w-4/12 text-base">
                <div class="flex flex-row-reverse justify-between">
                    <div class="mr-2 text-right ">
                        € Venta : {{ $presupacciones->sum('precioventa') }}
                    </div>
                    <div class="mr-2 text-right ">
                        Unidades : {{ $presupacciones->sum('unidades') }}
                    </div>
                    <div class="mr-2 text-right">
                        € Tarifa : {{ $presupacciones->sum('preciotarifa') }}
                    </div>
                </div>
            </div>
        </div>
        <table table class="min-w-full mb-1 text-xs {{ $presupacciones->count()>0 ? 'bg-blue-50' : 'bg-white' }}">
            <thead>
                <tr>
                    <td class="pl-3 text-center">{{ __('Visible') }}</td>
                    <td class="w-12 pl-3">{{ __('Orden') }}</td>
                    <td class="pl-3 ">{{ __('Descr.Prespuesto') }} </td>
                    <td class="pl-3 ">{{ __('Descripción') }} </td>
                    <td class="pl-3 ">{{ __('Ref.') }} </td>
                    <td class="w-20 pr-3 text-right ">{{ __('€ Tarifa/Ud') }}</td>
                    <td class="w-20 pr-3 text-right ">{{ __('€ Tarifa') }}</td>
                    <td class="w-16 pr-3 text-right ">{{ __('Ancho') }}</td>
                    <td class="w-16 pr-3 text-right ">{{ __('Ancho') }}</td>
                    <td class="w-20 pr-3 text-right ">{{ __('Mts 2') }}</td>
                    <td class="w-20 pr-3 text-right ">{{ __('Factor') }}</td>
                    <td class="w-20 pr-3 text-right ">{{ __('Unidades') }}</td>
                    <td class="w-20 pr-3 text-right ">{{ __('€ Venta') }}</td>
                    <td class="pl-3 ">{{ __('Observaciones') }} </td>
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
                        <td><input type="text" value="{{ $acciontipo->nombre=="Material" ? $presupaccion->producto->descripcion ?? '-' : $presupaccion->accion->descripcion ?? '-'  }}" readonly
                            class="w-full py-1 text-xs bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                        </td>
                        <td><input type="text" value="{{ $acciontipo->nombre=="Material" ? $presupaccion->producto->referencia ?? '-' : $presupaccion->accion->referencia ?? '-'  }}" readonly
                            class="w-full py-1 text-xs bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                        </td>
                        <td>
                            <input type="text" value="{{ $presupaccion->preciotarifa_ud }} {{ $presupaccion->unidadpreciotarifa->nombrecorto ?? '' }}"
                            class="w-full py-1 text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled/>
                        </td>
                        <td>
                            <input type="text" value="{{ $presupaccion->preciotarifa }} {{ $presupaccion->unidadpreciotarifa->nombrecorto ?? '' }}"
                            class="w-full py-1 text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled/>
                        </td>
                        @if($presupaccion->unidadpreciotarifa->nombrecorto=='m2' || $presupaccion->unidadpreciotarifa->nombrecorto=='pla')
                            <td><input type="text" value="{{ $presupaccion->ancho }}" wire:change="changeAncho({{ $presupaccion }},$event.target.value)"
                                class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                />
                            </td>
                            <td><input type="text" value="{{ $presupaccion->alto }}" wire:change="changeAlto({{ $presupaccion }},$event.target.value)"
                                class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                {{ ($presupaccion->unidadpreciotarifa->nombrecorto=='m2' || $presupaccion->unidadpreciotarifa->nombrecorto=='pla') ? '' : 'disabled'}}
                                />
                            </td>
                        @else
                            <td><input type="text" value="{{ $presupaccion->ancho }}" wire:change="changeAncho({{ $presupaccion }},$event.target.value)"
                                class="w-full py-1 text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                disabled/>
                            </td>
                            <td><input type="text" value="{{ $presupaccion->alto }}" wire:change="changeAlto({{ $presupaccion }},$event.target.value)"
                                class="w-full py-1 text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                disabled/>
                            </td>

                        @endif
                        <td><input type="text" value="{{ number_format($presupaccion->metros2,2,',','.') }}"
                            class="w-full py-1 text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled/>
                        </td>
                        <td><input type="text" value="{{ $presupaccion->factor }}" wire:change="changeFactor({{ $presupaccion }},$event.target.value)"
                            class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                        </td>
                        <td><input type="text" value="{{ $presupaccion->unidades }}" wire:change="changeUnidades({{ $presupaccion }},$event.target.value)"
                            class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                        </td>
                        <td><input type="text" value="{{ number_format($presupaccion->precioventa,2,',','.')  }}"
                            class="w-full py-1 text-xs font-bold text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled/>
                        </td>
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
                                No hay {{ $acciontipo->nombre }} en el presupuesto
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
