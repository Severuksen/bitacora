<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=760, initial-scale=0.4">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css"  media="screen" href="{{asset('css/main.css')}}">
    @yield('titulo')
    <title>BITACORA :: PÁGINA PRINCIPAL</title>
    <script>
        function abrir(evento, tabla) {
            var i, contenido, enlaces;
            contenido = document.getElementsByClassName("contenido");
            for (i = 0; i < contenido.length; i++){
                contenido[i].style.display = "none";
            }
            enlaces = document.getElementsByClassName("enlaces");
            for (i = 0; i < enlaces.length; i++){
                enlaces[i].className = enlaces[i].className.replace(" activo", "");
            }
            document.getElementById(tabla).style.display = "flex";
            evento.currentTarget.className += " activo";
        }
    </script>
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
    </header>
    @yield('cuerpo')
</body>
</html>

