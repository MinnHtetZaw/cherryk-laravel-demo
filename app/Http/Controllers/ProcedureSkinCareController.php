<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureSkinCareRequest;
use App\Http\Requests\UpdateProcedureSkinCareRequest;
use App\Models\ProcedureSkinCare;

class ProcedureSkinCareController extends Controller
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
     * @param  \App\Http\Requests\StoreProcedureSkinCareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureSkinCareRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureSkinCare  $procedureSkinCare
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureSkinCare $procedureSkinCare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureSkinCareRequest  $request
     * @param  \App\Models\ProcedureSkinCare  $procedureSkinCare
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureSkinCareRequest $request, ProcedureSkinCare $procedureSkinCare)
    {
        $procedureSkinCare->skin_care_id = $request->skin_care_id;
        $procedureSkinCare->description = $request->description;
        $procedureSkinCare->update();
        return response()->json([
            'data'=> 'Success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureSkinCare  $procedureSkinCare
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureSkinCare $procedureSkinCare)
    {
        $procedureSkinCare->delete();
        return response()->json([
            'data'=>'Success',
        ]);
    }
}
