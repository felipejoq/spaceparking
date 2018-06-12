<?php

use Illuminate\Http\Request;

Route::resource('ocupacion', 'Ocupacion\OcupacionController',['only' => ['index','store']]);

Route::resource('disponibilidad', 'Disponibilidad\DisponibilidadController',['only' => ['index','store']]);

Route::get('reporte/{idplaza}/fecha/{datestart}/{dateend}', 'Plaza\PlazaController@returnPlazas');