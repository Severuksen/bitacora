<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GruasSeeder::class);
        $this->call(MantenimientoSeeder::class);
        $this->call(ServiciosSeeder::class);
        $this->call(ManualesSeeder::class);
    }
}
