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
            0 => ['id_grua' => '1', 'descripcion' => 'Introduccion de las grúas.', 'nombre' => 'https://mega.nz', 'enlace' => '/storage/archivo.pdf'],
            1 => ['id_grua' => '2', 'descripcion' => 'Motores Diesel', 'nombre' => 'https://mega.nz', 'enlace' => '/storage/archivo.pdf'],
            2 => ['id_grua' => '3', 'descripcion' => 'Nitrógeno avanzado', 'nombre' => 'https://mega.nz', 'enlace' => '/storage/archivo.pdf'],
            3 => ['id_grua' => '4', 'descripcion' => 'Servicios generales', 'nombre' => 'https://mega.nz', 'enlace' => '/storage/archivo.pdf'],
            4 => ['id_grua' => '5', 'descripcion' => 'Reparar una Kalmar desde cero', 'nombre' => 'https://mega.nz', 'enlace' => '/storage/archivo.pdf']
        ];

        foreach($manuales as $valor){
            Manuales::create([
                'id_grua' => $valor['id_grua'],
                'nombre' => $valor['nombre'],
                'descripcion' => $valor['descripcion'],
                'enlace' => $valor['enlace']
            ]);
        }
    }
}
