<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreatmentProcedureItemRequest;
use App\Http\Requests\UpdateTreatmentProcedureItemRequest;
use App\Http\Resources\TreatmentProcedureItemResource;
use App\Models\TreatmentProcedureItem;

class TreatmentProcedureItemController extends Controller
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
     * @param  \App\Http\Requests\StoreTreatmentProcedureItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreatmentProcedureItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TreatmentProcedureItem  $treatmentProcedureItem
     * @return \Illuminate\Http\Response
     */
    public function show(TreatmentProcedureItem $treatmentProcedureItem)
    {
        return new TreatmentProcedureItemResource($treatmentProcedureItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTreatmentProcedureItemRequest  $request
     * @param  \App\Models\TreatmentProcedureItem  $treatmentProcedureItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTreatmentProcedureItemRequest $request, TreatmentProcedureItem $treatmentProcedureItem)
    {
        sleep(2);
        if (isset($request->qty)){
            $treatmentProcedureItem->qty = $request->qty;
        }
        $treatmentProcedureItem->update();
        return response()->json([
            'data'=>'Success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreatmentProcedureItem  $treatmentProcedureItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TreatmentProcedureItem $treatmentProcedureItem)
    {
        $treatmentProcedureItem->delete();
        return response()->json([
            'data'=>'Success',
        ]);
    }
}
