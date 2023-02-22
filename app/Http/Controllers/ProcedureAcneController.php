<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureAcneRequest;
use App\Http\Requests\UpdateProcedureAcneRequest;
use App\Models\ProcedureAcne;

class ProcedureAcneController extends Controller
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
     * @param  \App\Http\Requests\StoreProcedureAcneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureAcneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureAcne  $procedureAcne
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureAcne $procedureAcne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureAcneRequest  $request
     * @param  \App\Models\ProcedureAcne  $procedureAcne
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureAcneRequest $request, ProcedureAcne $procedureAcne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureAcne  $procedureAcne
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureAcne $procedureAcne)
    {
        //
    }
}
