<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmrSymptomRequest;
use App\Http\Requests\UpdateEmrSymptomRequest;
use App\Models\EmrSymptom;

class EmrSymptomController extends Controller
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
     * @param  \App\Http\Requests\StoreEmrSymptomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmrSymptomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmrSymptom  $emrSymptom
     * @return \Illuminate\Http\Response
     */
    public function show(EmrSymptom $emrSymptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmrSymptomRequest  $request
     * @param  \App\Models\EmrSymptom  $emrSymptom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmrSymptomRequest $request, EmrSymptom $emrSymptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmrSymptom  $emrSymptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmrSymptom $emrSymptom)
    {
        //
    }
}
