<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlazasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plazas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_plaza');
            $table->string('descripcion');
            $table->string('estado_inicial');
            $table->integer('quien_edita')->unsigned()->nullable();
            $table->integer('tipo_id')->unsigned()->nullable();
            $table->integer('nodemcu_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('set null');
            $table->foreign('nodemcu_id')->references('id')->on('nodemcus')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plazas');
    }
}
