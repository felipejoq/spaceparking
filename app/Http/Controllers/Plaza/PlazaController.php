<?php

namespace App\Http\Controllers\Plaza;

use App\Disponibilidad;
use App\Nodemcu;
use App\Ocupacion;
use App\Plaza;
use App\Tipo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class PlazaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listadenodemcu = Nodemcu::all();
        $listadeplazas = Plaza::all()->load('nodemcu','tipo');
        $listadetipos = Tipo::all();

        return view('admin.plaza',compact(['listadenodemcu','listadeplazas','listadetipos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nodemcu_id' => 'min:1|numeric|required',
            'numero_plaza' => 'unique:plazas',
            'descripcion' => 'min:10',
            'estado_inicial' => 'min:1|required',
            'tipo_id' => 'required|min:1|numeric'
        ];

        $this->validate($request,$rules);

        $plazacreada = new Plaza();
        $plazacreada->nodemcu_id = $request->nodemcu_id;
        $plazacreada->numero_plaza = $request->numero_plaza;
        $plazacreada->estado_inicial = $request->estado_inicial;
        $plazacreada->quien_edita = $request->estado_inicial == "Disponible" ? '0' : $request->quien_edita;
        $plazacreada->descripcion = $request->descripcion;
        $plazacreada->tipo_id = $request->tipo_id;

        $plazacreada->save();

        Disponibilidad::latest()->first()->agregaPlazaDisponibilidad($plazacreada);

        $listadenodemcu = Nodemcu::all();
        $listadeplazas = Plaza::all();
        $listadetipos = Tipo::all();

        return redirect()
            ->route('plazas.index',compact(['listadenodemcu','listadeplazas','listadetipos']))
            ->with('flash','¡La plaza fue creada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plaza  $plaza
     * @return \Illuminate\Http\Response
     */
    public function show(Plaza $plaza)
    {
        //$plaza = $plaza->with('tipo')->with('nodemcu')->find($plaza->id);

        $plaza->load('tipo','nodemcu');

        return response()->json($plaza,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plaza  $plaza
     * @return \Illuminate\Http\Response
     */
    public function edit(Plaza $plazaedit)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plaza  $plaza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plaza $plaza)
    {
        $rules = [
            'nodemcu_id' => 'min:1|numeric|required',
            'numero_plaza' => 'required',
            'descripcion' => 'required',
            'estado_inicial' => 'min:1|required',
            'tipo_id' => 'required|min:1|numeric'
        ];

        $this->validate($request,$rules);

        Disponibilidad::latest()->first()->actualizaPlazaDisponibilidad($request, $plaza);

        $plaza->numero_plaza = $request->input('numero_plaza');
        $plaza->descripcion = $request->input('descripcion');
        $plaza->nodemcu_id = $request->input('nodemcu_id');
        $plaza->tipo_id = $request->input('tipo_id');
        $plaza->estado_inicial = $request->input('estado_inicial');
        $plaza->quien_edita = $request->estado_inicial == "Disponible" ? '0' : $request->quien_edita;

        $plaza->save();

        $listadenodemcu = Nodemcu::all();
        $listadeplazas = Plaza::all();
        $listadetipos = Tipo::all();

        return redirect()->route('plazas.index',compact(['listadenodemcu','listadeplazas','listadetipos']))
            ->with('flash2','¡La plaza fue editada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plaza  $plaza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plaza $plaza)
    {
        Disponibilidad::latest()->first()->eliminaPlazaDisponibilidad($plaza);

        $plaza = $plaza->delete();

        $listadenodemcu = Nodemcu::all();
        $listadeplazas = Plaza::all();
        $listadetipos = Tipo::all();

        return redirect()->route('plazas.index',compact(['listadenodemcu','listadeplazas','listadetipos']))
            ->with('flash3','¡La plaza fue eliminada!');
    }

    public function returnPlazas($idplaza, $datestart, $dateend){

        $inicio = $datestart;
        $fin = $dateend;

        $plaza = Plaza::findOrFail($idplaza);
        $fechainicio = Carbon::parse($datestart)->format("Y-m-d H:i:s");
        $dateend = $dateend . " 23:59:00";
        $fechafin = Carbon::parse($dateend)->format("Y-m-d H:i:s");

        if($inicio != $fin){

            /**
             * Pasos para lograr el array
             * Buscar la primera fecha y sumar sus tiempos ocupadas.
             * Sumar un dia a la fecha y verificar si es menor o igual a la fecha de fin.
             * Si es menor seguir sumando los tiempos y agregando las fechas al array.
             * Hasta llegar a la fecha fin.
             */

            $ocupas = Ocupacion::all()
                ->where('created_at','>=', $fechainicio)
                ->where('created_at','<=', $fechafin)
                ->where('plaza_id', $idplaza);

            $i = new Carbon($fechainicio);
            $total = 0;
            $result = [];
            $lafecha = null;

            while($i <= $fechafin){

                foreach ($ocupas as $ocupa) {
                    if ($ocupa->created_at->format("Y-m-d") == $i->format("Y-m-d")) {
                        $total = $total + $ocupa->tiempo_ocupada;
                        $lafecha = $i->format("d-m-Y");
                    }
                }

                // round(number,precision,mode)
                if($total > 0){
                    $result[] = [
                        "fecha" => $lafecha,
                        "tiempo" => round($total / 3600, 1,PHP_ROUND_HALF_EVEN)
                    ];

                    $total = 0;
                }else{
                    $result[] = [
                        "fecha" => $i->format("d-m-Y"),
                        "tiempo" => 0
                    ];
                }

                $i->addDay(1);
            }

            return response()->json($result,200);

        }elseif($inicio == $fin){

            $ocupas = $plaza->ocupaciones;

            $tiempo = 0;

            foreach ($ocupas as $ocupa){

                if ($ocupa->created_at->format("Y-m-d") == Carbon::parse($fechainicio)->format("Y-m-d")){
                    $tiempo = $tiempo + $ocupa->tiempo_ocupada;
                }
            }

            $result[] = [
                "fecha" => Carbon::parse($fechainicio)->format("Y-m-d"),
                "tiempo" => round($tiempo/3600,1, PHP_ROUND_HALF_EVEN)
            ];


            return response()->json($result,200);
        }

    }

}
