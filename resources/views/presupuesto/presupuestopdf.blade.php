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
            <table width="100%" style="margin-top:10px" cellspacing="0">
                <tr>
                    <td>
                        <img src="{{asset('img/encabezado presupuesto_baja.png')}}" width="720px"><br>
                    </td>
                </tr>
            </table>
        </header>
        <!-- Wrap the content of your PDF inside a main tag -->
        <main style="margin-top:140px; margin-right: 10px;">
            <table width="100%" style="margin-top:10px">
                <tr>
                    <td style="padding-left:3px;" width="50%"><h1 style="color: rgb(182, 177, 177); font-size:30px">Presupuesto</h1></td>
                </tr>
            </table>

            {{-- detalle del presupuesto --}}
            <table width="100%" style="margin-top:10px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220); font-size:9px;">
                    <td width=40% style="padding-left:3px;" >Comercial</td>
                    <td width=20% style="padding-left:3px;" >Nº presup.</td>
                    <td width=10% style="padding-righ:3px;" >Ref.GRA</td>
                    <td width=10% style="padding-left:3px;" >Ref.CLI</td>
                    <td width=10% style="padding-left:3px;" >Fecha</td>
                </tr>
                <tr style="background-color: #fdf9f9; font-size:10px;">
                    <td width=40%  style="padding-left:3px;" >{{ $presupuesto->solicitante->name }}/{{ $presupuesto->solicitante->email }}</td>
                    <td width=20%  style="padding-left:3px;text-align:center" >{{ $presupuesto->presupuesto }}</td>
                    <td width=10%  style="padding-left:3px;" >{{ $presupuesto->refgrafitex }} </td>
                    <td width=10%  style="padding-left:3px;" >{{ $presupuesto->refcliente }} </td>
                    <td width=10%  style="padding-righ:60px;margin-righ:6px;text-align:right" >{{ \Carbon\Carbon::parse($presupuesto->fechapresupuesto)->format('d-m-Y') }} &nbsp;</td>
                </tr>
            </table>

            <table width="100%" style="margin-top:10px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220); font-size:9px;">
                    <td width=40% style="padding-left:3px;" >Cliente</td>
                    <td width=20% style="padding-left:3px;" >A la Att.de </td>
                    <td width=10% style="padding-righ:3px;" >Tel/@</td>
                </tr>
                <tr style="background-color: #fdf9f9; font-size:10px;">
                    <td width=30%  style="padding-left:3px;" >
                        {{ $presupuesto->entidad->entidad }}<br>
                        {{ $presupuesto->entidad->direccion }}
                        {{ $presupuesto->entidad->cp }}{{ $presupuesto->entidad->localidad }} ({{ $presupuesto->entidad->localidad }})
                    </td>
                    <td width=30%  style="padding-left:3px;" >{{ $presupuesto->contacto->contacto }}</td>
                    <td width=30%  style="padding-left:3px;" >{{ $presupuesto->contacto->telefono }} <br>{{ $presupuesto->contacto->movil }} <br>{{ $presupuesto->contacto->email }} </td>
                </tr>
            </table>
            {{-- Descripción general --}}
            <table width="100%" style="margin-top:20px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220); font-size:9px;">
                    <td style="padding-left:3px;" width="55%">Descripción</td>
                    <td style="text-align:right;" width="15%">P.V.Unitario</td>
                    <td style="text-align:right;" width="15%">Cantidad</td>
                    <td style="text-align:right;" width="15%">Totales</td>
                </tr>
            {{-- </table> --}}

            {{-- Lineas --}}
            @if ($presupuesto->presupuestolineasvisibles->count()>0)
                {{-- <table width="100%" style=""> --}}
                    @foreach ( $presupuesto->presupuestolineasvisibles as $presupuestolinea )
                    <tr style="border-bottom-style: solid; font-size:10px;">
                        <td style="border-bottom-style: solid ;border-width:thin;border-color:rgb(163, 161, 161); padding-left:3px; rgb(223, 218, 218);" >
                            {{ $presupuestolinea->descripcion }}
                        </td>
                        <td style="border-bottom-style: solid ;border-width:thin;border-color: rgb(163, 161, 161); text-align:right; rgb(223, 218, 218);">
                            {{ number_format($presupuestolinea->precioventa / $presupuestolinea->unidades ,2) }} €
                        </td>
                        <td style="border-bottom-style: solid ;border-width:thin;border-color:rgb(163, 161, 161); text-align:right; rgb(223, 218, 218);">
                            {{ number_format($presupuestolinea->unidades,2) }}
                        </td>
                        <td style="border-bottom-style: solid ;border-width:thin;border-color: rgb(163, 161, 161); text-align:right; rgb(223, 218, 218);">
                            {{ number_format($presupuestolinea->precioventa,2) }} €
                        </td>
                    </tr>
                    @endforeach
            {{-- </table> --}}
            @endif
            {{-- Totales --}}
            {{-- <table width="100%" style=""> --}}
            @if($totales=='con')
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220); font-size:9px;">
                    <td style="padding-left:3px;">&nbsp;</td>
                    <td style="text-align:right;">Base Imponible</td>
                    <td style="text-align:right;">% I.V.A</td>
                    <td style="text-align:right;">Total  IVA incl.</td>
                </tr>
                <tr style="background-color: #E5E8E8; font-size:10px;">
                    <td style="border-bottom-style: solid ;border-width:thin;border-color:rgb(163, 161, 161); padding-left:3px; rgb(223, 218, 218);" >
                    </td>
                    <td style="text-align:right; border-bottom-style: solid ;border-width:thin;border-color:rgb(163, 161, 161); padding-left:3px; rgb(223, 218, 218);" >
                        {{ number_format($presupuesto->presupuestolineasvisibles->sum('precioventa'),2) }} €
                    </td>
                    <td style="text-align:right; border-bottom-style: solid ;border-width:thin;border-color:rgb(163, 161, 161); padding-left:3px; rgb(223, 218, 218);" >
                        {{ number_format($presupuesto->presupuestolineasvisibles->sum('precioventa') * $presupuesto->iva,2) }} €
                    </td>
                    <td style="text-align:right; border-bottom-style: solid ;border-width:thin;border-color:rgb(163, 161, 161); padding-left:3px; rgb(223, 218, 218);" >
                        {{ number_format($presupuesto->presupuestolineasvisibles->sum('precioventa')*(1+$presupuesto->iva),2)  }} €
                    </td>
                </tr>
            @else
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220); font-size:9px;">
                    <td style="padding-left:3px;"></td>
                    <td style="text-align:right;"></td>
                    <td style="text-align:right;"></td>
                    <td style="text-align:right;">IVA no incluido</td>
                </tr>
            @endif
            <tr style="font-size:9px;">
                <td style="padding-left:3px;" width="90%">Debido a la situación actual de materiales, cualquier presupuesto ofertado tendrá una validez máxima de 15 días.</td>
            </tr>

            </table>

            {{-- Obs y firma --}}
            <table width="100%" style="margin-top:20px">
                <tr style="color:rgb(10, 153, 220) font-size:9px;">
                    <td style="padding-left:3px;" width="60%">Observaciones</td>
                    <td style="text-align:right;" width="10%"></td>
                    <td style="text-align:right;" width="30%">Firma Vº.Bº.</td>
                </tr>
                <tr style=" font-size:10px;">
                    <td style="border-top-style: solid ;border-width:thin;border-color:rgb(163, 161, 161); padding-left:3px; rgb(223, 218, 218);" width="65%" >{{$presupuesto->observaciones}}</td>
                    <td style=" text-align:right; rgb(223, 218, 218);" width="10%"></td>
                    <td style="border-top-style: solid ;border-width:thin;border-color:rgb(163, 161, 161); text-align:right; rgb(223, 218, 218);" width="30%"></td>
                </tr>
            </table>
        </main>
    </body>

</html>

