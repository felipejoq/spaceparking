<?php

use Illuminate\Http\Request;

Route::resource('ocupacion', 'Ocupacion\OcupacionController',['only' => ['index','store']]);
