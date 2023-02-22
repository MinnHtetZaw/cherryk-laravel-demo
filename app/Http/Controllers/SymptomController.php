<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSymptomRequest;
use App\Http\Requests\UpdateSymptomRequest;
use App\Models\Symptom;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $symptoms = Symptom::all();
        return response()->json([
            'data' => $symptoms,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSymptomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSymptomRequest $request)
    {
        $request->validate([
           'name' => 'required',
        ]);
        $symptom = new Symptom();
        $symptom->name = $request->name;
        $symptom->description = $request->description;
        $symptom->save();
        return response()->json([
            'data' => $symptom,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function show(Symptom $symptom)
    {
        return response()->json([
            'data' => $symptom,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSymptomRequest  $request
     * @param  \App\Models\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSymptomRequest $request, Symptom $symptom)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $symptom->name = $request->name;
        $symptom->description = $request->description;
        $symptom->update();
        return response()->json([
            'data' => $symptom,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Symptom  $symptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Symptom $symptom)
    {
        $symptom->delete();
        return response()->json([
            'data' => 'Success',
        ],200);
    }
}
