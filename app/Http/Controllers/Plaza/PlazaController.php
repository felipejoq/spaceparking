<?php

namespace App\Http\Controllers\Plaza;

use App\Disponibilidad;
use App\Nodemcu;
use App\Ocupacion;
use App\Plaza;
use App\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
            'numero_plaza' => 'required',
            'descripcion' => 'required',
            'nodemcu_id' => 'required',
            'tipo_id' => 'required',
            'estado_inicial' => 'required',
        ];

        $this->validate($request,$rules);

        Disponibilidad::latest()->first()->actualizaPlazaDisponibilidad($request, $plaza);

        $plaza->numero_plaza = $request->input('numero_plaza');
        $plaza->descripcion = $request->input('descripcion');
        $plaza->nodemcu_id = $request->input('nodemcu_id');
        $plaza->tipo_id = $request->input('tipo_id');
        $plaza->estado_inicial = $request->input('estado_inicial');

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

}
