@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/busqueda.css')}}">
    <title>BÚSQUEDA :: BITÁCORA</title>
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            @isset($busqueda)
                <label>RESULTADOS DE LA BÚSQUEDA: "{{$busqueda}}"</label>
            @else
                <label>CATÁLOGO DE GRÚAS</label>
            @endisset
        </div>
    </section>
    <section>
        <div class="container">
            @isset($gruas)
            @foreach ($gruas as $grua)
                    <div class="section-gruas" onclick="window.location.assign('{{url('/grua/'.$grua->id_grua)}}');">
                        <div class="gruas-gris">
                            <div class="gruas-imagen" style="background-image: url('{{asset($grua->img)}}')"></div>
                        </div>
                        <div class="gruas-blanco">
                            <div class="gruas-descripcion">
                                <label><b>{{$grua->tipo_grua}} {{$grua->mod_grua}}</b></label>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <br><br><h2>NO SE ENCONTRARON RESULTADOS.</h2>
            @endisset
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="centrado">
                <div class="block-section">
                    <input type="submit" class="boton-catalogo" value="REGRESAR" onclick="window.location.assign('{{route('index')}}');">
                </div>
            </div>
        </div>
    </footer>
@endsection
