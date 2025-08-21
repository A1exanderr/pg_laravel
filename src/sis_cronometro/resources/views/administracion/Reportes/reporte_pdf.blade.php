<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE PDF</title>

    <style>
        .my-table {
            border-collapse: collapse;
            width: 100%;
        }
        .my-table th, .my-table td {
            border: 1px solid black;
            padding: 10px;
        }
        .my-table th {
            background-color: #f2f2f2;
        }

        #thead tr {
            position: sticky;
            top: 0;
            background-color: #fff; /* Agrega un fondo blanco para evitar que se mezcle con el contenido */
        }

        .table-container {
            position: relative;
            page: auto;
        }

        .table-container:not(:first-child) {
            page-break-before: always;
        }

        .thead-container {
            position: absolute;
            top: 0;
            left: 0;
        }

        .corner-image {
            position: absolute;
            top: 10px; /* Ajusta la posición vertical */
            left: 10px; /* Ajusta la posición horizontal */
        }



        /*para */
        .img-esquina {
            position: absolute;
            width: 90px;
        }

        .img-esquina-top-left {
            top: 0;
            left: 0;
        }

        .img-esquina-top-right {
            top: -20;
            right: -25px;
        }

        .formulario_esquina{
            position: absolute;
        }
        .form-esquina-top-rigth{
            top: -47;
            right: -25px;
        }

        .form-esquina-top-left{
            top: -60px;
            left: -30px;
        }

        .imagen-transparente {
            z-index: -1;
        }


        /**/
        .img_fondo {
            position: absolute;
            opacity: 0.8;
            top: 2%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            width: 70%;
        }

        .seccion {
            position: relative;
        }
        .text-primary{
            padding-top: 0px;
            margin-top: -18px;
        }
        .text-secundario{
            padding-top: 0px;
            margin-top: -12px;
        }
    </style>
</head>
<body>

    @php
        $img_logo = public_path('logos/gamch.jpg');
        $imagen_logo = 'data:image/png;base64,' . base64_encode(file_get_contents($img_logo));
        @endphp


        <div style="text-align: center; padding-top:5%">
            <h5 class="text-primary">GOBIERNO AUTONOMO MUNICIPAL DE CHULUMANI </h5>
            <h5 class="text-primary">"VILLA DE LA LIBERTAD"</h5>
            <h5>CAPITAL DE LA PROVINCIA - SUD YUNGAS GESTIÓN {{ date('Y') }} </h5>
            <h5 class="text-primary">{{ $tipo_carrera->descripcion }}</h5>
        </div>



        <img src="{{ $imagen_logo }}" class="img-esquina img-esquina-top-right imagen-transparente">

        <h5 class="formulario_esquina form-esquina-top-left" >Fecha de Impresión : {{ date('Y-m-d H:m:s') }}</h5>
        <h5 class="formulario_esquina form-esquina-top-rigth text-center" >GAMCH</h5>


    <div id="table-responsive" >
        <table class="my-table" style="width: 100%; font-size:9px" >
            <thead>
                <tr>

                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">NUMERO</th>
                        <th rowspan="2">COMUNIDAD</th>
                        <th colspan="2" class="text-center" >PILOTO</th>
                        <th colspan="2" class="text-center" >COPILOTO</th>
                        <th rowspan="2"> T/ PRIMERA CARRERA</th>
                        <th rowspan="2"> T/ SEGUNDA CARRERA</th>
                        <th rowspan="2">TIEMPO TOTAL</th>
                    </tr>
                    <tr>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                        <th>NOMBRES</th>
                        <th>APELLIDOS</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach ($listar_carrera as $lis)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lis->persona->placa }}</td>
                        <td>{{ $lis->persona->comunidad }}</td>
                        <td>{{ $lis->persona->nombres_piloto }}</td>
                        <td>{{ $lis->persona->ap_paterno_piloto.' '.$lis->persona->ap_materno_piloto }}</td>
                        <td>{{ $lis->persona->nombres_copiloto }}</td>
                        <td>{{ $lis->persona->ap_paterno_copiloto.' '.$lis->persona->ap_materno_copiloto }}</td>
                        <td>{{ $lis->suma_primero }}</td>
                        <td>{{ $lis->suma_segundo }}</td>
                        <td>{{ $lis->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
