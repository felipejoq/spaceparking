<?php

namespace App\Http\Controllers\Tipo;

use App\Plaza;
use App\Tipo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoPlazaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tipos = Tipo::all()->load('plazas');

        return view('admin.tipo', compact('tipos'));
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
            'nombre' => 'required|min:5',
            'descripcion' => 'required|min:10',
        ];

        $this->validate($request,$rules);

        $tipo = new Tipo();
        $tipo->nombre = $request->nombre;
        $tipo->descripcion = $request->descripcion;
        $tipo->save();

        $tipos = Tipo::all()->load('plazas');

        return view('admin.tipo', compact('tipos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tipo $tipo)
    {
        return response()->json($tipo,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipo $tipo)
    {
        $tipos = Tipo::all()->load('plazas');

        $rules = [
            'nombre' => 'required|min:5',
            'descripcion' => 'required|min:10',
        ];

        $this->validate($request,$rules);

        foreach ($tipo->plazas as $unaplaza){
            $plazaedita = Plaza::findOrFail($unaplaza->id);

            $plazaedita->tipo_id = 1;

            $plazaedita->save();

        }

        $tipo->nombre = $request->nombre;
        $tipo->descripcion = $request->descripcion;

        $tipo->save();

        return redirect()->route('tipos.index', compact('tipos'))
            ->with('flash','El tipo de plaza fue editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipo $tipo)
    {
        $tipos = Tipo::all()->load('plazas');

        if ($tipo->id != 1){

            $tipo = $tipo->delete();

            return redirect()->route('tipos.index', compact('tipos'))
                ->with('flash','El tipo de plaza fue eliminado con éxito.');

        }else{
            return redirect()->route('tipos.index', compact('tipos'))
                ->with('flash','Es el tipo de plaza por defecto, no puede ser eliminado.');
        }
    }
}
