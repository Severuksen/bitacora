@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/gruas.css')}}">
    <title>@isset($modelo){{$modelo}}@endisset :: BITÁCORA</title>
    <style>

    </style>
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="grua-titulo">
                        <h2><b>@isset($modelo){{$tipo.' '.$modelo}}@endisset</b></h2>
                    </div>
                    <div class="grua-imagen" style="background-image: url('{{asset($img)}}');"></div>
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
                            <table>
                                <thead>
                                    <tr>
                                        <th width="200px"><b>Fecha del último servicio: </b></th>
                                        <th width="200px">@isset($fecha){{$fecha}}@endisset</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Horas de uso: </b></td>
                                        <td>@isset($horas){{$horas}}@endisset hrs.</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mantenimiento realizado: </b></td>
                                        <td>@isset($mantenimiento){{$mantenimiento}}@endisset</td>
                                    </tr>
                                    <tr>
                                        <td><b>Observaciones: </b></td>
                                        <td>@isset($observaciones){{$observaciones}}@endisset</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="historial" class="contenido" style="display: none;">

                        </div>
                        <div id="datos" class="contenido" style="display: none;">
                            <p><b>Lorem</b> ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                        </div>
                        <div id="manuales" class="contenido" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
