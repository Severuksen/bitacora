@extends('main')
<?php
setlocale(LC_ALL,"es_ES");
?>
@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/gruas.css')}}">
    <title>@isset($servicios->gruas){{$servicios->gruas->mod_grua}}@elseif(isset($servicios->mod_grua)){{$servicios->mod_grua}}@endisset :: BITÁCORA</title>
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <div class="grua-titulo">
                        <h2><b>@isset($servicios->gruas->tipo_grua){{$servicios->gruas->tipo_grua.' '.$servicios->gruas->mod_grua}}@elseif(isset($servicios->tipo_grua)){{$servicios->tipo_grua.' '.$servicios->mod_grua}}@endisset</b></h2>
                    </div>
                    <div class="grua-imagen" style="background-image: url('@isset($servicios->gruas->img)<?= $servicios->gruas->img ?>@elseif(isset($servicios->img))<?= $servicios->img ?>@endisset');"></div>
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
                            <div class="container mantenimiento">
                                @if(isset($servicios) && !isset($mensaje))
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
                                                <td>@isset($servicios->mantenimiento->tipo_man){{$servicios->mantenimiento->tipo_man}}@endisset</td>
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
                                @elseif(isset($servicios) && isset($mensaje))
                                    <label>{{$mensaje}}</label>
                                @endif
                            </div>
                        </div>
                        <div id="historial" class="contenido centrado" style="display: none;">
                            <div class="container historial">
                                @isset($historial)
                                    @foreach($historial as $grua)
                                        <button onclick="historial(event);">@isset($grua->mantenimiento->tipo_man){{strtoupper($grua->mantenimiento->tipo_man)}}@endisset - @isset($grua->fecha){{$grua->fecha}}@endisset</button>
                                        <div class="info" style="display: none;">
                                            <table align="center">
                                                <thead>
                                                    <tr>
                                                        <th width="240px"><b>Fecha del servicio: </b></th>
                                                        <th width="120px"><b>Horas de uso: </b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>@isset($grua->fecha){{$grua->fecha}}@endisset</td>
                                                        <td>@isset($grua->horas){{$grua->horas}}@endisset hrs.</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" style="padding: 5px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Mantenimiento realizado: </b></td>
                                                        <td><b>Estado: </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>@isset($grua->mantenimiento->tipo_man){{$grua->mantenimiento->tipo_man}}@endisset</td>
                                                        <td>@isset($grua->estado){{$grua->estado}}@endisset</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" style="padding: 5px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><b>Observaciones: </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">@isset($grua->observaciones){{$grua->observaciones}}@endisset</td>
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
                            <div class="container manual">
                                @isset($manuales)
                                    @foreach ($manuales as $manual)
                                        <div class="manual-contenedor">
                                            <div class="manual-arriba">
                                                <div class="manual-titulo">
                                                    <label>{{$manual->nombre}}</label>
                                                </div>
                                            </div>
                                            <div class="manual-abajo">
                                                <div class="manual-descripcion">
                                                    <p>{{$manual->descripcion}}</p>
                                                </div>
                                                <a class="manual-icono" href="{{url($manual->enlace)}}" target="_blank"></a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
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
