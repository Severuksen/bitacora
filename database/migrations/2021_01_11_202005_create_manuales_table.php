<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manuales', function (Blueprint $table) {
            $table->increments('id_man');
            $table->bigInteger('id_grua')->unsigned();
            $table->string('nombre', 47);
            $table->string('descripcion', 222);
            $table->string('enlace', 100);
            $table->foreign('id_grua')
                ->references('id_grua')
                ->on('gruas')
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
        Schema::dropIfExists('manuales');
    }
}
