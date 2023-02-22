<?php

namespace App\Http\Controllers;

use App\Models\TreatmentUnitSale;
use App\Http\Requests\StoreTreatmentUnitSaleRequest;
use App\Http\Requests\UpdateTreatmentUnitSaleRequest;

class TreatmentUnitSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $unit_sale = TreatmentUnitSale::all();
        return response()->json([
            "data" => $unit_sale,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTreatmentUnitSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreatmentUnitSaleRequest $request)
    {
        //
        $unit_sale = new TreatmentUnitSale();
        $unit_sale->treatment_unit_id = $request->treatment_unit_id;
        $unit_sale->selling_price = $request->selling_price;
        $unit_sale->type = $request->type;
        $unit_sale->type_option = $request->type_option;
        $unit_sale->interval_type = $request->interval_type;
        $unit_sale->interval_value = $request->interval_value;
        $unit_sale->save();
        return response()->json([
            "data" => $unit_sale,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TreatmentUnitSale  $treatmentUnitSale
     * @return \Illuminate\Http\Response
     */
    public function show(TreatmentUnitSale $treatmentUnitSale)
    {
        return response()->json([
		"data" => $treatmentUnitSale,
	],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TreatmentUnitSale  $treatmentUnitSale
     * @return \Illuminate\Http\Response
     */
    public function edit(TreatmentUnitSale $treatmentUnitSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTreatmentUnitSaleRequest  $request
     * @param  \App\Models\TreatmentUnitSale  $treatmentUnitSale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTreatmentUnitSaleRequest $request, TreatmentUnitSale $treatmentUnitSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreatmentUnitSale  $treatmentUnitSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(TreatmentUnitSale $treatmentUnitSale)
    {
        //
        $treatmentUnitSale->delete();
        return response()->json(null);
    }
}
