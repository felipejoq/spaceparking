<?php

namespace App\Http\Controllers\Nodemcu;

use App\Nodemcu;
use App\Plaza;
use App\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NodemcuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.plaza');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nodemcu['nodemcu_clave'] = str_random(4);

        $nodemcu = Nodemcu::create($nodemcu);

        $listadenodemcu = Nodemcu::all();

        return redirect()->route('plazas.index',compact('nodemcu','listadenodemcu'))
            ->with('flash5','¡Nodemcu creado!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nodemcu  $nodemcu
     * @return \Illuminate\Http\Response
     */
    public function show(Nodemcu $nodemcu)
    {
        return $nodemcu;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nodemcu  $nodemcu
     * @return \Illuminate\Http\Response
     */
    public function edit(Nodemcu $nodemcu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nodemcu  $nodemcu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nodemcu $nodemcu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nodemcu  $nodemcu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nodemcu $nodemcu)
    {
        if ($nodemcu->id != 1){
            $nodemcu = $nodemcu->delete();

            $listadenodemcu = Nodemcu::all();

            return redirect()->route('plazas.index',compact(['nodemcu','listadenodemcu']))
                ->with('flash4','¡Nodemcu eliminado!');
        }else{
            return redirect()->route('plazas.index',compact(['nodemcu','listadenodemcu']))
                ->with('flash4','¡No se permite eliminar!');
        }
    }
}
