<?php

namespace App\Http\Controllers\Usuario;

use App\Estacionamiento;
use App\Mail\UserChangedMail;
use App\Mail\UserCreatedMail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rol = Role::findById($request->role);

        $rules = [
            'name'  => 'required|min:5',
            'email' => 'unique:users|required|email',
            'password' => 'min:6|required',
        ];

        $this->validate($request,$rules);

        $estacionamiento = Estacionamiento::latest()->first()->load('administradores');

        $administradores = User::all();

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->estacionamiento_id = 1;

        $usuario->save();

        $usuario->assignRole($rol);

        $usuario->password = $request->password;

        Mail::to($usuario->email)->send(new UserCreatedMail($usuario));

        return redirect()->route('estacionamiento.index', compact(['estacionamiento', 'administradores']))
            ->with('flash','Usuario creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        $usuario->load('roles');
        return response()->json($usuario,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {

        if ($usuario->email != $request->email){
            $usuario->email = $request->email;
            Mail::to($request->email)->send(new UserChangedMail($usuario));
        }

        $rules = [
            'email' => 'required|unique:users,email,'.$usuario->id
        ];

        $this->validate($request,$rules);

        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = auth()->user()->getAuthPassword();
        $usuario->estacionamiento_id = 1;

        $usuario->save();
        $usuario->syncRoles(Role::findById($request->rolee));

        $estacionamiento = Estacionamiento::latest()->first()->load('administradores');

        $administradores = User::all();

        return redirect()->route('estacionamiento.index', compact(['estacionamiento', 'administradores']))
            ->with('flash','Usuario editado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario = $usuario->delete();

        $estacionamiento = Estacionamiento::latest()->first()->load('administradores');

        $administradores = User::all();

        return redirect()->route('estacionamiento.index', compact(['estacionamiento', 'administradores']))
            ->with('flash','Usuario eliminado con éxito.');
    }
}
