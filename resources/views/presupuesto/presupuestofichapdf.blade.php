<!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>{{ $presupuesto->presupuesto }}</title>
        <link rel="stylesheet" href="{{ asset('css/pdf.css')}}">

        {{-- sobreescribo margenes de pdf.css --}}
        <style>
            @page {margin: 20px 40px 20px 40px;}
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
        <main style="margin-top:140px; margin-right: 10px;">
            <table width="100%" style="margin-top:10px">
                <tr>
                    <td style="padding-left:3px;" width="50%"><h1 style="color: gray">Nº Presupuesto: {{ $presupuesto->presupuesto }}</h1></td>
                    <td style="padding-right:3px;text-align:right;color:{{ $presupuesto->status_color[0] }};"><h1> {{ $presupuesto->status_color[1] }} </h1></td>
                </tr>
            </table>
            {{-- datos cliente  --}}
            {{-- <table width="100%" style="text-align:left;margin-left:40px" cellspacing="0">
                <tbody>
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $presupuesto->entidad->entidad  }}</td>
                    </tr>
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $presupuesto->entidad->direccion  }}</td>
                    </tr>
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $presupuesto->entidad->codpostal }} {{ $presupuesto->entidad->localidad }}</td>
                    </tr>

                    @if(strtolower($presupuesto->entidad->localidad) != strtolower($presupuesto->entidad->provincia->provincia ?? '-'))
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">{{ $presupuesto->entidad->provincia->provincia }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td width="49%"></td>
                        <td width="49%">Cif: {{ $presupuesto->entidad->nif  }}</td>
                    </tr>
                </tbody>
            </table> --}}

            {{-- detalle del presupuesto --}}

            {{-- <div style="margin-top:50px; ">
                <div>FECHA: {{ \Carbon\Carbon::parse($presupuesto->fechapresupuesto)->format('d-m-y') }}</div>
                <div>Presupuesto: {{ $presupuesto->presupuesto }}</div>
            </div> --}}
            <table width="100%" style="margin-top:10px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                    <td style="padding-left:3px;" >Comercial</td>
                    <td style="padding-left:3px;" >Cliente</td>
                    <td style="padding-righ:3px;text-align:right" >Fecha</td>
                    <td style="padding-left:3px;" >@</td>
                </tr>
                <tr style="background-color: #fdf9f9; ">
                    <td style="padding-left:3px;" ><span style="font-size: medium">{{ $presupuesto->solicitante->name }}</span></td>
                    <td style="padding-left:3px;" ><span style="font-size: medium">{{ $presupuesto->entidad->entidad }}</span></td>
                    <td style="padding-righ:3px;text-align:right" ><span style="font-size: medium">{{ \Carbon\Carbon::parse($presupuesto->fechapresupuesto)->format('d-m-y') }}</span></td>
                    <td style="padding-left:3px;" ><span style="font-size: medium">{{ $presupuesto->entidad->emailgral }} </span></td>
                </tr>
            </table>

            {{-- Descripción general --}}
            <table width="100%" style="margin-top:20px">
                <tbody>
                    <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                        <td style="padding-left:3px;" width="55%">Descrip. Presupuesto</td>
                        <td style="padding-right:3px;text-align:right" width="15%">P.Tarifa</td>
                        <td style="padding-right:3px;text-align:right" width="15%">Unidades</td>
                        <td style="padding-right:3px;text-align:right" width="15%">P.Venta</td>
                        <td style="padding-right:3px;text-align:right" width="15%">Creado</td>
                        <td style="padding-right:3px;text-align:right" width="15%">Actualizado</td>
                    </tr>
                    <tr >
                        <td style="padding-left:3px;border-bottom: 1px solid rgb(223, 218, 218);" >{{ $presupuesto->descripcion }}</td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuesto->preciotarifa }} € </td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuesto->unidades }} </td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuesto->precioventa }} </td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ \Carbon\Carbon::parse($presupuesto->created_at)->format('d-m-y') }} </td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ \Carbon\Carbon::parse($presupuesto->updated_at)->format('d-m-y') }} </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3>Detalles del presupuesto</h3>

            {{-- Lineas --}}
            <table width="100%" style="margin-top:20px">
                <tbody>
                    @forelse ( $presupuesto->presupuestolineas as $presupuestolinea )
                    <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                        <td colspan="4" style="padding-left:3px;" >Descrip. Partida</td>
                        <td style="padding-right:3px;text-align:right" >P.Tarifa</td>
                        <td style="padding-right:3px;text-align:right" >Unidades</td>
                        <td style="padding-right:3px;text-align:right" >P.Venta</td>
                        <td  colspan="5" style="padding-right:3px;text-align:right" >Observaciones</td>
                    </tr>
                    <tr >
                        <td colspan="4" style="padding-left:3px;border-bottom: 1px solid rgb(223, 218, 218);" >{{ $presupuestolinea->descripcion }}</td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->preciotarifa }} € </td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->unidades }} </td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->precioventa }}  €</td>
                        <td colspan="5" style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->observaciones }} </td>
                    </tr>
                    <tr >
                        <td style="font-weight: bold">Tipo</td>
                        <td style="font-weight: bold" colspan="2">Ref</td>
                        <td style="font-weight: bold" colspan="3">Descripcion</td>
                        <td style="font-weight: bold">€ Tarifa</td>
                        <td style="font-weight: bold">€ Venta</td>
                        <td style="font-weight: bold">F/Fmin</td>
                        <td style="font-weight: bold">Uds.</td>
                        <td style="font-weight: bold">Ancho x Alto</td>
                        <td style="font-weight: bold">Mts2</td>
                    </tr>
                    @foreach ($presupuestolinea->presupuestolineadetalles as $detalle)
                        <tr>
                            <td>{{ $detalle->acciontipo->nombre }}</td>
                            <td colspan="2">
                                @if($detalle->acciontipo_id=='1')
                                    {{ $detalle->producto->referencia }}
                                @else
                                    {{ $detalle->accion->descripcion }}
                                @endif
                            </td>
                            <td colspan="3">{{ $detalle->descripcion }}</td>
                            <td>{{ $detalle->preciotarifa }}</td>
                            <td>{{ $detalle->precioventa }} ({{ $detalle->unidadpreciotarifa->nombrecorto }})</td>
                            <td>{{ $detalle->factor }}/{{ $presupuesto->entidad->empresatipo->factormin }}</td>
                            <td>{{ $detalle->unidades }}</td>
                            <td>{{ $detalle->ancho }}x {{ $detalle->alto }}</td>
                            <td>{{ $detalle->metros2 }}</td>
                        </tr>
                        @if ($loop->last)
                        <tr>
                            <td colspan="12">
                                <hr>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    @empty
                        <tr colspan="4" style="background-color: #fdf9f9; ">
                            <td style="padding-left:3px;" width="100%">No hay detalle</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{--
                <tfoot class="font-bold divide-y divide-gray-200">
                    <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                        <td style="padding-left:3px;"></td>
                        <td style="padding-right:3px;text-align:right">Base Imponible</td>
                        <td style="padding-right:3px;text-align:right">% I.V.A</td>
                        <td style="padding-right:3px;text-align:right">Total IVA incl</td>
                    <tr style="background-color: #fdf9f9; ">
                        <td style="padding-left:3px;" ></td>
                        <td style="padding-right:3px;text-align:right" >{{ number_format($base,2,',','.') }} €</td>
                        <td style="padding-right:3px;text-align:right" >{{ number_format($base * 0.21,2,',','.') }} €</td>
                        <td style="padding-right:3px;text-align:right" >{{ number_format($base * 1.21,2,',','.') }} €</td></tr>
                    </tr>
                </tfoot>
            </table>

            {{-- <table width="100%" style="margin-top:10px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                    <td style="padding-left:3px;" width="20%">Fecha Entrega</td>
                    <td style="padding-left:3px;" width="60%">Dirección Entrega</td>
                    <td style="padding-left:3px;" width="20%">Zona Entrega</td>
                </tr>
                <tr style="background-color: #fdf9f9; ">
                    <td style="padding-left:3px;" >{{ $presupuesto->fecharecepcionprevista ? $presupuesto->fecharecepcionprevista->format('d/m/Y') : '-' }}</td>
                    <td style="padding-left:3px;" >Grafitex - Av/ Ferrocarrils Catalans, 103-107 08038 Barcelona</td>
                    <td style="padding-left:3px;" >{{ $presupuesto->ubicacion->nombre ?? '-' }}</td>
                </tr>
            </table> --}}
            {{-- <table width="100%" style="margin-top:10px;">
                <tr style=" color:rgb(10, 153, 220)">
                    <td style="padding-left:3px; border-top: 1px solid rgb(223, 218, 218); " width="100%">Horario de recepción de material:</td>
                </tr>
                <tr>
                    <td style="padding-left:3px;" >- Mañana de 8:00 a 13:00  </td>
                </tr>
                <tr>
                    <td style="padding-left:3px;" >- Tarde de 15:00 a 16:30  </td>
                </tr>
            </table> --}}

            {{-- <table width="100%" style="margin-top:20px;">
                <tr style=" color:rgb(10, 153, 220)">
                    <td style="padding-left:3px; border-top: 1px solid rgb(223, 218, 218); " width="68%">Observaciones</td>
                    <td width="5%"></td>
                    <td style="padding-left:3px; border-top: 1px solid rgb(223, 218, 218); " width="27%">Firma Vº Bº</td>
                </tr>
                <tr>
                    <td style="padding-left:3px;" >{{ $presupuesto->observaciones }}</td>
                    <td style="padding-left:3px;" ></td>
                </tr>
            </table> --}}

        </main>
    </body>


</html>

