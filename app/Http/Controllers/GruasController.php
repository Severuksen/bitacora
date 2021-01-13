<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Gruas;
use App\Servicios;
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
    public function getgruas($id_grua)
    {
        $servicios = Servicios::select(['gruas.id_grua', 'gruas.tipo_grua', 'gruas.mod_grua', 'servicios.horas', 'servicios.fecha', 'mantenimiento.tipo_man', 'gruas.img', 'servicios.observaciones', 'gruas.estado', 'manuales.descripcion', 'manuales.manual'])
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
        $gruas = Gruas::select(['id_grua', 'mod_grua'])->get();
        return view('menu', ['gruas' => $gruas]);
    }

    public function postmenu(Request $request)
    {

        switch(true){
            case (isset($request->agregargrua)):
                return $this->agregargrua($request);
                break;
            case (isset($request->seleccionargrua)):
                return $this->seleccionargrua($request);
                break;
            case (isset($request->modificargrua)):
                return $this->modificargrua($request);
                break;
            case (isset($request->eliminargrua)):
                return $this->eliminargrua($request);
                break;
            case (isset($request->agregarman)):
                return $this->agregarman($request);
                break;
            case (isset($request->modificarman)):
                return $this->modificarman($request);
                break;
            case (isset($request->eliminarman)):
                return $this->eliminarman($request);
                break;
        }
    }

    public function img($foto)
    {
        return "data:image/".$foto->extension().";base64,".base64_encode(file_get_contents($foto));
    }

    public function vacio(array $campos, $request)
    {
        foreach($campos as $valor)
        {
            if(blank($request[$valor]))
            {
                return true;
            }
        }
    }

    public function agregargrua($request)
    {
        $gruas  = Gruas::select(['id_grua', 'mod_grua']);
        $campos = ['agregargruatipo', 'agregargruafabricante', 'agregargruamodelo', 'agregargruaestado', 'agregargruafoto'];

        if($this->vacio($campos, $request)){
            $gruas = $gruas->get();
            return view('menu', ['agregargruamensaje' => 'NO DEBES DEJAR CAMPOS VACIOS.', 'gruas' => $gruas]);
        } else {
            switch ($request->file('agregargruafoto')->extension()) {
                case 'jpg':
                case 'png':
                    $img = $this->img($request->file('agregargruafoto'));
                    break;

                default:
                    return view('menu', ['agregargruamensaje' => 'EL FORMATO DE LA IMAGEN NO ES COMPATIBLE', 'gruas' => $gruas]);
                    break;
            }
            Gruas::create([
                'tipo_grua' => e($request->agregargruatipo),
                'fab_grua' => e($request->agregargruafabricante),
                'mod_grua' => e($request->agregargruamodelo),
                'estado' => e($request->agregargruaestado),
                'img' => $img
            ]);
            $gruas = $gruas->get();
            return view('menu', ['agregargruamensaje' => 'SE HA AGREGADO LA GRÚA.', 'gruas' => $gruas]);
        }
    }

    public function seleccionargrua($request)
    {
        $grua = Gruas::select(['tipo_grua', 'fab_grua', 'mod_grua', 'estado'])->whereId_grua($request->modificargruagrua)->first();
        return [$grua->tipo_grua, $grua->fab_grua, $grua->mod_grua, $grua->estado];
    }

    public function modificargrua($request)
    {
        $gruas  = Gruas::select(['id_grua', 'mod_grua']);
        $campos = ['modificargruatipo', 'modificargruafabricante', 'modificargruamodelo', 'modificargruaestado'];

        switch($this->vacio($campos, $request))
        {
            case true:
                $gruas = $gruas->get();
                return view('menu', ['modificargruamensaje' => 'NO DEBES DEJAR CAMPOS VACIOS.', 'gruas' => $gruas]);
                break;
            case false:
                if($this->vacio(['modificargruafoto'], $request))
                {
                    $datos = ['tipo_grua' => $request->modificargruatipo, 'fab_grua' => $request->modificargruafabricante, 'mod_grua' => $request->modificargruamodelo, 'estado' => $request->modificargruaestado];
                } else {
                    $datos = ['tipo_grua' => $request->modificargruatipo, 'fab_grua' => $request->modificargruafabricante, 'mod_grua' => $request->modificargruamodelo, 'estado' => $request->modificargruaestado, 'img' => $this->img($request->file('modificargruafoto'))];
                }
                Gruas::whereId_grua($request->modificargruagrua)->update($datos);
                $gruas = $gruas->get();
                return view('menu', ['modificargruamensaje' => 'SE HA MODIFICADO CON ÉXITO.', 'gruas' => $gruas]);
                break;
        }
    }

    public function eliminargrua($request)
    {
        $gruas = Gruas::select(['id_grua', 'mod_grua']);
        try{
            Gruas::whereId_grua($request->eliminargruagrua)->delete();
            $gruas = $gruas->get();
            return view('menu', ['eliminargruamensaje' => 'SE HA ELIMINADO CON ÉXITO.', 'gruas' => $gruas]);
        } catch (QueryException $e){
            $gruas = $gruas->get();
            return view('menu', ['eliminargruamensaje' => $e, 'gruas' => $gruas]);
        }
    }

    public function agregarman($request)
    {
        $gruas  = Gruas::select(['id_grua', 'mod_grua']);
        $campos = ['agregarmanmantenimiento', 'agregarmanfecha', 'agregarmanhoras', 'agregarmanobservaciones', 'agregarmanestado'];

        if($this->vacio($campos, $request)){
            $gruas = $gruas->get();
            return view('menu', ['agregarmanmensaje' => 'NO DEBES DEJAR CAMPOS VACIOS.', 'gruas' => $gruas]);
        } else {
            /* Servicios::create([
                'fecha' => e(),
                'id_grua' => e(),
                'id_man' => e(),
                'horas' => e(),
                'observaciones' => e(),
                'estado' => e()
            ]);
            $gruas = $gruas->get();
            return view('menu', ['agregargruamensaje' => 'SE HA AGREGADO LA GRÚA.', 'gruas' => $gruas]); */
        }

        return dd($request);
    }

}
