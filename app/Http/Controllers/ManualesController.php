<?php

namespace App\Http\Controllers;

use App\Gruas;
use App\Manuales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManualesController extends Controller
{

    public function getmenu()
    {
        return $this->vista('', '');
    }

    public function postmenu(Request $request)
    {
        switch(true){
            case (isset($request->agregarmanu)):
                return $this->agregarmanu($request);
                break;
            case (isset($request->seleccionarmanu)):
                return $this->seleccionarmanu($request->modificarmanumanual);
                break;
            case (isset($request->modificarmanu)):
                return $this->modificarmanu($request);
                break;
            case (isset($request->eliminarmanu)):
                return $this->eliminarmanu($request);
                break;
        }
    }

    public function pdf($metodo, $request)
    {
        switch($metodo)
        {
            case 'agregar':
                $archivo = file_get_contents($request->file('agregarmanupdf'));
                $nombre  = $request->agregarmanugrua."-".$request->agregarmanunombre.".pdf";
                Storage::disk('public')->put($nombre, $archivo);
                return "/storage/".$nombre;
                break;
            case 'modificar':
                $archivo = file_get_contents($request->file('modificarmanupdf'));
                $nombre  = $request->modificarmanugrua."-".$request->modificarmanunombre.".pdf";

                $manuales = Manuales::select(['gruas.id_grua', 'manuales.nombre'])->join('gruas', 'gruas.id_grua', '=', 'manuales.id_grua')->whereId_man($request->modificarmanumanual)->first();
                Storage::disk('public')->delete($manuales->id_grua."-".$request->modificarmanunombre.".pdf");
                Storage::disk('public')->put($nombre, $archivo);
                return "/storage/".$nombre;
                break;
        }
    }

    public function vista($campo, $mensaje)
    {
        $gruas    = Gruas::select(['id_grua', 'mod_grua'])->get();
        $manuales = Manuales::select(['manuales.id_man', 'manuales.nombre', 'gruas.mod_grua'])->join('gruas', 'gruas.id_grua', '=', 'manuales.id_grua')->orderBy('gruas.mod_grua', 'ASC')->get();
        return view('menu.manuales', [
            $campo => $mensaje,
            'gruas' => $gruas,
            'manuales' => $manuales
        ]);
    }

    public function agregarmanu($request)
    {
        $campos = ['agregarmanugrua', 'agregarmanunombre', 'agregarmanudescripcion', 'agregarmanupdf'];

        if(vacio($campos, $request))
        {
            return $this->vista('agregarmanumensaje', 'NO DEBES DEJAR CAMPOS VACIOS.');
        } else {
            switch ($request->file('agregarmanupdf')->extension()){
                case 'pdf':
                    $enlace = $this->pdf('agregar', $request);
                    break;
                default:
                    return $this->vista('agregarmanumensaje', 'EL FORMATO DEL ARCHIVO NO ES COMPATIBLE.');
                    break;
            }
            Manuales::create([
                'id_grua' => e($request->agregarmanugrua),
                'nombre' => e($request->agregarmanunombre),
                'descripcion' => e($request->agregarmanudescripcion),
                'enlace' => $enlace
            ]);
            return $this->vista('agregarmanumensaje', 'SE HA AGREGADO EL MANUAL.');
        }
    }

    public function seleccionarmanu($id)
    {
        $manual = Manuales::select(['id_grua', 'nombre', 'descripcion'])->whereId_man($id)->first();
        return [$manual->id_grua, $manual->nombre, $manual->descripcion];
    }

    public function modificarmanu($request)
    {
        $campos = ['modificarmanugrua', 'modificarmanunombre', 'modificarmanudescripcion'];

        switch(vacio($campos, $request))
        {
            case true:
                return $this->vista('modificarmanumensaje', 'NO DEBES DEJAR CAMPOS VACIOS.');
                break;
            case false:
                if(vacio(['modificarmanupdf'], $request))
                {
                    $datos = ['id_grua' => $request->modificarmanugrua, 'nombre' => $request->modificarmanunombre, 'descripcion' => $request->modificarmanudescripcion];
                } else {
                    switch ($request->file('modificarmanupdf')->extension()){
                        case 'pdf':
                            $enlace = $this->pdf('modificar', $request);
                            break;
                        default:
                            return $this->vista('modificarmanumensaje', 'EL FORMATO DEL ARCHIVO NO ES COMPATIBLE.');
                            break;
                    }
                    $datos = ['id_grua' => $request->modificarmanugrua, 'nombre' => $request->modificarmanunombre, 'descripcion' => $request->modificarmanudescripcion, 'enlace' => $enlace];
                }
                Manuales::whereId_man($request->modificarmanumanual)->update($datos);
                return $this->vista('modificarmanumensaje', 'SE HA MODIFICADO CON ÉXITO.');
                break;
        }
    }
}
