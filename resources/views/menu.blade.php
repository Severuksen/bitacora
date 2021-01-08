@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/menu.css')}}">
    <title>MENU :: BITÁCORA</title>
    <style>
    .agregar-contenedor{
        display: block;
        width: 327px;
        height: 548px;
        border: 1px solid gray;
    }
    .agregar-arriba{
        display: inline-block;
        width: 325px;
        height: 96px;
        background-color: white;
        border-bottom: 1px solid gray;
    }
    .agregar-titulo{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 40px;
    }
    .agregar-titulo > label{
        font-size: 18px;
        font-weight: 700;
    }
    .agregar-abajo{
        display: inline-block;
        width: 325px;
        height: 450px;
    }
    div.container{
        margin-top: 20px;
        display: block;
    }
    .agregar-tipo, .agregar-fabricante, .agregar-modelo,.agregar-estado, .agregar-boton{
        display: block;
        width: 150px;
        margin-bottom: 10px;
    }
    .agregar-boton{
        width: 150px;
    }
    div > label{
        font-size: 18px;
    }
    div > input, div > select{
        padding: 7px;
    }
    </style>
@endsection

@section('cuerpo')
    <section class="container">
        <div class="agregar-contenedor">
            <div class="agregar-arriba">
                <div class="agregar-titulo">
                    <label>AGREGAR GRÚA</label>
                </div>
            </div>
            <div class="agregar-abajo">
                <div class="container">
                    <div class="agregar-tipo">
                        <label for="tipo">Tipo de grúa:</label>
                        <select id="tipo" name="tipo">
                            <option value="Reach Stacker" selected>Reach Stacker</option>
                            <option value="Forklift">Forklift</option>
                        </select>
                    </div>
                    <div class="agregar-fabricante">
                        <label for="fabricante">Fabricante: </label>
                        <input type="text" id="fabricante" name="fabricante" placeholder="Nombre del fabricante">
                    </div>
                    <div class="agregar-modelo">
                        <label for="modelo">Modelo: </label>
                        <input type="text" id="modelo" name="modelo" placeholder="Modelo de la grúa">
                    </div>
                    <div class="agregar-estado">
                        <label for="estado">Estado de la grúa:</label>
                        <select id="estado" name="estado">
                            <option value="ACTIVO" selected>ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                        </select>
                    </div>
                    <div class="agregar-boton">
                        <input type="submit" id="agregar" name="agregar" value="AGREGAR">
                    </div>
                </div>
            </div>
        </div>

        <div class="modificar-contenedor">
            <div class="modificar-arriba">
                <div class="modificar-titulo">
                    <label>MODIFICAR GRÚA</label>
                </div>
            </div>
            <div class="modificar-abajo">
                <div class="modificar-seleccion">
                    <label for="tipo">Seleccionar una grúa:</label>
                    <select id="tipo" name="tipo">
                        <option value="Kalmar B220" selected>Kalmar B220</option>
                        <option value="Kalmar B222">Kalmar B222</option>
                    </select>
                </div>
                <div class="modificar-tipo">
                    <label for="tipo">Tipo de grúa:</label>
                    <select id="tipo" name="tipo">
                        <option value="Reach Stacker" selected>Reach Stacker</option>
                        <option value="Forklift">Forklift</option>
                    </select>
                </div>
                <div class="modificar-fabricante">
                    <label for="fabricante">Fabricante: </label>
                    <input type="text" id="fabricante" name="fabricante" placeholder="Nombre del fabricante">
                </div>
                <div class="modificar-modelo">
                    <label for="modelo">Modelo: </label>
                    <input type="text" id="modelo" name="modelo" placeholder="Modelo de la grúa">
                </div>
                <div class="modificar-estado">
                    <label for="estado">Estado de la grúa:</label>
                    <select id="estado" name="estado">
                        <option value="ACTIVO" selected>ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                    </select>
                </div>
                <div class="modificar-boton">
                    <input type="submit" id="modificar" name="modificar" value="MODIFICAR">
                </div>
            </div>
        </div>

        <div class="eliminar-contenedor">
            <div class="eliminar-arriba">
                <div class="eliminar-titulo">
                    <label>ELIMINAR GRÚA</label>
                </div>
            </div>
            <div class="eliminar-abajo">
                <div class="eliminar-seleccion">
                    <label for="tipo">Seleccionar una grúa:</label>
                    <select id="tipo" name="tipo">
                        <option value="Kalmar B220" selected>Kalmar B220</option>
                        <option value="Kalmar B222">Kalmar B222</option>
                    </select>
                </div>
                <div class="eliminar-boton">
                    <input type="submit" id="eliminar" name="eliminar" value="ELIMINAR">
                </div>
            </div>
        </div>
    </section>
@endsection
