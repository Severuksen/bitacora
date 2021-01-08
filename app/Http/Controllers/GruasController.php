<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Gruas;
use App\Servicios;

class GruasController extends Controller
{
    /**
     * Funcion de recepcion de las peticiones $_GET de la busqueda. Devuelve el catálogo completo de las gruas.
     */
    public function getbusqueda()
    {
        $gruas = Gruas::select(['gruas.id_grua', 'gruas.tipo_grua', 'gruas.img', 'servicios.horas', 'gruas.mod_grua', 'gruas.estado'])->join('servicios', 'servicios.id_grua', '=', 'gruas.id_grua')->orderBy('servicios.fecha', 'DESC')->get();

        [$id_grua, $modelo, $img, $horas, $tipo, $estado] = busqueda($gruas);

        return view('busqueda', ['id_grua' => $id_grua, 'modelo' => $modelo, 'img' => $img, 'horas' => $horas, 'tipo' => $tipo, 'estado' => $estado]);
    }

    /**
     * Funcion de recepcion de las peticiones $_POST de la busqueda. Devuelve los resultados de la busqueda de gruass.
     */
    public function postbusqueda(Request $request)
    {
        $gruas = Gruas::select(['gruas.id_grua', 'gruas.tipo_grua', 'gruas.img', 'servicios.horas', 'gruas.mod_grua', 'gruas.estado'])->join('servicios', 'servicios.id_grua', '=', 'gruas.id_grua')->where('mod_grua', 'LIKE', "%$request->busqueda%")->get();

        if(busqueda($gruas) == NULL)
        {
            return view('busqueda', [
                'busqueda' => $request->busqueda
            ]);
        } else {
            [$id_grua, $modelo, $img, $horas, $tipo, $estado] = busqueda($gruas);
            return view('busqueda', [
                'id_grua' => $id_grua,
                'modelo' => $modelo,
                'img' => $img,
                'horas' => $horas,
                'tipo' => $tipo,
                'estado' => $estado,
                'busqueda' => $request->busqueda
            ]);
        }
    }

    /**
     * Funcion de recepcion de las peticiones $_GET de las gruas por su id. Devuelve la informacion de la grua solicitada por su id_grua.
     */
    public function getgruas($id_grua)
    {
        $servicios = Servicios::select(['gruas.id_grua', 'gruas.tipo_grua', 'gruas.mod_grua', 'servicios.horas', 'servicios.fecha', 'mantenimiento.tipo_man', 'gruas.img', 'servicios.observaciones', 'gruas.estado'])
                    ->join('gruas', 'gruas.id_grua', '=', 'servicios.id_grua')
                    ->join('mantenimiento', 'mantenimiento.id_man', '=', 'servicios.id_man')
                    ->where('servicios.id_grua', e($id_grua))->orderBy('servicios.fecha', 'DESC')->first();

        $historial = Servicios::select(['servicios.fecha', 'servicios.horas', 'servicios.fecha', 'mantenimiento.tipo_man', 'servicios.observaciones', 'servicios.estado'])
                    ->join('gruas', 'servicios.id_grua', '=', 'gruas.id_grua')
                    ->join('mantenimiento', 'mantenimiento.id_man', '=', 'servicios.id_man')
                    ->where('servicios.id_grua', e($id_grua))->orderBy('servicios.fecha', 'DESC')->get();

        switch(true)
        {
            case ($servicios == NULL):
                $gruas = Gruas::whereId_grua(e($id_grua))->first();
                return view('gruas', ['servicios' => $gruas, 'mensaje' => 'No posee ningun mantenimiento registrado.']);
            break;
            default:
                return view('gruas', ['servicios' => $servicios, 'historial' => $historial]);
            break;
        }
    }

    public function getmenu()
    {
        return view('menu');
    }

}
