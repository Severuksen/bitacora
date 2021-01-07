<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gruas;
use App\Servicios;

class GruasController extends Controller
{
    public function getbusqueda()
    {
        $gruas = Gruas::select(['id_grua', 'tipo_grua', 'img', 'horas', 'mod_grua'])->get();
        [$id_grua, $modelo, $img, $horas, $tipo] = busqueda($gruas);

        return view('busqueda', [
            'id_grua' => $id_grua,
            'modelo' => $modelo,
            'img' => $img,
            'horas' => $horas,
            'tipo' => $tipo
        ]);
    }

    public function postbusqueda(Request $request)
    {
        $gruas = Gruas::select(['id_grua', 'tipo_grua', 'img', 'horas', 'mod_grua'])->where('mod_grua', 'LIKE', "%$request->busqueda%")->get();

        if(busqueda($gruas) == NULL)
        {
            return view('busqueda', [
                'busqueda' => $request->busqueda
            ]);
        } else {

            [$id_grua, $modelo, $img, $horas, $tipo] = busqueda($gruas);
            return view('busqueda', [
                'id_grua' => $id_grua,
                'modelo' => $modelo,
                'img' => $img,
                'horas' => $horas,
                'tipo' => $tipo,
                'busqueda' => $request->busqueda
            ]);
        }
    }

    public function getgruas($id_grua)
    {
        $servicios = Servicios::select(['gruas.id_grua', 'gruas.tipo_grua', 'gruas.mod_grua', 'gruas.horas', 'servicios.fecha', 'mantenimiento.tipo_man', 'gruas.img', 'servicios.observaciones'])
                    ->join('gruas', 'servicios.id_grua', '=', 'gruas.id_grua')
                    ->join('mantenimiento', 'mantenimiento.id_man', '=', 'servicios.id_man')
                    ->where('servicios.id_grua', $id_grua)->orderBy('servicios.fecha', 'DESC')->first();


        return view('gruas', [
            'tipo' => $servicios->tipo_grua,
            'modelo' => $servicios->mod_grua,
            'img' => $servicios->img,
            'fecha' => $servicios->fecha,
            'horas' => $servicios->horas,
            'mantenimiento' => $servicios->tipo_man,
            'observaciones' => $servicios->observaciones,
            'historial' => $this->historial($id_grua)
        ]);
    }

    public function historial($id_grua)
    {
        $historial = Servicios::select(['gruas.horas', 'servicios.fecha', 'mantenimiento.tipo_man', 'servicios.observaciones'])
                    ->join('gruas', 'servicios.id_grua', '=', 'gruas.id_grua')
                    ->join('mantenimiento', 'mantenimiento.id_man', '=', 'servicios.id_man')
                    ->where('servicios.id_grua', $id_grua)->orderBy('servicios.fecha', 'DESC')->get();
        return
    }

    public function postgruas()
    {

    }
}
