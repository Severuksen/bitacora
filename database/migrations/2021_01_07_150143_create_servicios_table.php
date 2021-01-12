<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id('id_srv');
            $table->date('fecha');
            $table->bigInteger('id_grua')->unsigned();
            $table->bigInteger('id_man')->unsigned();
            $table->integer('horas')->unsigned()->default(0);
            $table->string('observaciones', 200)->nullable();
            $table->string('estado', 8)->default('ACTIVO');
            $table->foreign('id_grua')
                ->references('id_grua')
                ->on('gruas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_man')
                    ->references('id_man')
                    ->on('mantenimiento')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('servicios');
    }
}
