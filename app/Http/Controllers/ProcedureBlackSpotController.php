<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureBlackSpotRequest;
use App\Http\Requests\UpdateProcedureBlackSpotRequest;
use App\Models\ProcedureBlackSpot;

class ProcedureBlackSpotController extends Controller
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
     * @param  \App\Http\Requests\StoreProcedureBlackSpotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureBlackSpotRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureBlackSpot  $procedureBlackSpot
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureBlackSpot $procedureBlackSpot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureBlackSpotRequest  $request
     * @param  \App\Models\ProcedureBlackSpot  $procedureBlackSpot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureBlackSpotRequest $request, ProcedureBlackSpot $procedureBlackSpot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureBlackSpot  $procedureBlackSpot
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureBlackSpot $procedureBlackSpot)
    {
        //
    }
}
