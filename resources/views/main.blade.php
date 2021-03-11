<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=760, minimum-scale=0.3, maximum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="application/ecmascript" src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script type="application/ecmascript" src="{{asset('js/func.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css"  media="screen" href="{{asset('css/main.css')}}">
    @yield('titulo')
    <title>BITACORA :: PÁGINA PRINCIPAL</title>
</head>
<body>
    <header>
        <div class="header-main-contenedor">
            <div class="header-main-icono">
                <div class="header-main-logo"></div>
            </div>
            <div class="header-main-menu" id="header-main-menu">
                <a class="icono-barras" id="menu">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="{{route('index')}}">BÚSQUEDA</a>
                <a href="{{url('/busqueda')}}">CATÁLOGO</a>
                <a href="{{url('/menu/gruas')}}">GRUAS</a>
                <a href="{{url('/menu/mantenimiento')}}">MANTENIMIENTO</a>
                <a href="{{url('/menu/manuales')}}">MANUALES</a>
            </div>
        </div>
    </header>
    @yield('cuerpo')
</body>
</html>
