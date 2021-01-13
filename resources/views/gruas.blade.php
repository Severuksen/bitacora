@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/gruas.css')}}">
    <title>@isset($servicios){{$servicios->mod_grua}}@endisset :: BITÁCORA</title>
    <style>

    </style>
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div class="grua-titulo">
                        <h2><b>@isset($servicios->tipo_grua){{$servicios->tipo_grua.' '.$servicios->mod_grua}}@endisset</b></h2>
                    </div>
                    <div class="grua-imagen" style="background-image: url('@isset($servicios->img)<?= $servicios->img ?>@endisset');"></div>
                </div>
                <div class="col-xs-6">
                    <div class="grua-tab">
                        <div class="tab">
                            <button class='enlaces activo' onclick='abrir(event, "mantenimiento");'>MANTENIMIENTO</button>
                            <button class='enlaces' onclick='abrir(event, "historial");'>HISTORIAL</button>
                            <button class='enlaces' onclick='abrir(event, "datos");'>DATOS TECNICOS</button>
                            <button class='enlaces' onclick='abrir(event, "manuales");'>MANUALES</button>
                        </div>
                        <div id="mantenimiento" class="contenido" style="display: flex;">
                            @if(isset($servicios) && !isset($mensaje))
                                <div class="container">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th width="200px"><b>Fecha del último servicio: </b></th>
                                                <th width="300px">@isset($servicios->fecha){{$servicios->fecha}}@endisset</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>Horas de uso: </b></td>
                                                <td>@isset($servicios->horas){{$servicios->horas}}@endisset hrs.</td>
                                            </tr>
                                            <tr>
                                                <td><b>Mantenimiento realizado: </b></td>
                                                <td>@isset($servicios->tipo_man){{$servicios->tipo_man}}@endisset</td>
                                            </tr>
                                            <tr>
                                                <td><b>Estado: </b></td>
                                                <td>@isset($servicios->estado){{$servicios->estado}}@endisset</td>
                                            </tr>
                                            <tr>
                                                <td><b>Observaciones: </b></td>
                                                <td>@isset($servicios->observaciones){{$servicios->observaciones}}@endisset</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            @elseif(isset($servicios) && isset($mensaje))
                                <div class="container">
                                    <label>{{$mensaje}}</label>
                                </div>
                            @endif
                        </div>
                        <div id="historial" class="contenido" style="display: none;">
                            <div class="container historial">
                                @isset($historial)
                                    @foreach($historial as $grua)
                                        <button onclick="historial(event);">@isset($grua->tipo_man){{strtoupper($grua->tipo_man)}}@endisset - @isset($grua->fecha){{$grua->fecha}}@endisset</button>
                                        <div class="info" style="display: none;">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th width="200px"><b>Fecha del servicio: </b></th>
                                                        <th width="200px" id='servicio'>@isset($grua->fecha){{$grua->fecha}}@endisset</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><b>Horas de uso: </b></td>
                                                        <td id='horas'>@isset($grua->horas){{$grua->horas}}@endisset hrs.</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Mantenimiento realizado: </b></td>
                                                        <td id='mantenimiento'>@isset($grua->tipo_man){{$grua->tipo_man}}@endisset</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Estado: </b></td>
                                                        <td id='estado'>@isset($grua->estado){{$grua->estado}}@endisset</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Observaciones: </b></td>
                                                        <td id='observaciones'>@isset($grua->observaciones){{$grua->observaciones}}@endisset</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                        <div id="datos" class="contenido" style="display: none;">
                        </div>
                        <div id="manuales" class="contenido" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="centrado">
                <div class="block-section">
                    <input type="submit" class="boton-catalogo" value="REGRESAR" onclick="window.location.assign('{{url('busqueda')}}');">
                </div>
            </div>
        </div>
    </footer>
@endsection
