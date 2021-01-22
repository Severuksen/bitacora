<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Gruas;
use App\Servicios;
use App\Manuales;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class GruasController extends Controller
{
    /**
     * Devuelve una lista completa de grúas.
     */
    public function getbusqueda(): View
    {
        $gruas = Gruas::get();
        return view('busqueda', ['gruas' => $gruas]);
    }

    /**
     * Devuelve una lista de grúas basadas en la busqueda.
     */
    public function postbusqueda(Request $request): View
    {
        $query  = Gruas::select(['id_grua', 'tipo_grua', 'img', 'mod_grua']);

        if($request->busqueda != NULL)
        {
            $query = $query->where('mod_grua', 'LIKE', "%$request->busqueda%");
        }


        if($query->count() == "")
        {
            return view('busqueda', [
                'busqueda' => $request->busqueda
            ]);
        } else {
            return view('busqueda', [
                'gruas' => $query->get(),
                'busqueda' => $request->busqueda
            ]);
        }
    }

    /**
     * Funcion de recepcion de las peticiones $_GET de las gruas por su id. Devuelve la informacion de la grua solicitada por su id_grua.
     */
    public function getgrua(int $id_grua): View
    {
        $consulta  = Servicios::whereId_grua(e($id_grua))->orderBy('fecha', 'DESC');
        $servicios = $consulta->first();
        $historial = $consulta->get();

        $manuales  = Manuales::whereId_grua($id_grua)->get();

        switch(true)
        {
            case ($servicios == NULL):
                $gruas = Gruas::whereId_grua(e($id_grua))->first();
                return view('gruas', ['servicios' => $gruas, 'mensaje' => 'No posee ningun mantenimiento registrado.']);
            break;
            default:
                return view('gruas', ['servicios' => $servicios, 'historial' => $historial, 'manuales' => $manuales]);
            break;
        }
    }

    /**
     * Devuelve la vista del menu de opciones.
     */
    public function getmenu(): View
    {
        return $this->vista('', '');
    }

    /**
     * Recibe y distribuye las distintas peticiones al controlador.
     */
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

    /**
     * Almacena las imagenes cargadas por el usuario en el Storage.
     */
    public function img(object $request, int $id): string
    {

        switch(true)
        {
            case (isset($request->agregargruafoto)):
                $foto   = $request->file('agregargruafoto');
                $modelo = str_replace(" ", "", $request->agregargruamodelo);
            break;
            case (isset($request->modificargruafoto)):
                $foto   = $request->file('modificargruafoto');
                $modelo = str_replace(" ", "", $request->modificargruamodelo);
            break;
        }
        $extension = $foto->extension();
        switch($extension){
            case 'jpg':
                $img = imagecreatefromjpeg($foto);
                break;
            case 'png':
                $img = imagecreatefrompng($foto);
                break;
        }

        $nombre = $id."-".$modelo.".jpg";
        imagejpeg($img, storage_path().'\\app\\upload\\'.$nombre, 70);
        imagedestroy($img);
        return "/upload/".$nombre;
    }

    /**
     * Devuelve la vista correspondiente.
     */
    public function vista(string $campo, string $mensaje): View
    {
        $gruas = Gruas::get();
        return view('menu.gruas', [
            $campo => $mensaje,
            'gruas' => $gruas,
        ]);
    }

    /**
     * Almacena una nueva grua en la BD.
     */
    public function agregargrua($request): View
    {
        $campos = ['agregargruatipo', 'agregargruafabricante', 'agregargruamodelo', 'agregargruafoto'];

        if(vacio($campos, $request))
        {
            return $this->vista('agregargruamensaje', 'NO DEBES DEJAR CAMPOS VACIOS.');
        } else {
            switch ($request->file('agregargruafoto')->extension()){
                case 'jpg':
                case 'png':
                    $id  = Gruas::create(['tipo_grua' => e($request->agregargruatipo), 'fab_grua' => e($request->agregargruafabricante), 'mod_grua' => e($request->agregargruamodelo)])->id;
                    $img = $this->img($request, $id);
                    Gruas::whereId_grua($id)->update(['img' => $img]);
                    break;
                default:
                    return $this->vista('agregargruamensaje', 'EL FORMATO DE LA IMAGEN NO ES COMPATIBLE.');
                    break;
            }
            return $this->vista('agregargruamensaje', 'SE HA AGREGADO LA GRÚA.');
        }
    }

    /**
     * Devuelve los valores necesarios para modificar una grúa.
     */
    public function seleccionargrua(int $id): Array
    {
        $grua = Gruas::whereId_grua($id)->first();
        return [$grua->tipo_grua, $grua->fab_grua, $grua->mod_grua];
    }

    /**
     * Almacena las modificaciones realizadas a una grúa.
     */
    public function modificargrua($request): View
    {
        switch(vacio(['modificargruatipo', 'modificargruafabricante', 'modificargruamodelo'], $request))
        {
            case true:
                return $this->vista('modificargruamensaje', 'NO DEBES DEJAR CAMPOS VACIOS.');
                break;
            case false:
                if(vacio(['modificargruafoto'], $request))
                {
                    $datos = ['tipo_grua' => $request->modificargruatipo, 'fab_grua' => $request->modificargruafabricante, 'mod_grua' => $request->modificargruamodelo];
                } else {
                    $datos = ['tipo_grua' => $request->modificargruatipo, 'fab_grua' => $request->modificargruafabricante, 'mod_grua' => $request->modificargruamodelo, 'img' => $this->img($request, $request->modificargruagrua)];
                }
                Gruas::whereId_grua($request->modificargruagrua)->update($datos);
                return $this->vista('modificargruamensaje', 'SE HA MODIFICADO CON ÉXITO.');
                break;
        }
    }

    /**
     * Elimina una grúa.
     */
    public function eliminargrua($request): View
    {
        try{
            Gruas::whereId_grua($request->eliminargruagrua)->delete();
            return $this->vista('eliminargruamensaje', 'SE HA ELIMINADO CON ÉXITO.');
        } catch (QueryException $e){
            return $this->vista('eliminargruamensaje', $e);
        }
    }
}
