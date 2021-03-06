<?php

use Illuminate\Database\Seeder;
use App\Gruas;

class GruasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gruas = [
            0 => ['tipo_grua' => 'Forklift', 'fab_grua' => 'Heli', 'mod_grua' => 'Heli B700', 'img' => ''],
            1 => ['tipo_grua' => 'Forklift', 'fab_grua' => 'Heli', 'mod_grua' => 'Heli B900', 'img' => ''],
            2 => ['tipo_grua' => 'Reach Stacker', 'fab_grua' => 'Kalmar', 'mod_grua' => 'Kalmar B220', 'img' => ''],
            3 => ['tipo_grua' => 'Reach Stacker', 'fab_grua' => 'Kalmar', 'mod_grua' => 'Kalmar B221', 'img' => ''],
            4 => ['tipo_grua' => 'Reach Stacker', 'fab_grua' => 'Kalmar', 'mod_grua' => 'Kalmar B222', 'img' => '']
        ];

        foreach($gruas as $campo => $valor){
            Gruas::create([
                'tipo_grua' => $valor['tipo_grua'],
                'fab_grua' => $valor['fab_grua'],
                'mod_grua' => $valor['mod_grua'],
                'img' => $valor['img']
            ]);
        }
    }
}
