@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css"  media="screen" href="{{asset('css/index.css')}}">
    <title>BITACORA :: PÁGINA PRINCIPAL</title>
@endsection

@section('cuerpo')
    <section>
        <div class="centrado">
            <div class="block-section">
                <label for="busqueda">Buscar grúas por:</label>
                <input type="search" class="busqueda" name="busqueda" id="busqueda" placeholder="SERIAL, MODELO O MARCA...">
                <div class="lupa"></div>
            </div>
        </div>
    </section>
    <footer>
        <div class="centrado">
            <div class="block-section">
                <form method="POST" action="{{url('/busqueda')}}">
                    @csrf
                    <input type="submit" class="boton-catalogo" value="CATÁLOGO DE GRÚAS">
                </form>
            </div>
        </div>
    </footer>
@endsection


