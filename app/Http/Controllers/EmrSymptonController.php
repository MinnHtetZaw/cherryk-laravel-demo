<?php

namespace App\Http\Controllers;

use App\Models\EmrSympton;
use App\Http\Requests\StoreEmrSymptonRequest;
use App\Http\Requests\UpdateEmrSymptonRequest;

class EmrSymptonController extends Controller
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
     * @param  \App\Http\Requests\StoreEmrSymptonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmrSymptonRequest $request)
    {
        //
        $emr_sympton = new EmrSympton();
        $emr_sympton->previous_emr_id = $request->previous_emr_id;
        $emr_sympton->sympton_id = $request->sympton_id;
        $emr_sympton->description = $request->description;
        $emr_sympton->save();
        return response()->json([
            "data" => $emr_sympton,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmrSympton  $emrSympton
     * @return \Illuminate\Http\Response
     */
    public function show(EmrSympton $emrSympton)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmrSymptonRequest  $request
     * @param  \App\Models\EmrSympton  $emrSympton
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmrSymptonRequest $request, EmrSympton $emrSympton)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmrSympton  $emrSympton
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmrSympton $emrSympton)
    {
        //
    }
}
