<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnitConventionRequest;
use App\Http\Requests\UpdateUnitConventionRequest;
use App\Models\UnitConvention;

class UnitConventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unit_convention = UnitConvention::all();
        return response()->json([
            'data'=> $unit_convention,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnitConventionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitConventionRequest $request)
    {
        $unit_convention = new UnitConvention();
//        $unit_convention->item_id = $request->item_id;
        $unit_convention->item_id = 1;
        $unit_convention->from_unit = $request->from_unit;
        $unit_convention->to_unit = $request->to_unit;
        $unit_convention->quantity = $request->quantity;
        $unit_convention->save();
        return response()->json([
            'data'=> $unit_convention,
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitConvention  $unitConvention
     * @return \Illuminate\Http\Response
     */
    public function show(UnitConvention $unitConvention)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitConventionRequest  $request
     * @param  \App\Models\UnitConvention  $unitConvention
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitConventionRequest $request, UnitConvention $unitConvention)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitConvention  $unitConvention
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitConvention $unitConvention)
    {
        //
    }
}
