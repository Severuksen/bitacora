<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gruas', function (Blueprint $table) {
            $table->id('id_grua');
            $table->string('tipo_grua', 13);
            $table->string('fab_grua', 30);
            $table->string('mod_grua', 50);
            $table->integer('horas');
            $table->string('img', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gruas');
    }
}
