<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureMesoFatRequest;
use App\Http\Requests\UpdateProcedureMesoFatRequest;
use App\Models\ProcedureMesoFat;

class ProcedureMesoFatController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcedureMesoFatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureMesoFatRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureMesoFat  $procedureMesoFat
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureMesoFat $procedureMesoFat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureMesoFatRequest  $request
     * @param  \App\Models\ProcedureMesoFat  $procedureMesoFat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureMesoFatRequest $request, ProcedureMesoFat $procedureMesoFat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureMesoFat  $procedureMesoFat
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureMesoFat $procedureMesoFat)
    {
        //
    }
}
