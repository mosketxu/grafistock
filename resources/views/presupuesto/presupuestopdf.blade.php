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
                    <td width="55%" style="padding:0px;margin:0px; text-align:left">
                        <img src="{{asset('img/GRAFITEXlogoConNombre.png')}}" width="120px"><br>
                        <span style="font-size: 8px">
                            FERROCARRILS CATALANS, 103-107<br>
                            08038 BARCELONA</span>
                    </td>
                    <td width="25%" style="padding:0px;margin-right:5px; text-align:right">
                        <span style="font-size: 8px; font-weight: bold">
                            Teléfono<br>
                            93 200 73 22<br>
                            grafitex@grafitex.net</span>
                    </td>
                    <td width="10%" style="padding:0px;margin-right:5px; text-align:center">
                        <img src="{{asset('img/BuenasPracticasAmbientales_sinTexto.png')}}" width="50px">
                    </td>
                    <td width="10%" style="padding:0px;margin:0px;text-align:center">
                        <img src="{{asset('img/GRAFITEXqr-code.png')}}" width="50px"><br>
                        <span style="font-size: 8px; font-weight: bold;text-align:center">
                            www.grafitex.net</span>
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
            {{-- datos cliente  --}}
            {{-- <table width="100%" style="text-align:left;margin-left:40px" cellspacing="0">
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
        </table> --}}

            {{-- detalle del presupuesto --}}

            {{-- <div style="margin-top:50px; ">
                <div>FECHA: {{ \Carbon\Carbon::parse($presupuesto->fechapresupuesto)->format('d-m-y') }}</div>
                <div>Presupuesto: {{ $presupuesto->presupuesto }}</div>
            </div> --}}
            <table width="100%" style="margin-top:10px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220); font-size:8px;">
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
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220); font-size:8px;">
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
                    <td width=30%  style="padding-left:3px;text-align:center" >{{ $presupuesto->presupuesto }}</td>
                    <td width=30%  style="padding-left:3px;" >{{ $presupuesto->refgrafitex }} </td>
                </tr>
            </table>
            {{-- Descripción general --}}
            <table width="100%" style="margin-top:20px">
                <tr style="background-color: #eee7e7; color:rgb(10, 153, 220)">
                        <td style="padding-left:3px;" width="70%">Descrip. Presupuesto</td>
                        <td style="padding-right:3px;text-align:right" width="15%">P.Venta</td>
                    </tr>
                    <tr >
                        <td style="padding-left:3px;border-bottom: 1px solid rgb(223, 218, 218);" >{{ $presupuesto->descripcion }}</td>
                        <td style="padding-right:3px;text-align:right;border-bottom: 1px solid rgb(223, 218, 218);">{{ $presupuesto->precioventa }} </td>
                    </tr>
        </table>

            {{-- Lineas --}}
            @if ($presupuesto->presupuestolineasvisibles->count()>0)
                <table width="100%" style="margin-top:20px">
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
            </table>
            @endif
        </main>
    </body>
</html>

