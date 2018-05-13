<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisponibilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_plazas');
            $table->integer('plazas_libres');
            $table->integer('plazas_ocupadas');
            $table->integer('plaza_id')->unsigned();
            $table->timestamps();

            $table->foreign('plaza_id')->references('id')->on('plazas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disponibilidads');
    }
}
