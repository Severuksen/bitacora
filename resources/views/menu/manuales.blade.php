@extends('menu')

@section('menuestilo')
    <style>
        .tab button#manuales {
            color: var(--verde);
            font-weight: 700;
            border-bottom: 2px solid var(--verde);
        }
    </style>
@endsection

@section('div')
    <div id="manuales" class="contenido" style="display: flex;">
        <div class="row">
            <div class="col-xs-6">
                <div class="agregar-manu-contenedor">
                    <div class="agregar-manu-arriba">
                        <div class="agregar-manu-titulo">
                            <label>AGREGAR MANUAL</label>
                        </div>
                    </div>
                    <div class="agregar-manu-abajo">
                        <form method="POST" action="{{url('menu/manuales')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="agregar-manu-grua">
                                    <label for="agregarmanugrua">Grúa:</label>
                                    <select id="agregarmanugrua" name="agregarmanugrua">
                                        @isset($gruas)
                                            @foreach($gruas as $grua)
                                                <option value="{{$grua->id_grua}}">{{$grua->mod_grua}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="agregar-manu-nombre">
                                    <label for="agregarmanunombre">Nombre:</label>
                                    <input type="text" maxlength="47" id="agregarmanunombre" name="agregarmanunombre" placeholder="Título del manual..." required>
                                </div>
                                <div class="agregar-manu-descripcion">
                                    <label for="agregarmanudescripcion">Descripción: </label>
                                    <textarea maxlength="222" id="agregarmanudescripcion" name="agregarmanudescripcion" placeholder="Descripción del contenido..." required></textarea>
                                </div>
                                <div class="agregar-manu-pdf">
                                    <label for="agregarmanupdf">Archivo PDF: </label>
                                    <input type="text" id="agregarmanudireccion" name="agregarmanudireccion" placeholder="Seleccione un archivo..." value="" disabled>
                                    <input type="button" name="agregarmanucarga" id="agregarmanucarga" onclick="cargar('agregarmanupdf');">
                                    <input type="file" id="agregarmanupdf" name="agregarmanupdf" accept=".pdf" onchange="direccion(event, 'agregarmanudireccion');">
                                    <label class="respuesta">@isset($agregarmanumensaje){{$agregarmanumensaje}}@endisset</label>
                                </div>
                                <div class="agregar-manu-boton">
                                    <input type="submit" id="agregarmanu" name="agregarmanu" value="AGREGAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="modificar-manu-contenedor">
                    <div class="modificar-manu-arriba">
                        <div class="modificar-manu-titulo">
                            <label>MODIFICAR MANUAL</label>
                        </div>
                    </div>
                    <div class="modificar-manu-abajo">
                        <form id="modificarmanuform" method="POST" action="{{url('menu/manuales')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="modificar-manu-manual">
                                    <label for="modificarmanumanual">Manual:</label>
                                    <select id="modificarmanumanual" name="modificarmanumanual">
                                        @isset($manuales)
                                            @foreach ($manuales as $manual)
                                                <option value="{{$manual->id_man}}">{{$manual->mod_grua." - ".$manual->nombre}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="modificar-manu-grua">
                                    <label for="modificarmanugrua">Grúa:</label>
                                    <select id="modificarmanugrua" name="modificarmanugrua">
                                        @isset($gruas)
                                            @foreach($gruas as $grua)
                                                <option value="{{$grua->id_grua}}">{{$grua->mod_grua}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                                <div class="modificar-manu-nombre">
                                    <label for="modificarmanunombre">Nombre:</label>
                                    <input type="text" maxlength="47" id="modificarmanunombre" name="modificarmanunombre" placeholder="Título del manual..." required>
                                </div>
                                <div class="modificar-manu-descripcion">
                                    <label for="modificarmanudescripcion">Descripción: </label>
                                    <textarea maxlength="222" id="modificarmanudescripcion" name="modificarmanudescripcion" placeholder="Descripción del contenido..." required></textarea>
                                </div>
                                <div class="modificar-manu-pdf">
                                    <label for="modificarmanupdf">Archivo PDF: </label>
                                    <input type="text" id="modificarmanudireccion" name="modificarmanudireccion" placeholder="Seleccione un archivo..." value="" disabled>
                                    <input type="button" name="modificarmanucarga" id="modificarmanucarga" onclick="cargar('modificarmanupdf');">
                                    <input type="file" id="modificarmanupdf" name="modificarmanupdf" accept=".pdf" onchange="direccion(event, 'modificarmanudireccion');">
                                    <label class="respuesta">@isset($modificarmanumensaje){{$modificarmanumensaje}}@endisset</label>
                                </div>
                                <div class="modificar-manu-boton">
                                    <input type="submit" id="modificarmanu" name="modificarmanu" value="MODIFICAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="eliminar-manu-contenedor">
                    <div class="eliminar-manu-arriba">
                        <div class="eliminar-manu-titulo">
                            <label>ELIMINAR MANUAL</label>
                        </div>
                    </div>
                    <div class="eliminar-manu-abajo">
                        <form method="POST" action="{{url('menu/mantenimiento')}}">
                            @csrf
                            <div class="container">
                                <div class="eliminar-manu-manual">
                                    <label for="eliminarmanunombre">Manual:</label>
                                    <select id="eliminarmanunombre" name="eliminarmanunombre">
                                        @isset($manuales)
                                            @foreach ($manuales as $manual)
                                                <option value="{{$manual->id_man}}">{{$manual->mod_grua." - ".$manual->nombre}}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <label class="respuesta">@isset($eliminarmanumensaje){{$eliminarmanumensaje}}@endisset</label>
                                </div>
                                <div class="eliminar-manu-boton">
                                    <input type="submit" id="eliminarmanu" name="eliminarmanu" value="ELIMINAR">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
