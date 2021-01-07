@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/gruas.css')}}">
    <title>@isset($grua){{$grua}}@endisset :: BITÁCORA</title>
    <style>

    </style>
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="grua-titulo">
                        <h2><b>REACH STACKER KALMAR B220</b></h2>
                    </div>
                    <div class="grua-imagen"></div>
                </div>
                <div class="col-sm-6">
                    <div class="grua-tab">
                        <div class="tab">
                            <button class='enlaces activo' onclick='abrir(event, "mantenimiento");'>MANTENIMIENTO</button>
                            <button class='enlaces' onclick='abrir(event, "historial");'>HISTORIAL</button>
                            <button class='enlaces' onclick='abrir(event, "datos");'>DATOS TECNICOS</button>
                            <button class='enlaces' onclick='abrir(event, "manuales");'>MANUALES</button>
                        </div>
                        <div id="mantenimiento" class="contenido" style="display: block;">
                            <table border="1">
                                <tbody>
                                    <tr>
                                        <td>Fecha del último servicio: </td>
                                        <td>10/02/2020</td>
                                    </tr>
                                    <tr>
                                        <td>Horas de uso: </td>
                                        <td>100 hrs.</td>
                                    </tr>
                                    <tr>
                                        <td>Cambio de piezas: </td>
                                        <td>Lineas, Neumáticos</td>
                                    </tr>
                                    <tr>
                                        <td>Cambio de aceite</td>
                                        <td>Si</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="datos" class="contenido" style="display: none;">
                            <p><b>Lorem</b> ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                        </div>
                        <div id="manuales" class="contenido" style="display: none;">
                        </div>
                        <div id="historial" class="contenido" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
