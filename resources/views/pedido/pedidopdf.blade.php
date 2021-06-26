<!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>{{ $pedido->pedido }}</title>
        <link rel="stylesheet" href="{{ asset('css/app.css')}}">

    </head>
    <body classpedidosm">
        <!-- Define header and footer blocks before your content -->
        <header>
            {{-- cabecera del formulario --}}
            <div>
                <table width="60%" style="margin:0 auto" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="24%"></td>
                            <td width="30%"><img src="{{asset('img/grafitexLogo.png')}}"  width="200"></td>
                            <td width="36%"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </header>

        <footer>
            <div>
                <table width="60%" style="margin:0 auto" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="10%"></td>
                            <td width="30%">Grafitex</td>
                            <td width="36%"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
        <main style="margin-top:140px; margin-right: 20px;">
            {{-- datos cliente  --}}
            <table width="100%" style="text-align:left;margin-left:40px" cellspacing="0">
                <tbody>
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $pedido->entidad->entidad  }}</td>
                    </tr>
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $pedido->entidad->direccion  }}</td>
                    </tr>
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $pedido->entidad->codpostal }} {{ $pedido->entidad->localidad }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><br></td>
                    </tr>
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $pedido->entidad->nif  }}</td>
                    </tr>

                </tbody>
            </table>

            {{-- detalle del pedido --}}

            <div style="margin-top:50px; ">
            {{-- Fecha y Pedido --}}
                <div>FECHA: {{ $pedido->fechapedido->format('d-m-Y') }}</div>
                <div>FACTURA: {{ $pedido->pedido }}</div>
            </div>

            <div class="flex-col">
                <table table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-left text-gray-500 bg-yellow-50 ">{{ __('Orden') }}</th>
                            <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-left text-gray-500 bg-yellow-50">{{ __('Producto') }} </th>
                            <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-left text-gray-500 bg-yellow-50">{{ __('Descripción') }} </th>
                            <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Uds.') }}</th>
                            <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Coste') }}</th>
                            <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Ud.Compra') }}</th>
                            <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Base (€)') }}</th>
                            <th class="py-3 text-xs font-medium leading-4 tracking-tighter text-right text-gray-500 bg-yellow-50">{{ __('Total (€)') }}</th>
                            <th colspan="2" class="py-3 text-xs font-medium leading-4 tracking-tighter text-center text-gray-500 bg-yellow-50"> </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pedido->pedidodetalles as $detalle)
                            <x-table.row wire:loading.class.delay="opacity-50">
                                <x-table.cell class="text-left">{{ $detalle->orden }}</x-table.cell>
                                <x-table.cell class="tracking-tighter text-left">{{ $detalle->producto->referencia }}</x-table.cell>
                                <x-table.cell class="tracking-tighter text-left">{{ $detalle->producto->descripcion }}</x-table.cell>
                                <x-table.cell class="text-right">{{ $detalle->cantidad }}</x-table.cell>
                                <x-table.cell class="text-right">{{ $detalle->coste }}</x-table.cell>
                                <x-table.cell class="text-right">{{ $detalle->unidadcompra->nombre ?? '-' }}</x-table.cell>
                                <x-table.cell class="text-right">
                                    @if(is_numeric($detalle->cantidad) && is_numeric($detalle->coste))
                                        {{ number_format(round($detalle->cantidad*$detalle->coste, 2),2,',','.') }}
                                    @endif
                                </x-table.cell>
                            </x-table.row>
                        @empty
                            <x-table.row>
                                <x-table.cell colspan="10">
                                        <x-icon.inbox class="w-8 h-8 text-gray-300"/>
                                        <span class="py-5 text-xl font-medium text-gray-500">
                                            No se han encontrado detalles...
                                        </span>
                                    </div>
                                </x-table.cell>
                            </x-table.row>
                        @endforelse
                    </tbody>
                    <tfoot class="font-bold divide-y divide-gray-200">
                        <tr>
                            <td class="pl-2"></td>
                            <td class="pl-2"></td>
                            <td class="pl-2 "></td>
                            <td class="pl-2">Total</td>
                            <td class="pr-2"></td>
                            <x-table.cell class="text-right">{{ number_format($base,2,',','.') }}</x-table.cell>
                            {{-- <x-table.cell class="text-right">{{ number_format($total,2,',','.') }}</x-table.cell> --}}
                        </tr>
                    </tfoot>
                </table>
            </div>
        </main>

    </body>
</html>

