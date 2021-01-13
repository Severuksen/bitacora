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
    </div>
@endsection
