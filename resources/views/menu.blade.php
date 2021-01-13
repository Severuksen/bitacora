@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/menu.css')}}">
    <title>MENU :: BITÁCORA</title>
    @yield('menuestilo')
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            <label>MENÚ DE OPCIONES</label>
        </div>
    </section>
    <section class="container">
        <div class="grua-tab">
            <div class="tab">
                <button class='enlaces' id="gruas" onclick="window.location.assign('{{url('menu/gruas')}}')">GRÚAS</button>
                <button class='enlaces' id="mantenimiento" onclick="window.location.assign('{{url('menu/mantenimiento')}}')">MANTENIMIENTO</button>
                <button class='enlaces' id="datos" onclick="window.location.assign('{{url('menu/datos')}}')">DATOS TECNICOS</button>
                <button class='enlaces' id="manuales" onclick="window.location.assign('{{url('menu/manuales')}}')">MANUALES</button>
            </div>
            @yield('div')
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="centrado">
                <div class="block-section">
                    <input type="submit" class="boton-catalogo" value="REGRESAR" onclick="window.location.assign('{{route('index')}}');">
                </div>
            </div>
        </div>
    </footer>
@endsection
