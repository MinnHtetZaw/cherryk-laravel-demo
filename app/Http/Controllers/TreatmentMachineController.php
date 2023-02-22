<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreatmentMachineRequest;
use App\Http\Requests\UpdateTreatmentMachineRequest;
use App\Http\Resources\TreatmentMachineResource;
use App\Models\TreatmentMachine;

class TreatmentMachineController extends Controller
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
     * @param  \App\Http\Requests\StoreTreatmentMachineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreatmentMachineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TreatmentMachine  $treatmentMachine
     * @return \Illuminate\Http\Response
     */
    public function show(TreatmentMachine $treatmentMachine)
    {
        return new TreatmentMachineResource($treatmentMachine);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTreatmentMachineRequest  $request
     * @param  \App\Models\TreatmentMachine  $treatmentMachine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTreatmentMachineRequest $request, TreatmentMachine $treatmentMachine)
    {
        sleep(2);
        if (isset($request->qty)){
            $treatmentMachine->qty = $request->qty;
            $treatmentMachine->update();
            return response()->json([
                'data'=>'Success',
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreatmentMachine  $treatmentMachine
     * @return \Illuminate\Http\Response
     */
    public function destroy(TreatmentMachine $treatmentMachine)
    {
        $treatmentMachine->delete();
        return response()->json([
            'data'=>'Success',
        ],200);
    }
}
