<?php

namespace App\Http\Controllers;

use App\Plaza;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $plazas = Plaza::all()->load('tipo','nodemcu');

        return view('administracion',compact('plazas'));
    }

    public function nosotros(){

        return view('nosotros');
    }
}
