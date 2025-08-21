<!DOCTYPE html>
<html lang="es">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    @include('plantilla.styles')
    @yield('stilos')
    <style>
        #error_color{
            color:red !important;
        }
    </style>
</head>

<body class="dashboard">

<div id="preloader">
    <i>.</i>
    <i>.</i>
    <i>.</i>
</div>

<div id="main-wrapper">


    @include('plantilla.header')

    @include('plantilla.menu')


    @yield('contenido')
</div>

@include('plantilla.scripts')
@yield('scripts')
</body>
</html>
