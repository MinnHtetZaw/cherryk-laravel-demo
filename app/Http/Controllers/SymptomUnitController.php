<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSymptomUnitRequest;
use App\Http\Requests\UpdateSymptomUnitRequest;
use App\Models\Symptom;
use App\Models\SymptomUnit;

class SymptomUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $units = SymptomUnit::all();
        $unit_list = array();
        foreach ($units as $unit){
            $symptom = Symptom::find($unit->symptom_id);
            $id = $unit->id;
            $symptom_id = $unit->symptom_id;
            $unit_name = $unit->unit;
            $symptom_name = $symptom->name;
            $description = $unit->description;
            $id = $unit->id;
            $symptom_array = array('id'=>$id,'unit'=>$unit_name,'symptom'=>$symptom_name,'symptom_id'=>$symptom_id,'description'=>$description);
            array_push($unit_list,$symptom_array);
        }

        return response()->json([
            'data' => $unit_list,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSymptomUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSymptomUnitRequest $request)
    {
        //
        $request->validate([
            'unit' => 'required',
            'symptom_id' => 'required',
        ]);
        $unit = new SymptomUnit();
        $unit->unit = $request->unit;
        $unit->symptom_id = $request->symptom_id;
        $unit->description = $request->description;
        $unit->save();
        return response()->json([
            'data' => $unit,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SymptomUnit  $symptomUnit
     * @return \Illuminate\Http\Response
     */
    public function show(SymptomUnit $symptomUnit)
    {
        $unit_list = null;
        $symptom = Symptom::find($symptomUnit->symptom_id);
        $symptomUnit_name = $symptomUnit->unit;
        $symptom_name = $symptom->name;
        $description = $symptomUnit->description;
        $id = $symptomUnit->id;
        $symptom_array = array('id'=>$id,'unit'=>$symptomUnit_name,'symptom'=>$symptom_name,'description'=>$description);
        $unit_list = $symptom_array;
        return response()->json([
            'data' => $unit_list,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSymptomUnitRequest  $request
     * @param  \App\Models\SymptomUnit  $symptomUnit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSymptomUnitRequest $request, SymptomUnit $symptomUnit)
    {
        //
        $request->validate([
            'unit' => 'required',
            'symptom_id' => 'required',
        ]);
        $symptomUnit->unit = $request->unit;
        $symptomUnit->symptom_id = $request->symptom_id;
        $symptomUnit->description = $request->description;
        $symptomUnit->update();
        return response()->json([
            'data' => $symptomUnit,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SymptomUnit  $symptomUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(SymptomUnit $symptomUnit)
    {
        $symptomUnit->delete();
        return response()->json([
            'data' => 'Success',
        ],200);
    }
}
