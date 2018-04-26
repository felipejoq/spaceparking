<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcupacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocupacions', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('ocupada');
            $table->integer('plaza_id')->unsigned();
            $table->integer('nodemcu_id')->unsigned();
            $table->timestamps();

            $table->foreign('plaza_id')->references('id')->on('plazas');
            $table->foreign('nodemcu_id')->references('id')->on('nodemcus');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ocupacions');
    }
}