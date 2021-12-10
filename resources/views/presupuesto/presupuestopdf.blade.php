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
                        <td style="padding-right:3px;text-align:right" width="15%">Unidades</td>
                        <td style="padding-right:3px;text-align:right" width="15%">P.Venta</td>
                    </tr>
                    <tr >
                        <td style="padding-left:3px;border-bottom: 1px solid rgb(223, 218, 218);" >{{ $presupuesto->descripcion }}</td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuesto->unidades }} </td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuesto->precioventa }} </td>
                    </tr>
                </tbody>
            </table>

            {{-- Lineas --}}
            @if ($presupuesto->presupuestolineasvisibles->count()>0)
                <table width="100%" style="margin-top:20px">
                    <tbody>
                        <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                            <td width="70%" style="padding-left:3px;" >Descrip. Partida</td>
                            <td style="padding-right:3px;text-align:right" >Unidades</td>
                            <td style="padding-right:3px;text-align:right" >P.Venta</td>
                        </tr>
                        @foreach ( $presupuesto->presupuestolineasvisibles as $presupuestolinea )
                            @if($presupuestolinea->visible)
                                <tr >
                                    <td style="padding-left:3px; rgb(223, 218, 218);" >{{ $presupuestolinea->descripcion }}</td>
                                    <td style="padding-right:3px;text-align:right; rgb(223, 218, 218);">{{ $presupuestolinea->unidades }} </td>
                                    <td style="padding-right:3px;text-align:right; rgb(223, 218, 218);">{{ $presupuestolinea->precioventa }}  €</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding-left:3px;text-align:left;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuestolinea->observaciones }} </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </main>
    </body>
</html>

