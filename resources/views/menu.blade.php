@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/menu.css')}}">
    <title>MENU :: BITÁCORA</title>
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
            <button class='enlaces activo' onclick='abrir(event, "gruas");'>GRÚAS</button>
            <button class='enlaces ' onclick='abrir(event, "mantenimiento");'>MANTENIMIENTO</button>
            <button class='enlaces' onclick='abrir(event, "datos");'>DATOS TECNICOS</button>
            <button class='enlaces' onclick='abrir(event, "manuales");'>MANUALES</button>
        </div>
        <div id="gruas" class="contenido" style="display: flex;">
            <div class="row">
                <div class="col-xs-6">
                    <div class="agregar-grua-contenedor">
                        <div class="agregar-grua-arriba">
                            <div class="agregar-grua-titulo">
                                <label>AGREGAR GRÚA</label>
                            </div>
                        </div>
                        <div class="agregar-grua-abajo">
                            <form method="POST" action="{{url('menu')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="agregar-grua-tipo">
                                        <label for="agregargruatipo">Tipo de grúa:</label>
                                        <select id="agregargruatipo" name="agregargruatipo">
                                            <option value="Reach Stacker" selected>Reach Stacker</option>
                                            <option value="Forklift">Forklift</option>
                                        </select>
                                    </div>
                                    <div class="agregar-grua-fabricante">
                                        <label for="agregarfabricante">Fabricante: </label>
                                        <input type="text" id="agregargruafabricante" name="agregargruafabricante" placeholder="Nombre del fabricante" required>
                                    </div>
                                    <div class="agregar-grua-modelo">
                                        <label for="agregarmodelo">Modelo: </label>
                                        <input type="text" id="agregargruamodelo" name="agregargruamodelo" placeholder="Modelo de la grúa" required>
                                    </div>
                                    <div class="agregar-grua-estado">
                                        <label for="agregarestado">Estado de la grúa: </label>
                                        <select id="agregargruaestado" name="agregargruaestado">
                                            <option value="ACTIVO" selected>ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
                                    </div>
                                    <div class="agregar-grua-foto">
                                        <label for="agregarfoto">Imagen de la grúa: </label>
                                        <input type="text" id="agregargruadireccion" name="agregargruadireccion" placeholder="Imagen..." value="" disabled>
                                        <input type="button" name="agregargruacarga" id="agregargruacarga" onclick="cargar('agregargruafoto');">
                                        <input type="file" id="agregargruafoto" name="agregargruafoto" accept=".png" onchange="direccion(event, 'agregargruadireccion');">
                                        <label class="respuesta">@isset($agregargruamensaje){{$agregargruamensaje}}@endisset</label>
                                    </div>
                                    <div class="agregar-grua-boton">
                                        <input type="submit" id="agregargrua" name="agregargrua" value="AGREGAR">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="modificar-grua-contenedor">
                        <div class="modificar-grua-arriba">
                            <div class="modificar-grua-titulo">
                                <label>MODIFICAR GRÚA</label>
                            </div>
                        </div>
                        <div class="modificar-grua-abajo">
                            <form id="modificargruaform" method="POST" action="{{url('menu')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="modificar-grua-seleccion">
                                        <label for="modificargruagrua">Selecciona una grúa:</label>
                                        <select id="modificargruagrua" name="modificargruagrua">
                                            @isset($gruas)
                                                @foreach ($gruas as $grua)
                                                    <option value="{{$grua->id_grua}}">{{$grua->mod_grua}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <div class="modificar-grua-tipo">
                                        <label for="modificargruatipo">Tipo de grúa:</label>
                                        <select id="modificargruatipo" name="modificargruatipo">
                                            <option value="Reach Stacker" selected>Reach Stacker</option>
                                            <option value="Forklift">Forklift</option>
                                        </select>
                                    </div>
                                    <div class="modificar-grua-fabricante">
                                        <label for="modificargruafabricante">Fabricante: </label>
                                        <input type="text" id="modificargruafabricante" name="modificargruafabricante" placeholder="Nombre del fabricante">
                                    </div>
                                    <div class="modificar-grua-modelo">
                                        <label for="modificargruamodelo">Modelo: </label>
                                        <input type="text" id="modificargruamodelo" name="modificargruamodelo" placeholder="Modelo de la grúa">
                                    </div>
                                    <div class="modificar-grua-estado">
                                        <label for="modificargruaestado">Estado de la grúa:</label>
                                        <select id="modificargruaestado" name="modificargruaestado">
                                            <option value="ACTIVO" selected>ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
                                    </div>
                                    <div class="modificar-grua-foto">
                                        <label for="modificargruafoto">Imagen de la grúa: </label>
                                        <input type="text" id="modificargruadireccion" name="modificardireccion" placeholder="Imagen..." value="" disabled>
                                        <input type="button" name="modificargruacarga" id="modificargruacarga" onclick="cargar('modificargruafoto');">
                                        <input type="file" id="modificargruafoto" name="modificargruafoto" accept=".png" onchange="direccion(event, 'modificargruadireccion');">
                                        <label class="respuesta">@isset($modificargruamensaje){{$modificargruamensaje}}@endisset</label>
                                    </div>
                                    <div class="modificar-grua-boton">
                                        <input type="submit" id="modificargrua" name="modificargrua" value="MODIFICAR">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="eliminar-grua-contenedor">
                        <div class="eliminar-grua-arriba">
                            <div class="eliminar-grua-titulo">
                                <label>ELIMINAR GRÚA</label>
                            </div>
                        </div>
                        <div class="eliminar-grua-abajo">
                            <form method="POST" action="{{url('menu')}}">
                                @csrf
                                <div class="container">
                                    <div class="eliminar-grua-seleccion">
                                        <label for="eliminargruagrua">Seleccionar una grúa:</label>
                                        <select id="eliminargruagrua" name="eliminargruagrua">
                                            @foreach ($gruas as $grua)
                                                <option value="{{$grua->id_grua}}">{{$grua->mod_grua}}</option>
                                            @endforeach
                                        </select>
                                        <label class="respuesta">@isset($eliminargruamensaje){{$eliminargruamensaje}}@endisset</label>
                                    </div>
                                    <div class="eliminar-grua-boton">
                                        <input type="submit" id="eliminargrua" name="eliminargrua" value="ELIMINAR">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="mantenimiento" class="contenido" style="display: none;">
            <div class="row">
                <div class="col-xs-6">
                    <div class="agregar-man-contenedor">
                        <div class="agregar-man-arriba">
                            <div class="agregar-man-titulo">
                                <label>AGREGAR MANTENIMIENTO</label>
                            </div>
                        </div>
                        <div class="agregar-man-abajo">
                            <form method="POST" action="{{url('menu')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="agregar-man-grua">
                                        <label for="agregarmangrua">Grúa:</label>
                                        <select id="agregarmangrua" name="agregarmangrua">
                                            <option value="Reach Stacker" selected>Kalmar B222</option>
                                            <option value="Forklift">Kalmar B221</option>
                                        </select>
                                    </div>
                                    <div class="agregar-man-mantenimiento">
                                        <label for="agregarmanmantenimiento">Tipo de mantenimiento: </label>
                                        <select id="agregarmanmantenimiento" name="agregarmanmantenimiento">
                                            <option value="Mantenimiento del motor" selected>Mantenimiento del motor</option>
                                        </select>
                                    </div>
                                    <div class="agregar-man-fecha">
                                        <label for="agregarmanfecha">Fecha de mantenimiento: </label>
                                        <input type="date" id="agregarmanfecha" name="agregarmanfecha" required>
                                    </div>
                                    <div class="agregar-man-horas">
                                        <label for="agregarmanhoras">Horas de servicio: </label>
                                        <input type="number" id="agregarmanhoras" name="agregarmanhoras" required>
                                    </div>
                                    <div class="agregar-man-observaciones">
                                        <label for="agregarmanobservaciones">Observaciones: </label>
                                        <input type="text" id="agregarmanobservaciones" name="agregarmanobservaciones" placeholder="Observaciones...">
                                        <label class="respuesta">@isset($agregarmanmensaje){{$agregarmanmensaje}}@endisset</label>
                                    </div>
                                    <div class="modificar-man-estado">
                                        <label for="modificarmanestado">Estado de la grúa:</label>
                                        <select id="modificarmanestado" name="modificarmanestado">
                                            <option value="ACTIVO" selected>ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
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
                            <form method="POST" action="{{url('menu')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="container">
                                    <div class="modificar-man-grua">
                                        <label for="modificarmangrua">Grúa:</label>
                                        <select id="modificarmangrua" name="modificarmangrua">
                                            <option value="Reach Stacker" selected>Kalmar B222</option>
                                            <option value="Forklift">Kalmar B221</option>
                                        </select>
                                    </div>
                                    <div class="modificar-man-mantenimiento">
                                        <label for="modificarmanmantenimiento">Tipo de mantenimiento: </label>
                                        <select id="modificarmanmantenimiento" name="modificarmanmantenimiento">
                                            <option value="Mantenimiento del motor" selected>Mantenimiento del motor</option>
                                        </select>
                                    </div>
                                    <div class="modificar-man-fecha">
                                        <label for="modificarmanfecha">Fecha de mantenimiento: </label>
                                        <input type="date" id="modificarmanfecha" name="modificarmanfecha" required>
                                    </div>
                                    <div class="modificar-man-horas">
                                        <label for="modificarmanhoras">Horas de servicio: </label>
                                        <input type="number" id="modificarmanhoras" name="modificarmanhoras" required>
                                    </div>
                                    <div class="modificar-man-observaciones">
                                        <label for="modificarmanobservaciones">Observaciones: </label>
                                        <input type="text" id="modificarmanobservaciones" name="modificarmanobservaciones" placeholder="Observaciones...">
                                        <label class="respuesta">@isset($modificarmanmensaje){{$modificarmanmensaje}}@endisset</label>
                                    </div>
                                    <div class="modificar-man-estado">
                                        <label for="modificarmanestado">Estado de la grúa:</label>
                                        <select id="modificarmanestado" name="modificarmanestado">
                                            <option value="ACTIVO" selected>ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
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
                            <form method="POST" action="{{url('menu')}}">
                                @csrf
                                <div class="container">
                                    <div class="eliminar-man-seleccion">
                                        <label for="eliminarmangrua">Selecciona una grúa:</label>
                                        <select id="eliminarmangrua" name="eliminarmangrua">
                                            @foreach ($gruas as $grua)
                                                <option value="{{$grua->id_grua}}">{{$grua->mod_grua}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="eliminar-man-manual">
                                        <label for="eliminarmanmanual">Manual:</label>
                                        <select id="eliminarmanmanual" name="eliminarmanmanual">
                                            @foreach ($gruas as $grua)
                                                <option value="{{$grua->id_grua}}">{{$grua->mod_grua}}</option>
                                            @endforeach
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
        <div id="datos" class="contenido" style="display: none;"></div>
        <div id="manuales" class="contenido" style="display: none;"></div>
    </div>

</section>
@endsection
