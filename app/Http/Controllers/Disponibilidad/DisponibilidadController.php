<?php

namespace App\Http\Controllers\Disponibilidad;

use App\Disponibilidad;
use App\Http\Controllers\Controller;

class DisponibilidadController extends Controller
{
    public function index(){
        $disponibilidad = Disponibilidad::latest()->first();
        return response()->json(['disponibilidad' => $disponibilidad],200);
    }
}
