@extends('menu')

@section('menuestilo')
    <style>
        .tab button#manuales {
            color: var(--verde);
            font-weight: 700;
            border-bottom: 2px solid var(--verde);
        }
        table{
            width: 500px;
        }
        table thead tr th{
            padding: 20px;
            font-size: 15px;
            background-color: var(--verde);
            color: white;
            text-align: center;
        }
    </style>
@endsection

@section('div')
    <div id="manuales" class="contenido" style="display: flex;">
        <div class="container">
            <table border="1">
                <thead>
                    <tr>
                        <th width="400px">DESCRIPCIÓN</th>
                        <th width="100px">ENLACE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Manual para el cambio de piezas hidraulicas</td>
                        <td><a href="http://enlace.dev/descargar.pdf">DESCARGAR</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
