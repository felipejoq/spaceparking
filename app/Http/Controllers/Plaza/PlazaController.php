<?php

namespace App\Http\Controllers\Plaza;

use App\Plaza;
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
        return view('admin.plaza');
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
     * @param  \App\Plaza  $plaza
     * @return \Illuminate\Http\Response
     */
    public function show(Plaza $plaza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plaza  $plaza
     * @return \Illuminate\Http\Response
     */
    public function edit(Plaza $plaza)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plaza  $plaza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plaza $plaza)
    {
        //
    }
}
