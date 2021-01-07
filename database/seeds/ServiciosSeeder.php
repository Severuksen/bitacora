<?php

use Illuminate\Database\Seeder;
use App\Servicios;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicios = [
            0 => ['fecha' => date('Y-m-d'), 'id_grua' => '1', 'id_man' => '1', 'observaciones' => 'Motor funcionando con deficiencia.'],
            1 => ['fecha' => date('Y-m-d'), 'id_grua' => '2', 'id_man' => '2', 'observaciones' => 'Dos lineas nuevas.'],
            2 => ['fecha' => date('Y-m-d'), 'id_grua' => '3', 'id_man' => '3', 'observaciones' => 'Tuercas dañadas.'],
            3 => ['fecha' => date('Y-m-d'), 'id_grua' => '4', 'id_man' => '2', 'observaciones' => 'Pirelli por Goodyear'],
            4 => ['fecha' => date('Y-m-d'), 'id_grua' => '5', 'id_man' => '5', 'observaciones' => '']
        ];

        foreach($servicios as $campo => $valor){
            Servicios::create([
                'fecha' => $valor['fecha'],
                'id_grua' => $valor['id_grua'],
                'id_man' => $valor['id_man'],
                'observaciones' => $valor['observaciones']
            ]);
        }
    }
}
