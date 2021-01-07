<?php

use Illuminate\Database\Seeder;
use App\Mantenimiento;

class MantenimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mantenimiento = [
            0 => ['tipo_man' => 'Mantenimiento del motor'],
            1 => ['tipo_man' => 'Mantenimiento hidraulico'],
            2 => ['tipo_man' => 'Mantenimiento de neumaticos'],
            3 => ['tipo_man' => 'Cambio de piezas'],
            4 => ['tipo_man' => 'Cambio de aceite']
        ];

        foreach($mantenimiento as $campo => $valor)
        {
            Mantenimiento::create([
                'tipo_man' => $valor['tipo_man']
            ]);
        }
    }
}
