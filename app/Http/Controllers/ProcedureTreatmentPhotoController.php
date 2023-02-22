<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureTreatmentPhotoRequest;
use App\Http\Requests\UpdateProcedureTreatmentPhotoRequest;
use App\Models\ProcedureTreatmentPhoto;

class ProcedureTreatmentPhotoController extends Controller
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
     * @param  \App\Http\Requests\StoreProcedureTreatmentPhotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureTreatmentPhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureTreatmentPhoto  $procedureTreatmentPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureTreatmentPhoto $procedureTreatmentPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureTreatmentPhotoRequest  $request
     * @param  \App\Models\ProcedureTreatmentPhoto  $procedureTreatmentPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureTreatmentPhotoRequest $request, ProcedureTreatmentPhoto $procedureTreatmentPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureTreatmentPhoto  $procedureTreatmentPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureTreatmentPhoto $procedureTreatmentPhoto)
    {
        //
    }
}
