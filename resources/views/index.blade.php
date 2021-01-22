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
    <link rel="stylesheet" type="text/css"  media="screen" href="{{asset('css/index.css')}}">
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
    </header>
    <section>
        <div class="container">
            <div class="centrado">
                <div class="block-section">
                    <label for="busqueda">Buscar grúas por:</label>
                    <form method="POST" action="{{url('busqueda')}}">
                        @csrf
                        <input type="search" class="busqueda" name="busqueda" id="busqueda" placeholder="MODELO...">
                        <input type="submit" class="lupa" value="">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
            <div class="centrado">
                <input type="submit" class="boton-catalogo" value="CATÁLOGO DE GRÚAS" onclick="window.location.assign('{{url('busqueda')}}');">
                <input type="submit" class="boton-catalogo-verde" value="MENÚ" onclick="window.location.assign('{{url('menu')}}');">
            </div>
    </footer>
</body>
</html>


