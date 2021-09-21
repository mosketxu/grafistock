<!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>{{ $pedido->pedido }}</title>
        <link rel="stylesheet" href="{{ asset('css/pdf.css')}}">

        {{-- sobreescribo margenes de pdf.css --}}
        <style>
            @page {margin: 20px 60px 20px 60px;}
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <div>
                <div>
                    <img src="{{asset('img/grafitexLogo.png')}}" width="50px">
                </div>
                <div>
                    <b>Grafitex Servicios Digitales, S.A</b><br>
                    Ferrocarrils Catalans, 103-107<br>
                    08038 Barcelona<br>
                    Tlf. 93.200.73.22
                </div>
           </div>
        </header>
        <footer>
            <div>
                <div>
                    <b>Grafitex Servicios Digitales, S.A</b> - CIF: A08875387
                    </div>
            </div>
        </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
        <main style="margin-top:140px; margin-right: 20px;">
            <div class="">
                <h1 style="color: gray">Orden de compra</h1>
            </div>
            {{-- datos cliente  --}}
            {{-- <table width="100%" style="text-align:left;margin-left:40px" cellspacing="0">
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
                    @if(strtolower($pedido->entidad->localidad) != strtolower($pedido->entidad->provincia->provincia))
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $pedido->entidad->codpostal }} {{ $pedido->entidad->provincia->provincia }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">Cif: {{ $pedido->entidad->nif  }}</td>
                    </tr>

                </tbody>
            </table> --}}

            {{-- detalle del pedido --}}

            {{-- <div style="margin-top:50px; ">
                <div>FECHA: {{ $pedido->fechapedido->format('d-m-Y') }}</div>
                <div>FACTURA: {{ $pedido->pedido }}</div>
            </div> --}}
            <table width="100%" style="margin-top:50px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                    <td style="padding-left:3px;" width="33%">Comercial</td>
                    <td style="text-align:center" width="33%">Nº.Pedido</td>
                    <td style="padding-righ:3px;text-align:right" width="33%">Fecha</td>
                </tr>
                <tr style="background-color: #fdf9f9; ">
                    <td style="padding-left:3px;" width="33%">{{ $pedido->solicitante->nombre }}</td>
                    <td style="text-align:center" width="33%">{{ $pedido->pedido }}</td>
                    <td style="padding-righ:3px;text-align:right" width="33%">{{ $pedido->fechapedido->format('d/m/Y') }}</td>
                </tr>
            </table>

            <table width="100%" style="margin-top:10px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                    <td style="padding-left:3px;" width="30%">Proveedor</td>
                    <td style="padding-left:3px;" width="15%">Población</td>
                    <td style="padding-left:3px;" width="15%">Tel</td>
                    <td style="padding-left:3px;" width="30%">@</td>
                </tr>
                <tr style="background-color: #fdf9f9; ">
                    <td style="padding-left:3px;" >{{ $pedido->entidad->entidad }}</td>
                    <td style="padding-left:3px;" >{{ $pedido->entidad->localidad }}</td>
                    <td style="padding-left:3px;" >{{ $pedido->entidad->tfno }} </td>
                    <td style="padding-left:3px;" >{{ $pedido->entidad->emailgral }} </td>
                </tr>
            </table>

            <table width="100%" style="margin-top:20px">
                <tbody>
                    <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                        {{-- <td style="padding-left:3px;" width="15%">Referencia</td> --}}
                        <td style="padding-left:3px;" width="55%">Descripción</td>
                        <td style="padding-right:3px;text-align:right" width="15%">P.Unitario</td>
                        <td style="padding-right:3px;text-align:right" width="15%">Cantidad</td>
                        <td style="padding-right:3px;text-align:right" width="15%">Total</td>
                    </tr>
                    @forelse ( $pedido->pedidodetalles as $detalle )
                        <tr >
                            {{-- <td style="padding-left:3px;font-size:xx-small;border-bottom: 1px solid rgb(223, 218, 218);" >{{ $detalle->producto->referencia }}</td> --}}
                            <td style="padding-left:3px;font-size:xx-small;border-bottom: 1px solid rgb(223, 218, 218);" >{{ $detalle->producto->descripcion }}</td>
                            <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $detalle->coste }} € </td>
                            <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $detalle->cantidad }} </td>
                            <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218)">
                                @if(is_numeric($detalle->cantidad) && is_numeric($detalle->coste))
                                    {{ number_format(round($detalle->cantidad*$detalle->coste, 2),2,',','.') }} €
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr colspan="4" style="background-color: #fdf9f9; ">
                            <td style="padding-left:3px;" width="100%">No hay detalle</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="font-bold divide-y divide-gray-200">
                    <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                        {{-- <td style="padding-left:3px;"></td> --}}
                        <td style="padding-left:3px;"></td>
                        <td style="padding-right:3px;text-align:right">Base Imponible</td>
                        <td style="padding-right:3px;text-align:right">% I.V.A</td>
                        <td style="padding-right:3px;text-align:right">Total IVA incl</td>
                    <tr style="background-color: #fdf9f9; ">
                        {{-- <td style="padding-left:3px;" ></td> --}}
                        <td style="padding-left:3px;" ></td>
                        <td style="padding-right:3px;text-align:right" >{{ number_format($base,2,',','.') }} €</td>
                        <td style="padding-right:3px;text-align:right" >{{ number_format($base * 0.21,2,',','.') }} €</td>
                        <td style="padding-right:3px;text-align:right" >{{ number_format($base * 1.21,2,',','.') }} €</td></tr>
                    </tr>
                </tfoot>
            </table>

            <table width="100%" style="margin-top:10px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                    <td style="padding-left:3px;" width="20%">Fecha Entrega</td>
                    <td style="padding-left:3px;" width="60%">Dirección Entrega</td>
                    <td style="padding-left:3px;" width="20%">Zona Entrega</td>
                </tr>
                <tr style="background-color: #fdf9f9; ">
                    <td style="padding-left:3px;" >{{ $pedido->fecharecepcionprevista ? $pedido->fecharecepcionprevista->format('d/m/Y') : '-' }}</td>
                    <td style="padding-left:3px;" >Grafitex - Av/ Ferrocarrils Catalans, 103-107 08038 Barcelona</td>
                    <td style="padding-left:3px;" >{{ $pedido->ubicacion->nombre ?? '-' }}</td>
                </tr>
            </table>
            <table width="100%" style="margin-top:10px;">
                <tr style=" color:rgb(10, 153, 220)">
                    <td style="padding-left:3px; border-top: 1px solid rgb(223, 218, 218); " width="100%">Horario de recepción de material:</td>
                </tr>
                <tr>
                    <td style="padding-left:3px;" >- Mañana de 8:00 a 13:00  </td>
                </tr>
                <tr>
                    <td style="padding-left:3px;" >- Tarde de 15:00 a 16:30  </td>
                </tr>
            </table>

            <table width="100%" style="margin-top:20px;">
                <tr style=" color:rgb(10, 153, 220)">
                    <td style="padding-left:3px; border-top: 1px solid rgb(223, 218, 218); " width="68%">Observaciones</td>
                    <td width="5%"></td>
                    <td style="padding-left:3px; border-top: 1px solid rgb(223, 218, 218); " width="27%">Firma Vº Bº</td>
                </tr>
                <tr>
                    <td style="padding-left:3px;" >{{ $pedido->observaciones }}</td>
                    <td style="padding-left:3px;" ></td>
                </tr>
            </table>

        </main>
    </body>


</html>

