<?php

use Illuminate\Http\Request;

Route::resource('ocupacion', 'Ocupacion\OcupacionController',['only' => ['index','store']]);

Route::resource('disponibilidad', 'Disponibilidad\DisponibilidadController',['only' => ['index','store']]);

Route::get('listaplazas', 'Plaza\PlazaController@returnPlazas');