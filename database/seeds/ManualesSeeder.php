<?php

use Illuminate\Database\Seeder;
use App\Manuales;

class ManualesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manuales = [
            0 => ['id_grua' => '1', 'descripcion' => 'Introduccion de las grúas.', 'manual' => 'https://mega.nz'],
            1 => ['id_grua' => '2', 'descripcion' => 'Motores Diesel', 'manual' => 'https://mega.nz'],
            2 => ['id_grua' => '3', 'descripcion' => 'Nitrógeno avanzado', 'manual' => 'https://mega.nz'],
            3 => ['id_grua' => '4', 'descripcion' => 'Servicios generales', 'manual' => 'https://mega.nz'],
            4 => ['id_grua' => '5', 'descripcion' => 'Reparar una Kalmar desde cero', 'manual' => 'https://mega.nz']
        ];

        foreach($manuales as $valor){
            Manuales::create([
                'id_grua' => $valor['id_grua'],
                'descripcion' => $valor['descripcion'],
                'manual' => $valor['manual']
            ]);
        }
    }
}
