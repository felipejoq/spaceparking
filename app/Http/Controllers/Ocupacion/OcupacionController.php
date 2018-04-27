<?php

namespace App\Http\Controllers\Ocupacion;

use App\Disponibilidad;
use App\Ocupacion;
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
        //$ocupaciones = Ocupacion::with(['plaza','nodemcu'])->get();

        //return response()->json(['data' => $ocupaciones],200);

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
        $ocupacion = new Ocupacion();
        if($request->ocupada === "true"){

            $this->descontarDisponibilidad($request);

            //Asignamos ocupación.
            $ocupacion->ocupada = 1;

        }else{

            $this->agregarDisponibilidad($request);

            //Asignamos ocupación.
            $ocupacion->ocupada = 0;
        }

        $ocupacion->plaza_id = $request->plaza_id;
        $ocupacion->nodemcu_id = $request->nodemcu_id;



        $ocupacion->save();

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
