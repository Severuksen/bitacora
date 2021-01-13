<?php

namespace App\Http\Controllers;

use App\Mantenimiento;
use App\Gruas;
use App\Servicios;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function consultasprevias()
    {
        $gruas         = Gruas::select(['id_grua', 'mod_grua']);
        $servicios     = Gruas::select(['servicios.id_srv', 'servicios.fecha', 'gruas.mod_grua'])->join('servicios', 'servicios.id_grua', '=', 'gruas.id_grua')->orderBy('gruas.mod_grua', 'ASC');
        $mantenimiento = Mantenimiento::select(['id_man', 'tipo_man']);
        return [$gruas, $mantenimiento, $servicios];
    }

    public function getmenu()
    {
        return $this->vista('','');
    }

    public function postmenu(Request $request)
    {
        switch(true){
            case (isset($request->agregarman)):
                return $this->agregarman($request);
                break;
            case (isset($request->modificarman)):
                return $this->modificarman($request);
                break;
            case (isset($request->seleccionargrua)):
                return $this->seleccionargrua($request->modificarmangrua);
                break;
            case (isset($request->eliminarman)):
                return $this->eliminarman($request);
                break;
        }
    }

    public function agregarman($request)
    {
        $campos = ['agregarmangrua', 'agregarmanmantenimiento', 'agregarmanfecha', 'agregarmanhoras', 'agregarmanobservaciones', 'agregarmanestado'];

        if(vacio($campos, $request)){
            return $this->vista('agregarmanmensaje', 'NO DEBES DEJAR CAMPOS VACIOS.');
        } else {
            Servicios::create([
                'fecha' => e($request->agregarmanfecha),
                'id_grua' => e($request->agregarmangrua),
                'id_man' => e($request->agregarmanmantenimiento),
                'horas' => e($request->agregarmanhoras),
                'observaciones' => e($request->agregarmanobservaciones),
                'estado' => e($request->agregarmanestado)
            ]);
            return $this->vista('agregarmanmensaje', 'MANTENIMIENTO AGREGADO.');
        }
    }

    public function modificarman($request)
    {

        $campos = ['modificarmangrua', 'modificarmanmantenimiento', 'modificarmanfecha', 'modificarmanhoras', 'modificarmanobservaciones', 'modificarmanestado'];

        switch(vacio($campos, $request))
        {
            case true:
                return $this->vista('modificarmanmensaje','NO DEBES DEJAR CAMPOS VACIOS.');
                break;
            case false:
                Servicios::whereId_srv($request->modificarmangrua)->update([
                    'id_man' => e($request->modificarmanmantenimiento),
                    'fecha' => e($request->modificarmanfecha),
                    'horas' => e($request->modificarmanhoras),
                    'observaciones' => e($request->modificarmanobservaciones),
                    'estado' => e($request->modificarmanestado)
                ]);
                return $this->vista('modificarmanmensaje','MANTENIMIENTO MODIFICADO.');
                break;
        }
    }

    public function seleccionargrua($id)
    {
        $srv = Servicios::select(['id_man', 'fecha', 'horas', 'observaciones', 'estado'])->whereId_srv($id)->first();
        return [$srv->id_man, $srv->fecha, $srv->horas, $srv->observaciones, $srv->estado];
    }

    public function eliminarman($request)
    {
        try{
            Servicios::whereId_srv($request->eliminarmangrua)->delete();
            return $this->vista('eliminarmanmensaje', 'SE HA ELIMINADO CON ÉXITO.');
        } catch (QueryException $e){
            return $this->vista('eliminarmanmensaje', $e);
        }

    }

    public function vista($campo, $mensaje)
    {
        [$gruas, $mantenimiento, $servicios] = $this->consultasprevias();
        return view('menu.mantenimiento', [
            $campo => $mensaje,
            'gruas' => $gruas->get(),
            'mantenimiento' => $mantenimiento->get(),
            'servicios' => $servicios->get()
        ]);
    }
}
