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
            $table->string('numero_plaza')->unique();
            $table->string('descripcion');
            $table->integer('tipo_id')->unsigned();
            $table->timestamps();

            $table->foreign('tipo_id')->references('id')->on('tipos');

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
