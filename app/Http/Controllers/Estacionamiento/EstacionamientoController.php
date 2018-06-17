<?php

namespace App\Http\Controllers\Estacionamiento;

use App\Admin;
use App\Estacionamiento;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class EstacionamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estacionamiento = Estacionamiento::latest()->first()->load('administradores');

        $administradores = User::all();

        $roles = Role::all();

        $numAdmin = 0;

        foreach ($administradores as $a) {
            if ($a->hasRole('Administrador')) $numAdmin = $numAdmin + 1;
        }

        return view('admin.estacionamiento', compact(['estacionamiento', 'administradores','numAdmin', 'roles']));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, Estacionamiento $estacionamiento)
    {

        $rules = [
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ];

        $this->validate($request,$rules);

        $estacionamiento->nombre = $request->nombre;
        $estacionamiento->direccion = $request->direccion;
        $estacionamiento->telefono = $request->telefono;

        $estacionamiento->save();

        return redirect()->route('estacionamiento.index')
            ->with('flash','El estacionamiento fue editado!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
