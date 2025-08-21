
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN | @yield('titulo')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plantilla_admin/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('plantilla_admin/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('plantilla_admin/archivos/font_awesone.css') }}">
    <link href="{{ asset('plantilla_admin/archivos/datatables.css') }}" rel="stylesheet">


    <style>
        #error_color{
            color:rgb(255, 0, 51);
            margin-bottom: 2px;
        }
        #success_color{
            color:rgb(16, 94, 0);
            margin-bottom: 2px;
        }

        /* Estilos para los campos deshabilitados */
        .formularios_des [disabled] {
            background-color: #295bff28; /* Color de fondo para campos deshabilitados */
            color: #ffffffce; /* Color del texto para campos deshabilitados */
            cursor: not-allowed; /* Cambiar el cursor al estar sobre campos deshabilitados */
        }

        .swal2-confirm-btn {
            margin-right: 10px; /* Ajusta el margen derecho entre los botones */
        }

        .swal2-cancel-btn {
            margin-left: 10px; /* Ajusta el margen izquierdo entre los botones */
        }
    </style>


