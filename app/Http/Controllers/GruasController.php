<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Gruas;
use App\Servicios;
use App\Mantenimiento;
use Illuminate\Database\QueryException;

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
        if($request->busqueda == NULL)
        {
            $query  = Gruas::select(['id_grua', 'tipo_grua', 'img', 'mod_grua','estado']);
        } else {
            $query  = Gruas::select(['id_grua', 'tipo_grua', 'img', 'mod_grua','estado'])->where('mod_grua', 'LIKE', "%$request->busqueda%");
        }

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
    public function getgrua($id_grua)
    {
        $servicios = Servicios::select(['gruas.id_grua', 'gruas.tipo_grua', 'gruas.mod_grua', 'servicios.horas', 'servicios.fecha', 'mantenimiento.tipo_man', 'gruas.img', 'servicios.observaciones', 'gruas.estado'])
                    ->join('gruas', 'gruas.id_grua', '=', 'servicios.id_grua')
                    ->join('mantenimiento', 'mantenimiento.id_man', '=', 'servicios.id_man')
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

    public function consultasprevias()
    {
        $gruas = Gruas::select(['id_grua', 'mod_grua']);
        return $gruas;
    }

    public function getmenu()
    {
        return $this->vista('', '');
    }

    public function postmenu(Request $request)
    {
        switch(true){
            case (isset($request->agregargrua)):
                return $this->agregargrua($request);
                break;
            case (isset($request->seleccionargrua)):
                return $this->seleccionargrua($request->modificargruagrua);
                break;
            case (isset($request->modificargrua)):
                return $this->modificargrua($request);
                break;
            case (isset($request->eliminargrua)):
                return $this->eliminargrua($request);
                break;
        }
    }

    public function img($foto)
    {
        return "data:image/".$foto->extension().";base64,".base64_encode(file_get_contents($foto));
    }

    public function agregargrua($request)
    {
        $gruas = $this->consultasprevias();
        $campos = ['agregargruatipo', 'agregargruafabricante', 'agregargruamodelo', 'agregargruaestado', 'agregargruafoto'];

        if(vacio($campos, $request))
        {
            return view('menu.gruas', ['agregargruamensaje' => 'NO DEBES DEJAR CAMPOS VACIOS.', 'gruas' => $gruas->get()]);
        } else {
            switch ($request->file('agregargruafoto')->extension()) {
                case 'jpg':
                case 'png':
                    $img = $this->img($request->file('agregargruafoto'));
                    break;

                default:
                    return view('menu.gruas', ['agregargruamensaje' => 'EL FORMATO DE LA IMAGEN NO ES COMPATIBLE', 'gruas' => $gruas]);
                    break;
            }
            Gruas::create(['tipo_grua' => e($request->agregargruatipo), 'fab_grua' => e($request->agregargruafabricante), 'mod_grua' => e($request->agregargruamodelo), 'estado' => e($request->agregargruaestado), 'img' => $img]);
            return view('menu.gruas', ['agregargruamensaje' => 'SE HA AGREGADO LA GRÚA.', 'gruas' => $gruas->get()]);
        }
    }

    public function seleccionargrua($id)
    {
        $grua = Gruas::select(['tipo_grua', 'fab_grua', 'mod_grua', 'estado'])->whereId_grua($id)->first();
        return [$grua->tipo_grua, $grua->fab_grua, $grua->mod_grua, $grua->estado];
    }

    public function modificargrua($request)
    {
        $campos = ['modificargruatipo', 'modificargruafabricante', 'modificargruamodelo', 'modificargruaestado'];

        switch(vacio($campos, $request))
        {
            case true:
                return $this->vista('modificargruamensaje', 'NO DEBES DEJAR CAMPOS VACIOS.');
                break;
            case false:
                if(vacio(['modificargruafoto'], $request))
                {
                    $datos = ['tipo_grua' => $request->modificargruatipo, 'fab_grua' => $request->modificargruafabricante, 'mod_grua' => $request->modificargruamodelo, 'estado' => $request->modificargruaestado];
                } else {
                    $datos = ['tipo_grua' => $request->modificargruatipo, 'fab_grua' => $request->modificargruafabricante, 'mod_grua' => $request->modificargruamodelo, 'estado' => $request->modificargruaestado, 'img' => $this->img($request->file('modificargruafoto'))];
                }
                Gruas::whereId_grua($request->modificargruagrua)->update($datos);
                return $this->vista('modificargruamensaje', 'SE HA MODIFICADO CON ÉXITO.');
                break;
        }
    }

    public function eliminargrua($request)
    {
        try{
            Gruas::whereId_grua($request->eliminargruagrua)->delete();
            return $this->vista('eliminargruamensaje', 'SE HA ELIMINADO CON ÉXITO.');
        } catch (QueryException $e){
            return $this->vista('eliminargruamensaje', $e);
        }
    }

    public function vista($campo, $mensaje)
    {
        $gruas = $this->consultasprevias();
        return view('menu.gruas', [
            $campo => $mensaje,
            'gruas' => $gruas->get(),
        ]);
    }
}
