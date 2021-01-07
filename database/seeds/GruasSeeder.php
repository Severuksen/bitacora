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
            0 => ['tipo_grua' => 'Forklift', 'fab_grua' => 'Heli', 'mod_grua' => 'Heli B700'],
            1 => ['tipo_grua' => 'Forklift', 'fab_grua' => 'Heli', 'mod_grua' => 'Heli B900'],
            2 => ['tipo_grua' => 'Reach Stacker', 'fab_grua' => 'Kalmar', 'mod_grua' => 'Kalmar B220'],
            3 => ['tipo_grua' => 'Reach Stacker', 'fab_grua' => 'Kalmar', 'mod_grua' => 'Kalmar B221'],
            4 => ['tipo_grua' => 'Reach Stacker', 'fab_grua' => 'Kalmar', 'mod_grua' => 'Kalmar B222']
        ];

        foreach($gruas as $campo => $valor){
            Gruas::create([
                'tipo_grua' => $valor['tipo_grua'],
                'fab_grua' => $valor['fab_grua'],
                'mod_grua' => $valor['mod_grua']
            ]);
        }
    }
}
