@extends('menu')

@section('menuestilo')
    <style>
        .tab button#gruas {
            color: var(--verde);
            font-weight: 700;
            border-bottom: 2px solid var(--verde);
        }
    </style>
@endsection

@section('div')
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
                        <form method="POST" action="{{url('menu/gruas')}}" enctype="multipart/form-data">
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
                        <form id="modificargruaform" method="POST" action="{{url('menu/gruas')}}" enctype="multipart/form-data">
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
                        <form method="POST" action="{{url('menu/gruas')}}">
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
@endsection
