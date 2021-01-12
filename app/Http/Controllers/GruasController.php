<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Gruas;
use App\Servicios;
use Facade\FlareClient\Stacktrace\File;

class GruasController extends Controller
{
    /**
     * Devuelve una lista completa de grúas.
     */
    public function getbusqueda()
    {
        $gruas = Gruas::select(['id_grua', 'tipo_grua', 'img', 'mod_grua','estado'])->get();

        return view('busqueda', ['gruas' => $gruas]);
    }

    /**
     * Devuelve una lista de grúas basadas en la busqueda.
     */
    public function postbusqueda(Request $request)
    {
        $query  = Gruas::select(['id_grua', 'tipo_grua', 'img', 'mod_grua','estado'])->whereMod_grua($request->busqueda);
        $gruas  = $query->get();
        $conteo = $query->count();

        if($conteo == "")
        {
            return view('busqueda', [
                'busqueda' => $request->busqueda
            ]);
        } else {
            return view('busqueda', [
                'gruas' => $gruas,
                'busqueda' => $request->busqueda
            ]);
        }
    }

    /**
     * Funcion de recepcion de las peticiones $_GET de las gruas por su id. Devuelve la informacion de la grua solicitada por su id_grua.
     */
    public function getgruas($id_grua)
    {
        $servicios = Servicios::select(['gruas.id_grua', 'gruas.tipo_grua', 'gruas.mod_grua', 'servicios.horas', 'servicios.fecha', 'mantenimiento.tipo_man', 'gruas.img', 'servicios.observaciones', 'gruas.estado', 'manuales.manual'])
                    ->join('gruas', 'gruas.id_grua', '=', 'servicios.id_grua')
                    ->join('mantenimiento', 'mantenimiento.id_man', '=', 'servicios.id_man')
                    ->join('manuales', 'manuales.id_grua', '=', 'gruas.id_grua')
                    ->where('servicios.id_grua', e($id_grua))->orderBy('servicios.fecha', 'DESC')->first();

        $historial = Servicios::select(['servicios.fecha', 'servicios.horas', 'mantenimiento.tipo_man', 'servicios.observaciones', 'servicios.estado'])
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

    /**
     *
     */
    public function getmenu()
    {
        return view('menu');
    }

    public function postmenu(Request $request)
    {
        switch(true){
            case (isset($request->agregar)):
                Gruas::create(['tipo_grua' => e($request->agregartipo), 'fab_grua' => e($request->agregarfabricante), 'mod_grua' => e($request->agregarmodelo), 'estado' => e($request->agregarestado), 'img' => $this->img($request->file('agregarfoto'))]);
                return view('menu', ['mensaje' => 'SE HA AGREGADO LA GRÚA.']);
                break;
            case (isset($request->modificar)):
                break;
            case (isset($request->eliminar)):
                break;
        }
    }

    public function img($foto)
    {
        return "data:image/".$foto->extension().";base64,".base64_encode(file_get_contents($foto));
    }

}
