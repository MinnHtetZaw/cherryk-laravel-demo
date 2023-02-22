<?php

namespace App\Http\Controllers;

use App\Models\EmrHealth;
use App\Http\Requests\StoreEmrHealthRequest;
use App\Http\Requests\UpdateEmrHealthRequest;

class EmrHealthController extends Controller
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
     * @param  \App\Http\Requests\StoreEmrHealthRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmrHealthRequest $request)
    {
        //
        $emr_health = new EmrHealth();
        $emr_health->previous_emr_id = $request->previous_emr_id;
        $emr_health->conditoin = $request->conditoin;
        $emr_health->save();
        return response()->json([
            "data" => $emr_health,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmrHealth  $emrHealth
     * @return \Illuminate\Http\Response
     */
    public function show(EmrHealth $emrHealth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmrHealthRequest  $request
     * @param  \App\Models\EmrHealth  $emrHealth
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmrHealthRequest $request, EmrHealth $emrHealth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmrHealth  $emrHealth
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmrHealth $emrHealth)
    {
        //
    }
}
