@extends('main')

@section('titulo')
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/gruas.css')}}">
    <title>@isset($grua){{$grua}}@endisset :: BITÁCORA</title>
    <style>

    </style>
@endsection

@section('cuerpo')
    <section>
        <div class="container">
            <div class="grua-contenedor">
                <div class="grua-izquierda">
                    <div class="grua-titulo"></div>
                    <div class="grua-imagen"></div>
                </div>
                <div class="grua-derecho">
                    <div class="grua-tab">

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
