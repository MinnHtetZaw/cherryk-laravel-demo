<?php

namespace App\Http\Controllers;

use App\Models\MedicineProcedure;
use App\Http\Requests\StoreMedicineProcedureRequest;
use App\Http\Requests\UpdateMedicineProcedureRequest;

class MedicineProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicine = MedicineProcedure::all();
        return response()->json([
            "data" => $medicine
            ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedicineProcedureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicineProcedureRequest $request)
    {
        $medicine_procedure = new MedicineProcedure();
        $medicine_procedure->procedure_id = $request->procedure_id;
        $medicine_procedure->item_id = $request->item_id;
        $medicine_procedure->name = $request->name;
        $medicine_procedure->qty = $request->qty;
        $medicine_procedure->price = $request->price;
        $medicine_procedure->total_price = $request->total_price;
        $medicine_procedure->description = $request->description;
        $medicine_procedure->save();
        return response()->json([
            "data" => 'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicineProcedure  $medicineProcedure
     * @return \Illuminate\Http\Response
     */
    public function show(MedicineProcedure $medicineProcedure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicineProcedureRequest  $request
     * @param  \App\Models\MedicineProcedure  $medicineProcedure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicineProcedureRequest $request, MedicineProcedure $medicineProcedure)
    {
        $medicineProcedure->dose = $request->dose;
        $medicineProcedure->item_id = $request->item_id;
        $medicineProcedure->day = $request->day;
        $medicineProcedure->qty = $request->qty;
        $medicineProcedure->selling_price = $request->selling_price;
        $medicineProcedure->total_price = $request->total_price;
        $medicineProcedure->sig = $request->sig.' '.$request->sig_time;
        $medicineProcedure->update();
        return response()->json([
            "data" => 'Success',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicineProcedure  $medicineProcedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicineProcedure $medicineProcedure)
    {
        $medicineProcedure->delete();
        return response()->json([
            'data'=>'Success',
        ]);
    }
}
