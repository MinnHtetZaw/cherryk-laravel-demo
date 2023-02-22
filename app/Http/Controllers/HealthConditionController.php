<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHealthConditionRequest;
use App\Http\Requests\UpdateHealthConditionRequest;
use App\Models\HealthCondition;

class HealthConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healths = HealthCondition::all();
        return response()->json([
            'data'=>$healths,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHealthConditionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealthConditionRequest $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $health = new HealthCondition();
        $health->name = $request->name;
        $health->save();
        return response()->json([
            'data'=>$health,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthCondition  $healthCondition
     * @return \Illuminate\Http\Response
     */
    public function show(HealthCondition $healthCondition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHealthConditionRequest  $request
     * @param  \App\Models\HealthCondition  $healthCondition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHealthConditionRequest $request, HealthCondition $healthCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthCondition  $healthCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthCondition $healthCondition)
    {
        //
    }
}
