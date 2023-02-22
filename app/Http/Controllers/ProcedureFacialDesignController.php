<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureFacialDesignRequest;
use App\Http\Requests\UpdateProcedureFacialDesignRequest;
use App\Models\ProcedureFacialDesign;

class ProcedureFacialDesignController extends Controller
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
     * @param  \App\Http\Requests\StoreProcedureFacialDesignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureFacialDesignRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureFacialDesign  $procedureFacialDesign
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureFacialDesign $procedureFacialDesign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureFacialDesignRequest  $request
     * @param  \App\Models\ProcedureFacialDesign  $procedureFacialDesign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureFacialDesignRequest $request, ProcedureFacialDesign $procedureFacialDesign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureFacialDesign  $procedureFacialDesign
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureFacialDesign $procedureFacialDesign)
    {
        //
    }
}
