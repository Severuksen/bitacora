@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/menu.css')}}">
    <title>MENU :: BITÁCORA</title>
    <style>
        label#respuesta{
            margin-top: 5px;
            font-size: 15px;
        }
    </style>
@endsection

@section('cuerpo')
    <section class="container">
        <div class="row">
            <div class="col-xs-6">
                <div class="agregar-contenedor">
                    <div class="agregar-arriba">
                        <div class="agregar-titulo">
                            <label>AGREGAR GRÚA</label>
                        </div>
                    </div>
                    <div class="agregar-abajo">
                        <form method="POST" action="{{url('menu')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="agregar-tipo">
                                    <label for="agregartipo">Tipo de grúa:</label>
                                    <select id="agregartipo" name="agregartipo">
                                        <option value="Reach Stacker" selected>Reach Stacker</option>
                                        <option value="Forklift">Forklift</option>
                                    </select>
                                </div>
                                <div class="agregar-fabricante">
                                    <label for="agregarfabricante">Fabricante: </label>
                                    <input type="text" id="agregarfabricante" name="agregarfabricante" placeholder="Nombre del fabricante" required>
                                </div>
                                <div class="agregar-modelo">
                                    <label for="agregarmodelo">Modelo: </label>
                                    <input type="text" id="agregarmodelo" name="agregarmodelo" placeholder="Modelo de la grúa" required>
                                </div>
                                <div class="agregar-estado">
                                    <label for="agregarestado">Estado de la grúa: </label>
                                    <select id="agregarestado" name="agregarestado">
                                        <option value="ACTIVO" selected>ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>
                                <div class="agregar-foto">
                                    <label for="agregarfoto">Imagen de la grúa: </label>
                                    <input type="text" id="agregardireccion" name="agregardireccion" placeholder="Imagen..." value="" disabled>
                                    <input type="button" name="agregarcarga" id="agregarcarga" onclick="cargar('agregarfoto');">
                                    <input type="file" id="agregarfoto" name="agregarfoto" accept=".png" onchange="direccion(event, 'agregardireccion');">
                                    <label id="respuesta">@isset($mensaje){{$mensaje}}@endisset</label>
                                </div>
                                <div class="agregar-boton">
                                    <input type="submit" id="agregar" name="agregar" value="AGREGAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="modificar-contenedor">
                    <div class="modificar-arriba">
                        <div class="modificar-titulo">
                            <label>MODIFICAR GRÚA</label>
                        </div>
                    </div>
                    <div class="modificar-abajo">
                        <form method="POST" action="{{url('menu')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="modificar-seleccion">
                                    <label for="modificargrua">Seleccionar una grúa:</label>
                                    <select id="modificargrua" name="modificargrua">
                                        <option value="Kalmar B220" selected>Kalmar B220</option>
                                        <option value="Kalmar B222">Kalmar B222</option>
                                    </select>
                                </div>
                                <div class="modificar-tipo">
                                    <label for="modificartipo">Tipo de grúa:</label>
                                    <select id="modificartipo" name="modificartipo">
                                        <option value="Reach Stacker" selected>Reach Stacker</option>
                                        <option value="Forklift">Forklift</option>
                                    </select>
                                </div>
                                <div class="modificar-fabricante">
                                    <label for="modificarfabricante">Fabricante: </label>
                                    <input type="text" id="modificarfabricante" name="modificarfabricante" placeholder="Nombre del fabricante">
                                </div>
                                <div class="modificar-modelo">
                                    <label for="modelo">Modelo: </label>
                                    <input type="text" id="modificarmodelo" name="modificarmodelo" placeholder="Modelo de la grúa">
                                </div>
                                <div class="modificar-estado">
                                    <label for="modificarestado">Estado de la grúa:</label>
                                    <select id="modificarestado" name="modificarestado">
                                        <option value="ACTIVO" selected>ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>
                                <div class="modificar-foto">
                                    <label for="modificarfoto">Imagen de la grúa: </label>
                                    <input type="text" id="modificardireccion" name="modificardireccion" placeholder="Imagen..." value="" disabled>
                                    <input type="button" name="modificarcarga" id="modificarcarga" onclick="cargar('modificarfoto');">
                                    <input type="file" id="modificarfoto" name="modificarfoto" accept=".png" onchange="direccion(event, 'modificardireccion');">
                                </div>
                                <div class="modificar-boton">
                                    <input type="submit" id="modificar" name="modificar" value="MODIFICAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="eliminar-contenedor">
                    <div class="eliminar-arriba">
                        <div class="eliminar-titulo">
                            <label>ELIMINAR GRÚA</label>
                        </div>
                    </div>
                    <div class="eliminar-abajo">
                        <form method="POST" action="{{url('menu')}}">
                            @csrf
                            <div class="container">
                                <div class="eliminar-seleccion">
                                    <label for="eliminargrua">Seleccionar una grúa:</label>
                                    <select id="eliminargrua" name="eliminargrua">
                                        <option value="Kalmar B220" selected>Kalmar B220</option>
                                        <option value="Kalmar B222">Kalmar B222</option>
                                    </select>
                                </div>
                                <div class="eliminar-boton">
                                    <input type="submit" id="eliminar" name="eliminar" value="ELIMINAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
