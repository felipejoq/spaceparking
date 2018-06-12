<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_reporte');
            $table->string('descripcion_reporte');
            $table->string('fechainicio');
            $table->string('fechafin');
            $table->integer('plaza_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('plaza_id')->references('id')->on('plazas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
