<div class="">
    @livewire('menu')
    <div class="p-1 mx-2">
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard Presupuestos
        </h1>
        <div class="py-1 space-y-4">
            @include('error')
        </div>
        {{-- filtros y boton --}}
        <div>
            <div class="flex justify-between">
                <div class="flex w-10/12 space-x-3">
                    @include('dashboard.presupuestosfilters')
                </div>
                <div class="flex flex-row-reverse w-2/12">
                    <div class="items-center text-xs">
                        <x-button.button  wire:click="exportEstadisticaPresupuestosXLS" color="green"><x-icon.xls/></x-button.button>
                    </div>
                </div>
            </div>
        </div>
        @if ($alerta)
            {{-- <div class="flex w-full space-x-3"> --}}
                <div id="alert" class="relative px-6 py-2 mb-2 text-white bg-red-200 border-red-500 rounded border-1">
                    <div class="mt-3 text-sm text-red-600 list-disc list-inside">
                        {{ $alerta }}
                    </div>
                    <button class="absolute top-0 right-0 mt-2 mr-6 text-2xl font-semibold leading-none bg-transparent outline-none focus:outline-none" onclick="document.getElementById('alert').remove();">
                        <span>×</span>
                    </button>
                </div>
            {{-- </div> --}}
            @endif

        {{-- tabla presupuestos --}}
        <div class="min-w-full mt-2 overflow-hidden overflow-x-auto align-middle shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="text-xs leading-4 tracking-wider text-gray-500 bg-blue-50 ">
                    <tr class="">
                        <th class="pl-4 font-medium text-left"><div class="flex">{{ __('Cliente') }}  &nbsp;<x-input.checkbox wire:model="ccliente"/></div> </th>
                        <th class="pl-4 font-medium text-left"><div class="flex">{{ __('Comercial') }}  &nbsp;<x-input.checkbox wire:model="ccomercial"/></div> </th>
                        <th class="pr-4 font-medium text-right"><div class="flex">{{ __('Mes/Año') }} &nbsp;<x-input.checkbox wire:model="mesanyo"/></div></th>
                        <th class="pr-4 font-medium text-right">{{ __('Nº Presups') }}</th>
                        <th class="pr-4 font-medium text-right">{{ __('Margen Bruto') }}</th>
                        <th class="pr-4 font-medium text-right">{{ __('Cifra Ventas') }}</th>
                        <th class="pr-4 font-medium text-left">{{ __('Estado') }}</th>
                    </tr>
                </thead>
                <tbody class="text-xs bg-white divide-y divide-gray-200">
                    @forelse ($presupuestos as $presupuesto)
                        <tr wire:loading.class.delay="opacity-50" >
                            <td>
                                @if($ccliente=='1')
                                <input type="text" value="{{ $presupuesto->entidad }}"
                                    class="w-full text-xs font-thin truncate border-0 rounded-md" readonly />
                                @endif
                            </td>
                            <td>
                                @if($ccomercial=='1')
                                <input type="text" value="{{ $presupuesto->comercial }}"
                                    class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md" readonly />
                                @endif
                            </td>
                            <td>
                                @if($mesanyo=='1')
                                <input type="text" value="{{ $presupuesto->month_year }}"
                                    class="w-full text-xs font-thin text-gray-500 truncate border-0 rounded-md" readonly />
                                @endif
                            </td>
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ $presupuesto->numpresups}}</span>
                            </td>
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ number_format($presupuesto->margenbruto,2)}}</span>
                            </td>
                            <td class="text-right">
                                <span class="pr-4 text-xs text-blue-500">{{ number_format($presupuesto->ventas,2)}}</span>
                            </td>
                            <td>
                                <span
                                    class="inline-flex items-center text-left px-2.5 py-0.5 rounded-full text-xs leading-4 bg-{{ $presupuesto->status_color[0] }}-100 text-green-800">
                                    {{ $presupuesto->status_color[1] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <div class="flex items-center justify-center">
                                    <x-icon.inbox class="w-8 h-8 text-gray-300" />
                                    <span class="py-5 text-xl font-medium text-gray-500">
                                        No se han encontrado resultados...
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="font-bold divide-y divide-gray-200">
                    <tr>
                        <td></td>
                        <td class="text-right">Totales</td>
                        <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">
                            {{ $presupuestos->sum('numpresups') }}
                        </td>
                        <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">
                            {{number_format(round($presupuestos->sum('margenbruto'),2),2) }}
                        </td>
                        <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">
                            {{number_format(round($presupuestos->sum('ventas'),2),2) }}
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">Promedios</td>
                        <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">
                            {{-- {{ $presupuestos->sum('numpresups') }} --}}
                        </td>
                        <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">
                            {{number_format(round($presupuestos->sum('margenbruto')/$presupuestos->sum('numpresups'),2),2) }}
                        </td>
                        <td class="w-24 pt-2 pr-4 text-sm text-right text-gray-600">
                            {{number_format(round($presupuestos->sum('ventas')/$presupuestos->sum('numpresups'),2),2) }}
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
