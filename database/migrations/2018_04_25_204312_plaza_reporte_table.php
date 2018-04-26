<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlazaReporteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plazas_reporte', function (Blueprint $table) {
            $table->integer('plaza_id')->unsigned();
            $table->integer('reporte_id')->unsigned();

            $table->foreign('plaza_id')->references('id')->on('plazas');
            $table->foreign('reporte_id')->references('id')->on('reportes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plazas_reporte');
    }
}
