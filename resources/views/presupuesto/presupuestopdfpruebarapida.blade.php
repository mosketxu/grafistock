<!doctype html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <style>
            @page {margin: 20px 40px 20px 40px;}
        </style>
        <link rel="stylesheet" href="{{ asset('css/pdf.css')}}">

    </head>
        <body>
            <!-- Define header and footer blocks before your content -->
            <header>
                <table>
                    <tr>
                        <td>
                            <img src="{{asset('img/GRAFITEXlogoConNombre.png')}}" width="120px"><br>
                            <span>
                                FERROCARRILS CATALANS, 103-107<br>
                                08038 BARCELONA</span>
                        </td>
                        <td >
                            <span>
                                Teléfono<br>
                                93 200 73 22<br>
                                grafitex@grafitex.net
                            </span>
                        </td>
                        <td>
                            <img src="{{asset('img/BuenasPracticasAmbientales_sinTexto.png')}}" width="50px">
                        </td>
                        <td>
                            <img src="{{asset('img/GRAFITEXqr-code.png')}}" width="50px"><br>
                            <span>www.grafitex.net</span>
                        </td>
                    </tr>
                </table>
            </header>
            <!-- Wrap the content of your PDF inside a main tag -->
            <main>
                Main
            </main>
            <footer>
                Footer
            </footer>
        </body>

    </html>

