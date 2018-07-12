<?php

namespace App\Http\Controllers\Plaza;

use App\Ocupacion;
use App\Plaza;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlazaReporteController extends Controller
{
    public function consolidado($year){

        $fechaPide = Carbon::parse('01-01-'.$year)->format('d-m-Y');
        $fechaLimite = Carbon::now()->format('d-m-Y');

        $inicio = new Carbon($fechaPide);
        $inicio->format('d-m-Y');
        $fin = new Carbon($fechaLimite);
        $fin->format('d-m-Y');
        $resultado = [];
        $resultadopormes = [];
        $cuenta = 1;

        $tiempoporplaza = 0;

        $plazas = Plaza::all()->load('tipo');
        $ocupaciones = Ocupacion::all();

        while ($inicio <= $fin){

            $i = Carbon::parse($inicio);
            $f = Carbon::parse($inicio)->addMonth(1)->subDay(1);

            $contador2 = 0;
            foreach ($plazas as $plaza){
                $ocupacionesCiclos = $ocupaciones
                    ->where('created_at','>=',$i)
                    ->where('created_at','<=',$f)
                    ->where('plaza_id','=', $plaza->id);

                ;

                foreach ($ocupacionesCiclos as $ocupacionesCiclo){
                    $tiempoporplaza = $ocupacionesCiclo->tiempo_ocupada + $tiempoporplaza;
                }

                $tiempoporplaza = round($tiempoporplaza/3600,1, PHP_ROUND_HALF_EVEN);

                $resultado[] = [
                    'plaza' => $plaza->numero_plaza,
                    'tipo_plaza' => $plaza->tipo->nombre,
                    'tiempo_fue_ocupada' => $tiempoporplaza,
                    'veces_que_fue_ocupada' => $ocupacionesCiclos->count(),
                    'inicio' => $inicio->format('d-m-Y'),
                    'fin' => Carbon::parse($inicio)->addMonth(1)->subDay(1)->format('d-m-Y')
                ];

                $tiempoporplaza = 0;

                $contador2++;
            }

            $resultadopormes[] = $resultado;

            $resultado = null;

            $cuenta++;
            $inicio->addMonth(1);

        }

        return response()->json($resultadopormes,200);

    }
}
