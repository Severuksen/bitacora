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
            case (isset($request->agregar)):
                return $this->agregargrua($request);
                break;
            case (isset($request->seleccionargrua)):
                return $this->seleccionargrua($request);
                break;
            case (isset($request->modificar)):
                return $this->modificargrua($request);
                break;
            case (isset($request->eliminar)):
                return $this->eliminargrua($request);
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
        $campos = ['agregartipo', 'agregarfabricante', 'agregarmodelo', 'agregarestado', 'agregarfoto'];

        if($this->vacio($campos, $request)){
            $gruas = $gruas->get();
            return view('menu', ['agregarmensaje' => 'NO DEBES DEJAR CAMPOS VACIOS.', 'gruas' => $gruas]);
        } else {
            switch ($request->file('agregarfoto')->extension()) {
                case 'jpg':
                case 'png':
                    $img = $this->img($request->file('agregarfoto'));
                    break;

                default:
                    return view('menu', ['agregarmensaje' => 'EL FORMATO DE LA IMAGEN NO ES COMPATIBLE', 'gruas' => $gruas]);
                    break;
            }
            Gruas::create([
                'tipo_grua' => e($request->agregartipo),
                'fab_grua' => e($request->agregarfabricante),
                'mod_grua' => e($request->agregarmodelo),
                'estado' => e($request->agregarestado),
                'img' => $img
            ]);
            $gruas = $gruas->get();
            return view('menu', ['agregarmensaje' => 'SE HA AGREGADO LA GRÚA.', 'gruas' => $gruas]);
        }

    }

    public function seleccionargrua($request)
    {
        $grua = Gruas::select(['tipo_grua', 'fab_grua', 'mod_grua', 'estado'])->whereId_grua($request->modificargrua)->first();
        return [$grua->tipo_grua, $grua->fab_grua, $grua->mod_grua, $grua->estado];
    }

    public function modificargrua($request)
    {
        $gruas  = Gruas::select(['id_grua', 'mod_grua']);
        $campos = ['modificartipo', 'modificarfabricante', 'modificarmodelo', 'modificarestado'];

        switch($this->vacio($campos, $request))
        {
            case true:
                $gruas = $gruas->get();
                return view('menu', ['modificarmensaje' => 'NO DEBES DEJAR CAMPOS VACIOS.', 'gruas' => $gruas]);
                break;
            case false:
                if($this->vacio(['modificarfoto'], $request))
                {
                    $datos = ['tipo_grua' => $request->modificartipo, 'fab_grua' => $request->modificarfabricante, 'mod_grua' => $request->modificarmodelo, 'estado' => $request->modificarestado];
                } else {
                    $datos = ['tipo_grua' => $request->modificartipo, 'fab_grua' => $request->modificarfabricante, 'mod_grua' => $request->modificarmodelo, 'estado' => $request->modificarestado, 'img' => $this->img($request->file('modificarfoto'))];
                }
                Gruas::whereId_grua($request->modificargrua)->update($datos);
                $gruas = $gruas->get();
                return view('menu', ['modificarmensaje' => 'SE HA MODIFICADO CON ÉXITO.', 'gruas' => $gruas]);
                break;
        }
    }

    public function eliminargrua($request)
    {
        $gruas = Gruas::select(['id_grua', 'mod_grua']);
        try{
            Gruas::whereId_grua($request->eliminargrua)->delete();
            $gruas = $gruas->get();
            return view('menu', ['eliminarmensaje' => 'SE HA ELIMINADO CON ÉXITO.', 'gruas' => $gruas]);
        } catch (QueryException $e){
            $gruas = $gruas->get();
            return view('menu', ['eliminarmensaje' => $e, 'gruas' => $gruas]);
        }
    }

}
