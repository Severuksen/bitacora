@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/busqueda.css')}}">
    <title>BÚSQUEDA :: BITÁCORA</title>
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            @isset($busqueda)
                <label>RESULTADOS DE LA BÚSQUEDA: {{$busqueda}}</label>
            @else
                <label>CATÁLOGO DE GRÚAS</label>
            @endisset
        </div>
    </section>
    <section>
        <?php
            $gruas = ['gruas-forklift-pequena', 'gruas-forklift-grande', 'gruas-reachstacker','gruas-reachstacker','gruas-reachstacker','gruas-reachstacker'];
            $descripcion = ['FORKLIFT HELI B700', 'FORKLIFT HELI B900', 'REACH STACKER KALMAR B220', 'REACH STACKER KALMAR B221', 'REACH STACKER KALMAR B222', 'REACH STACKER KALMAR B223'];
        ?>
        <div class="container">
            @for($i=0;$i<count($gruas);$i++)
                <div class="section-gruas">
                    <div class="gruas-gris">
                        <div class="{{$gruas[$i]}}"></div>
                    </div>
                    <div class="gruas-blanco">
                        <div class="gruas-descripcion">
                            <label><b>{{$descripcion[$i]}}</b></label>
                            <label>Mantenimiento: 500 hrs.</label>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>
    <footer>
        <br><br><br><br>
    </footer>
@endsection
