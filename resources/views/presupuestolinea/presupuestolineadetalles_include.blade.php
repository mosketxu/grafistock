<div class="mx-1 mb-1 bg-white border border-blue-500 rounded-md shadow-md  {{ $presupacciones->count()>0 ? 'bg-blue-100' : 'bg-white' }}">
    <div class="mx-2 ">
        <div class="flex flex-row mt-1 ml-3 border-b-2">
            <div class="flex w-8/12">
                <h3 class="font-semibold w-36 ">{{ $acciontipo->nombre }}</h3>
                <x-icon.plus-a  href="{{route('presupuestolinea.create',[$presuplinea,$acciontipo->id])}}" class="pl-1 ml-3 w-7 h-7"  title="'Añadir línea"/>
            </div>
            <div class="w-1/12 text-base">
            </div>
            <div class="w-4/12 text-base">
                <div class="flex flex-row-reverse justify-between">
                    <div class="mr-2 text-right ">
                        € Ventas : {{ $presupacciones->sum('precioventa') }}
                    </div>
                    <div class="mr-2 text-right ">
                        Unidades : {{ $presupacciones->sum('unidades') }}
                    </div>
                    <div class="mr-2 text-right">
                        € Compra : {{ $presupacciones->sum('preciocoste') }}
                    </div>
                </div>
            </div>
        </div>
        <table table class="min-w-full mb-1 text-xs {{ $presupacciones->count()>0 ? 'bg-blue-50' : 'bg-white' }}">
            <tbody>
                @foreach ($presupacciones as $presupaccion)
                    @if ($loop->first)
                    <tr>
                        <td class="w-12 pl-3">{{ __('Orden') }}</td>
                        @if ($presupaccion->acciontipo->nombrecorto=="IMP")
                        <td class="w-12 pl-3">{{ __('Cat.Emp') }}</td>
                        @endif
                        <td class="pl-3 ">{{ __('Descr.Presupuesto') }} </td>
                        <td class="pl-3 ">{{ $presupaccion->acciontipo->nombrecorto=="MAT" ? 'Producto' : 'Acción' }} </td>
                        <td class="pl-3 ">{{ __('Ref.') }} </td>
                        <td class="w-24 pr-3 text-right ">{{ __('€ Compra/Ud') }}</td>
                        <td class="w-20 pr-3 text-right ">{{ __('€ Venta/Ud') }}</td>
                        <td class="w-16 pr-3 text-right ">{{ __('Uds.') }}</td>
                        @if ($presupaccion->acciontipo->nombrecorto!="MAT")
                            <td class="w-16 pr-3 text-right ">{{ __('Mins.') }}</td>
                        @endif
                        <td class="w-16 pr-3 text-right ">{{ __('Ancho') }}</td>
                        <td class="w-16 pr-3 text-right ">{{ __('Ancho') }}</td>
                        @if ($presupaccion->acciontipo->nombrecorto=="MAT")
                            <td class="w-16 pr-3 text-right ">{{ __('Factor') }}</td>
                            <td class="w-16 pr-3 text-right ">{{ __('Merma') }}</td>
                        @endif
                        <td class="w-20 pr-3 text-right ">{{ __('Unidades') }}</td>
                        <td class="w-20 pr-3 text-right ">{{ __('€ Ventas') }}</td>
                        <td  class="w-10"></td>
                    </tr>
                    @endif
                    <tr class="py-0 my-0">
                        <td>
                            <input type="text" value="{{ $presupaccion->orden }}" wire:change="changeValor({{ $presupaccion }},'orden','concalculo',$event.target.value)"
                            class="w-full py-1 text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                        </td>
                        @if ($presupaccion->acciontipo->nombrecorto=="IMP")
                            <td>
                                <input type="text" value="{{ $presupaccion->empresatipo->nombrecorto?? '-' }}"
                                class="w-full py-1 text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                disabled/>
                            </td>
                        @endif
                        <td>
                            <input type="text" value="{{ $presupaccion->descripcion }}" wire:change="changeValor({{ $presupaccion }},'descripcion','sincalculo',$event.target.value)"
                            class="w-full py-1 text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                        </td>
                        <td>
                            @if($acciontipo->nombre=="Material")
                                <div class="flex">
                                    @if ($presupaccion->producto->favorito=='1')
                                        <x-icon.star-solid class="text-yellow-500"></x-icon.star-solid>
                                    @endif
                                        <input type="text" value="{{ $presupaccion->producto->descripcion ?? ''   }}"
                                        class="w-full py-1 text-xs bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        readonly/>
                                </div>
                            @else
                                <input type="text" value="{{ $presupaccion->accion->descripcion ?? '-'  }}"
                                class="w-full py-1 text-xs bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                readonly/>
                            @endif
                        </td>
                        <td>
                            <input type="text" value="{{ $acciontipo->nombre=="Material" ? $presupaccion->producto->referencia ?? '-' : $presupaccion->accion->referencia ?? '-'  }}"
                            class="w-full py-1 text-xs bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            readonly/>
                        </td>
                        <td>
                            <input type="number" step="any" value="{{ $presupaccion->preciocoste_ud }}" wire:change="changeValor({{ $presupaccion }},'preciocoste_ud','concalculo',$event.target.value)"
                            class="w-full py-1 text-xs text-right {{ $presupaccion->deshabilitadoColorpCoste }} border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            {{ $presupaccion->deshabilitadoPcoste }}/>
                        </td>
                        <td><input type="number" step="any" value="{{ $presupaccion->precioventa_ud }}" wire:change="changeValor({{ $presupaccion }},'precioventa_ud','concalculo',$event.target.value)"
                            class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            />
                        </td>
                        <td>
                            <input type="text" value="{{ $presupaccion->unidadpreciocoste->nombre }} "
                            class="w-full py-1 text-xs text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            disabled/>
                        </td>
                        @if ($presupaccion->acciontipo->nombrecorto!="MAT")
                            <td>
                                <input type="number" step="any" value="{{ $presupaccion->minutos }}" wire:change="changeValor({{ $presupaccion }},'minutos','concalculo',$event.target.value)"
                                class="w-full py-1 text-xs text-right {{ $presupaccion->minutos_color[0] }} border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                {{ $presupaccion->minutos_color[1] }}/>
                            </td>
                        @endif
                        <td>
                            <input type="number" step="any" value="{{ $presupaccion->ancho }}" wire:change="changeValor({{ $presupaccion }},'ancho','concalculo',$event.target.value)"
                            class="w-full py-1 text-xs text-right {{ $presupaccion->anchoalto_color[0] }} border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            {{ $presupaccion->anchoalto_color[1] }}/>
                        </td>
                        <td>
                            <input type="number" step="any" value="{{ $presupaccion->alto }}" wire:change="changeValor({{ $presupaccion }},'alto','concalculo',$event.target.value)"
                            class="w-full py-1 text-xs text-right {{ $presupaccion->anchoalto_color[0] }} border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            {{ $presupaccion->anchoalto_color[1] }}/>
                        </td>
                        @if ($presupaccion->acciontipo->nombrecorto=="MAT")
                            <td>
                                <input type="text" value="{{ $presupaccion->factor }}" wire:change="changeValor({{ $presupaccion }},'factor','concalculo',$event.target.value)"
                                class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                            </td>
                            <td>
                                <input type="text" value="{{ $presupaccion->merma }}" wire:change="changeValor({{ $presupaccion }},'merma','concalculo',$event.target.value)"
                                class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                            </td>
                        @endif

                        <td>
                            <input type="number" step="any" value="{{ $presupaccion->unidades }}" wire:change="changeValor({{ $presupaccion }},'unidades','concalculo',$event.target.value)"
                            class="w-full py-1 text-xs text-right border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                        </td>
                        <td>
                            <input type="text" value="{{ number_format($presupaccion->precioventa,2,',','.')  }}"
                            class="w-full py-1 text-xs font-bold text-right bg-gray-100 border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" disabled/>
                        </td>
                        <td>
                            <div class="flex">
                                <div class="flex items-center justify-center">
                                    @if( $showEdit)
                                    <x-icon.edit-a wire:click.prevent="edit({{ $presupaccion }})" class="pl-1"  title="Editar linea"/>
                                    @endif
                                    <x-icon.copy-a wire:click="replicateRow({{ $presupaccion }})" onclick="confirm('¿Estás seguro de querer copiar la linea?') || event.stopImmediatePropagation()" class="text-purple-500" title="Copiar Presupuesto" />
                                    @if($presupaccion->fichero)
                                        <x-icon.download wire:click="presentaficheroexterno({{ $presupaccion->id }})" title="Fichero Externos"/>
                                    @endif
                                    </div>
                                <div class="flex items-center justify-center">
                                    <x-icon.delete-a wire:click.prevent="delete({{ $presupaccion->id }})" onclick="confirm('¿Estás seguro?') || event.stopImmediatePropagation()" class="pl-1"  title="Eliminar linea"/>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
