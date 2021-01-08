<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=760, initial-scale=0.4">
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
        <div class="header-contenedor">
            <div class="gonavi-logo">
                <img src="{{asset('img/gonavi.png')}}" width="300px" height="69px" alt="Logo de Gonavi">
            </div>
            <div class="bitacora-logo">
                <img src="{{asset('img/bitacora.png')}}" width="250px" height="69px" alt="Logo de Bitátoca">
            </div>
        </div>
        {{-- <div class="header-menu">
            <a class="header-menu-boton" href="#"></a>
            <div class="header-menu-opciones">
                <ul>
                    <li><a href="">INICIO</a></li>
                    <li><a href="">GRÚAS</a></li>
                    <li><a href="">MANTENIMIENTO</a></li>
                </ul>
            </div>
        </div> --}}
    </header>
    @yield('cuerpo')
</body>
</html>


