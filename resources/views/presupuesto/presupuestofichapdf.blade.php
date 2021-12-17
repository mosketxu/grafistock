<!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Ficha {{ $presupuesto->presupuesto }}</title>
        <link rel="stylesheet" href="{{ asset('css/pdf.css')}}">

        {{-- sobreescribo margenes de pdf.css --}}
        <style>
            @page {margin: 20px 40px 20px 40px;}
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <table width="100%" style="margin-top:0px">
                <tr>
                    <td style="text-align: right;" width="60px">
                        <img src="{{asset('img/grafitexLogo.png')}}" width="50px">
                    </td>
                    <td style="text-align:left;color: #6b7280">
                        <b>Grafitex Servicios Digitales, S.A</b><br>
                        Ferrocarrils Catalans, 103-107<br>
                        08038 Barcelona<br>
                        Tlf. 93.200.73.22
                    </td>
                    <td style="padding-left:3px;" width="50%"><h1 style="color: gray">Ficha Presupuesto: {{ $presupuesto->presupuesto }}</h1></td>
                    <td style="padding-right:3px;text-align:right;color:{{ $presupuesto->status_color[0] }};"><h1> {{ $presupuesto->status_color[1] }} </h1></td>
                </tr>
            </table>
        </header>
        <footer>
            <div>
                <div>
                    <b>Grafitex Servicios Digitales, S.A</b> - CIF: A08875387
                    </div>
            </div>
        </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
        <main style="margin-top:100px; margin-right: 10px;">
            {{-- Datos generales  --}}
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
                    <tr style="background-color: #6cd0e2; color:rgb(60, 35, 128)">
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
                    <tr>
                        <td colspan= "6" style="padding-right:3px;text-align:left;border-bottom: 1px solid rgb(223, 218, 218);"><span style="font-style: bold"> Observaciones:</span> {{ $presupuesto->observaciones }} </td>
                    </tr>
                </tbody>
            </table>
            <br>
            {{-- Control partidas --}}
            @foreach ( $controlpartidaspendientes as $partida )
            @if ($loop->first)
                <span style="font-style: bold; margin-bottom: 5px; ">Partidas pendientes de calcular:</span>
            @endif
                {{ $partida->acciontipo->nombre }} &nbsp;
                @if (!$loop->last)
                    -
                @endif
            @endforeach


            <h3>Detalles del presupuesto</h3>

            {{-- Lineas --}}
            <table width="100%" style="">
                <tbody>
                    @foreach ( $presupuesto->presupuestolineas as $presupuestolinea )
                        <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                            <td colspan="7" style="padding-left:3px;" >Descrip. Partida</td>
                            <td style="padding-right:3px;text-align:right" >€ Tarifa</td>
                            <td style="padding-right:3px;text-align:right" >€ Venta</td>
                            <td style="padding-right:3px;text-align:right" >Unidades</td>
                            <td style="padding-right:3px;text-align:right" >P.Venta</td>
                        </tr>
                        <tr >
                            <td colspan="7" style="padding-left:3px;border-bottom: 1px solid rgb(223, 218, 218);" >{{ $presupuestolinea->descripcion }}</td>
                            <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->preciotarifa }}</td>
                            <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->precioventa }} € </td>
                            <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->unidades }} </td>
                            <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->precioventa }}  €</td>
                        </tr>
                        <tr>
                            <td style="padding-right:3px;text-align:left;border-bottom: 1px solid rgb(223, 218, 218);">Observaciones:</td>
                            <td colspan="10" style="padding-left:3px;text-align:left;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->observaciones }} </td>
                        </tr>
                        @foreach ($controlpartidasactivas as $partida )
                            <tr>
                                <td colspan="9">
                                    <span style="font-style: bold; text-decoration: underline "> Partida {{ $partida->acciontipo->nombre }} </span>
                                    <br>
                                </td>
                                @foreach ($partida->presupuesto->detalles as $detalle )
                                    @if ($loop->first)
                                        <tr >
                                            <td style="font-weight: bold" colspan="2">Ref</td>
                                            <td style="font-weight: bold" colspan="3">Descripcion</td>
                                            <td style="font-weight: bold;text-align:right;">€ Tarifa Ud</td>
                                            <td style="font-weight: bold;text-align:right;">€ Venta Ud</td>
                                            <td style="font-weight: bold;text-align:right;">F/Fmin</td>
                                            <td style="font-weight: bold;text-align:right;">Uds.</td>
                                            <td style="font-weight: bold;text-align:right;">€ Venta</td>
                                            <td style="font-weight: bold;text-align:right;">Ancho x Alto</td>
                                        </tr>
                                    @endif
                                    @if($detalle->acciontipo_id==$partida->acciontipo_id)
                                    <tr>
                                        <td colspan="2">
                                            @if($detalle->acciontipo_id=='1')
                                                {{ $detalle->producto->referencia }}
                                            @else
                                                {{ $detalle->accion->descripcion }}
                                            @endif
                                        </td>
                                        <td colspan="3">{{ $detalle->descripcion }}</td>
                                        <td style="text-align:right;">{{ $detalle->preciotarifa_ud }}</td>
                                        <td style="text-align:right;">{{ $detalle->precioventa_ud }}</td>
                                        <td style="text-align:right;">{{ $detalle->factor }}/{{ $presupuesto->entidad->empresatipo->factormin }}</td>
                                        <td style="text-align:right;">{{ $detalle->unidades }}</td>
                                        <td style="text-align:right;">{{ $detalle->precioventa }} </td>
                                        <td style="text-align:right;">{{ $detalle->ancho }}x {{ $detalle->alto }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><span style="font-style: italic; text-decoration: underline">Observaciones</span>: {{ $detalle->observaciones }}</td>
                                    </tr>
                                    @endif
                                    @if ($loop->last)
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="3"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align:right;color:#ffffff;background-color:#173777">Subtotal partida: </td>
                                        <td style="text-align:right;color:#ffffff;background-color:#173777">{{ $partida->presupuesto->detalles->where('acciontipo_id',$partida->acciontipo_id)->sum('precioventa') }} </td>
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </main>
    </body>
</html>

