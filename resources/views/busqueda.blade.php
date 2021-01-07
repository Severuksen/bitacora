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
            @isset($modelo)
                @for($i=0;$i<count($modelo);$i++)
                    <div class="section-gruas" onclick="window.location.assign('{{url('/grua/'.$id_grua[$i])}}');">
                        <div class="gruas-gris">
                            <div class="gruas-imagen" style="background-image: url('{{asset($img[$i])}}')"></div>
                        </div>
                        <div class="gruas-blanco">
                            <div class="gruas-descripcion">
                                <label><b>{{$tipo[$i]}} {{$modelo[$i]}}</b></label>
                                <label>Servicios: {{$horas[$i]}} hrs.</label>
                            </div>
                        </div>
                    </div>
                @endfor
            @else
                <br><br><h2>NO SE ENCONTRARON RESULTADOS.</h2>
            @endisset
        </div>
    </section>
    <footer>
        <br><br><br><br>
    </footer>
@endsection
