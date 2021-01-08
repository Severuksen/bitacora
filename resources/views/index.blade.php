@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css"  media="screen" href="{{asset('css/index.css')}}">
    <title>BITACORA :: PÁGINA PRINCIPAL</title>
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            <div class="centrado">
                <div class="block-section">
                    <label for="busqueda">Buscar grúas por:</label>
                    <form method="POST" action="{{url('busqueda')}}">
                        @csrf
                        <input type="search" class="busqueda" name="busqueda" id="busqueda" placeholder="MODELO...">
                        <input type="submit" class="lupa" value="">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="centrado">
                <div class="block-section">
                    <input type="submit" class="boton-catalogo" value="CATÁLOGO DE GRÚAS" onclick="window.location.assign('{{url('busqueda')}}');">
                    <input type="submit" class="boton-catalogo-verde" value="MENÚ" onclick="window.location.assign('{{url('menu')}}');">
                </div>
            </div>
        </div>
    </footer>
@endsection


