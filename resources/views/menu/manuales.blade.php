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
        <div class="container">
            <div class="manual-contenedor">
                <div class="manual-arriba">
                    <div class="manual-titulo">
                        <label>Manual de procedimiento para grúas Kalmar</label>
                    </div>
                </div>
                <div class="manual-abajo">
                    <div class="manual-descripcion">
                        <p>Descripción improvisada para lograr el relleno del espacio con párrafos que realmente no tienen un significado lingüístico sino mas bien, la ocupación del espacio.</p>
                    </div>
                    <div class="manual-icono"></div>
                </div>
            </div>
            <div class="manual-contenedor">
                <div class="manual-arriba">
                    <div class="manual-titulo">
                        <label>Manual de procedimiento para grúas Kalmar</label>
                    </div>
                </div>
                <div class="manual-abajo">
                    <div class="manual-descripcion">
                        <p>Descripción improvisada para lograr el relleno del espacio con párrafos que realmente no tienen un significado lingüístico sino mas bien, la ocupación del espacio.</p>
                    </div>
                    <div class="manual-icono"></div>
                </div>
            </div>
            <div class="manual-contenedor">
                <div class="manual-arriba">
                    <div class="manual-titulo">
                        <label>Manual de procedimiento para grúas Kalmar</label>
                    </div>
                </div>
                <div class="manual-abajo">
                    <div class="manual-descripcion">
                        <p>Descripción improvisada para lograr el relleno del espacio con párrafos que realmente no tienen un significado lingüístico sino mas bien, la ocupación del espacio.</p>
                    </div>
                    <div class="manual-icono"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
