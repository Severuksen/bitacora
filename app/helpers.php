<?php

if (!function_exists('busqueda'))
{
    function busqueda($consulta)
    {
        $i = 0;
        foreach($consulta as $valor)
        {
            $id_grua[$i] = $valor->id_grua;
            $horas[$i]   = $valor->horas;
            $modelo[$i]  = $valor->mod_grua;
            $img[$i]     = $valor->img;
            $tipo[$i]    = $valor->tipo_grua;
            $estado[$i]    = $valor->estado;
            $i++;
        }

        return (isset($modelo))? [$id_grua, $modelo, $img, $horas, $tipo, $estado]: NULL;
    }
}
