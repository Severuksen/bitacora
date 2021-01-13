@extends('menu')

@section('menuestilo')
    <style>
        .tab button#mantenimiento {
            color: var(--verde);
            font-weight: 700;
            border-bottom: 2px solid var(--verde);
        }
    </style>
@endsection

@section('div')
    <div id="mantenimiento" class="contenido" style="display: flex;">
        <div class="row">
            <div class="col-xs-6">
                <div class="agregar-man-contenedor">
                    <div class="agregar-man-arriba">
                        <div class="agregar-man-titulo">
                            <label>AGREGAR MANTENIMIENTO</label>
                        </div>
                    </div>
                    <div class="agregar-man-abajo">
                        <form method="POST" action="{{url('menu/mantenimiento')}}">
                            @csrf
                            <div class="container">
                                <div class="agregar-man-grua">
                                    <label for="agregarmangrua">Grúa:</label>
                                    <select id="agregarmangrua" name="agregarmangrua">
                                        @isset($gruas)
                                            @foreach ($gruas as $grua)
                                                <option value="{{$grua->id_grua}}">{{$grua->mod_grua}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="agregar-man-mantenimiento">
                                    <label for="agregarmanmantenimiento">Tipo de mantenimiento: </label>
                                    <select id="agregarmanmantenimiento" name="agregarmanmantenimiento">
                                        @isset($mantenimiento)
                                            @foreach ($mantenimiento as $man)
                                                <option value="{{$man->id_man}}">{{$man->tipo_man}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="agregar-man-fecha">
                                    <label for="agregarmanfecha">Fecha de mantenimiento: </label>
                                    <input type="date" id="agregarmanfecha" name="agregarmanfecha" required>
                                </div>
                                <div class="agregar-man-horas">
                                    <label for="agregarmanhoras">Horas de servicio: </label>
                                    <input type="number" id="agregarmanhoras" name="agregarmanhoras" placeholder="Horas de servicio..." required>
                                </div>
                                <div class="agregar-man-observaciones">
                                    <label for="agregarmanobservaciones">Observaciones: </label>
                                    <input type="text" id="agregarmanobservaciones" name="agregarmanobservaciones" placeholder="Observaciones...">
                                </div>
                                <div class="agregar-man-estado">
                                    <label for="agregarmanestado">Estado de la grúa:</label>
                                    <select id="agregarmanestado" name="agregarmanestado">
                                        <option value="ACTIVO" selected>ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                    <label class="respuesta">@isset($agregarmanmensaje){{$agregarmanmensaje}}@endisset</label>
                                </div>
                                <div class="agregar-man-boton">
                                    <input type="submit" id="agregarman" name="agregarman" value="AGREGAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="modificar-man-contenedor">
                    <div class="modificar-man-arriba">
                        <div class="modificar-man-titulo">
                            <label>MODIFICAR MANTENIMIENTO</label>
                        </div>
                    </div>
                    <div class="modificar-man-abajo">
                        <form id="modificarmanform" method="POST" action="{{url('menu/mantenimiento')}}">
                            @csrf
                            <div class="container">
                                <div class="modificar-man-grua">
                                    <label for="modificarmangrua">Mantenimiento:</label>
                                    <select id="modificarmangrua" name="modificarmangrua">
                                        @isset($servicios)
                                            @foreach ($servicios as $srv)
                                                <option value="{{$srv->id_srv}}">{{$srv->mod_grua." - ".$srv->fecha}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="modificar-man-mantenimiento">
                                    <label for="modificarmanmantenimiento">Tipo de mantenimiento: </label>
                                    <select id="modificarmanmantenimiento" name="modificarmanmantenimiento">
                                        @isset($mantenimiento)
                                            @foreach ($mantenimiento as $man)
                                                <option value="{{$man->id_man}}">{{$man->tipo_man}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="modificar-man-fecha">
                                    <label for="modificarmanfecha">Fecha de mantenimiento: </label>
                                    <input type="date" id="modificarmanfecha" name="modificarmanfecha" required>
                                </div>
                                <div class="modificar-man-horas">
                                    <label for="modificarmanhoras">Horas de servicio: </label>
                                    <input type="number" id="modificarmanhoras" name="modificarmanhoras" placeholder="Horas de servicio..." required>
                                </div>
                                <div class="modificar-man-observaciones">
                                    <label for="modificarmanobservaciones">Observaciones: </label>
                                    <input type="text" id="modificarmanobservaciones" name="modificarmanobservaciones" placeholder="Observaciones...">

                                </div>
                                <div class="modificar-man-estado">
                                    <label for="modificarmanestado">Estado de la grúa:</label>
                                    <select id="modificarmanestado" name="modificarmanestado">
                                        <option value="ACTIVO" selected>ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                    <label class="respuesta">@isset($modificarmanmensaje){{$modificarmanmensaje}}@endisset</label>
                                </div>
                                <div class="modificar-man-boton">
                                    <input type="submit" id="modificarman" name="modificarman" value="MODIFICAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="eliminar-man-contenedor">
                    <div class="eliminar-man-arriba">
                        <div class="eliminar-man-titulo">
                            <label>ELIMINAR MANTENIMIENTO</label>
                        </div>
                    </div>
                    <div class="eliminar-man-abajo">
                        <form id="eliminarmanform" method="POST" action="{{url('menu/mantenimiento')}}">
                            @csrf
                            <div class="container">
                                <div class="eliminar-man-seleccion">
                                    <label for="eliminarmangrua">Selecciona un mantenimiento:</label>
                                    <select id="eliminarmangrua" name="eliminarmangrua">
                                        @isset($servicios)
                                            @foreach ($servicios as $srv)
                                                <option value="{{$srv->id_srv}}">{{$srv->mod_grua." - ".$srv->fecha}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <label class="respuesta">@isset($eliminarmanmensaje){{$eliminarmanmensaje}}@endisset</label>
                                </div>
                                <div class="eliminar-man-boton">
                                    <input type="submit" id="eliminarman" name="eliminarman" value="ELIMINAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
