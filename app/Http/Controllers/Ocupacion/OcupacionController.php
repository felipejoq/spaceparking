<?php

namespace App\Http\Controllers\Ocupacion;

use App\Disponibilidad;
use App\Ocupacion;
use App\Plaza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OcupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ocupaciones = Ocupacion::all();

        return response()->json(['data' => $ocupaciones],200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $plaza = Plaza::findOrFail($request->plaza_id);

        if($request->ocupada === "true" && $plaza->estado_inicial === "Disponible"){

                $ocupacion = new Ocupacion();

                $this->descontarDisponibilidad($request);

                //Asignamos ocupación.
                $ocupacion->ocupada = 1;
                $ocupacion->tiempo_ocupada = $request->tiempo_ocupada;

                $plaza->estado_inicial = "No disponible";


        }else if($request->ocupada === "false" && $plaza->estado_inicial === "No disponible"){

            $this->agregarDisponibilidad($request);

            $ocupacion = Ocupacion::all()
                ->where('plaza_id', $request->plaza_id)
                ->sortByDesc('created_at')
                ->first();

            //dd($ocupacion);

            //Asignamos ocupación.
            $ocupacion->ocupada = 0;
            $ocupacion->tiempo_ocupada = $request->tiempo_ocupada;

            $plaza->estado_inicial = "Disponible";
        }

        $ocupacion->plaza_id = $request->plaza_id;
        $ocupacion->nodemcu_id = $request->nodemcu_id;



        $ocupacion->save();
        $plaza->save();

        return response()->json(['data' => $ocupacion],200);
    }

    /**
     * @param Request $request
     */
    public function descontarDisponibilidad(Request $request){

        //Rescatamos la última disponibilidad registrada.
        $ultimaDisponibilidad = Disponibilidad::latest()->first();
        //Obtenemos plazas libres y le restamos una.
        $plazasLibres = $ultimaDisponibilidad->plazas_libres - 1;
        //Obtenemos plazas ocupadas y le sumamos una.
        $plazasOcupadas = $ultimaDisponibilidad->plazas_ocupadas + 1;

        //Generamos la nueva disponibilidad.
        $ultimaDisponibilidad->plazas_libres = $plazasLibres;
        $ultimaDisponibilidad->plazas_ocupadas = $plazasOcupadas;
        $ultimaDisponibilidad->plaza_id = $request->plaza_id;
        //Guardamos la nueva disponibilidad.
        $ultimaDisponibilidad->save();
    }

    /**
     * @param Request $request
     */
    public function agregarDisponibilidad(Request $request){

        //Rescatamos la última disponibilidad registrada.
        $ultimaDisponibilidad = Disponibilidad::latest()->first();
        //Obtenemos plazas libres y le sumamos una.
        $plazasLibres = $ultimaDisponibilidad->plazas_libres + 1;
        //Obtenemos plazas ocupadas y le restamos una.
        $plazasOcupadas = $ultimaDisponibilidad->plazas_ocupadas - 1;

        //Generamos la nueva disponibilidad.
        $ultimaDisponibilidad->plazas_libres = $plazasLibres;
        $ultimaDisponibilidad->plazas_ocupadas = $plazasOcupadas;
        $ultimaDisponibilidad->plaza_id = $request->plaza_id;
        //Guardamos la nueva disponibilidad.
        $ultimaDisponibilidad->save();
    }
}
