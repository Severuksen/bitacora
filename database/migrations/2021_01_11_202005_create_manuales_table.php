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
            $table->id('id_man');
            $table->bigInteger('id_grua');
            $table->string('descripcion', 100);
            $table->string('manual', 500);
            $table->foreign('id_grua')
                ->references('id_grua')
                ->on('gruas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
