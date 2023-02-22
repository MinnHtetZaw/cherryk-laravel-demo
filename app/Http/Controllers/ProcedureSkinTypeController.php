<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureSkinTypeRequest;
use App\Http\Requests\UpdateProcedureSkinTypeRequest;
use App\Models\ProcedureSkinType;

class ProcedureSkinTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreProcedureSkinTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureSkinTypeRequest $request)
    {
        $procedureSkinType = new ProcedureSkinType();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureSkinType  $procedureSkinType
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureSkinType $procedureSkinType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureSkinTypeRequest  $request
     * @param  \App\Models\ProcedureSkinType  $procedureSkinType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureSkinTypeRequest $request, ProcedureSkinType $procedureSkinType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureSkinType  $procedureSkinType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureSkinType $procedureSkinType)
    {
        //
    }
}
