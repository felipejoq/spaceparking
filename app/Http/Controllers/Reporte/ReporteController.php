<?php

namespace App\Http\Controllers\Reporte;

use App\Plaza;
use App\Reporte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plazas = Plaza::all();
        $reportes = Reporte::all();

        return view('admin.reportes',compact(['plazas', 'reportes']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $reporte = new Reporte();
        $reporte->nombre_reporte = $request->nombre_reporte;
        $reporte->descripcion_reporte = $request->descripcion_reporte;
        $reporte->fechainicio = $request->datestart;
        $reporte->fechafin = $request->dateend;
        $reporte->plaza_id = $request->idplaza;
        $reporte->save();

        $plazas = Plaza::all();
        $reportes = Reporte::all()->load('plaza');

        return redirect()->route('reportes.index',compact(['plazas', 'reportes']))
            ->with('flash','¡El reporte fue guardado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        $reporte->load('plaza');
        return response()->json($reporte,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        $plazas = Plaza::all();
        $reportes = Reporte::all()->load('plaza');

        return redirect()->route('reportes.index',compact(['plazas', 'reportes']))
            ->with('flash2','¡El reporte fue eliminado!');
    }
}
