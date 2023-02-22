<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKitUnitRequest;
use App\Http\Requests\UpdateKitUnitRequest;
use App\Http\Resources\KitUnitResource;
use App\Models\KitItem;
use App\Models\KitUnit;

class KitUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kitUnit= KitUnit::all();
        return KitUnitResource::collection($kitUnit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKitUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitUnitRequest $request)
    {
        $kit = KitItem::find($request->kit_item_id);
        $kitUnit = new KitUnit();
        $kitUnit->code = $request->code;
        $kitUnit->name = $kit->name.' '.$request->name;
        $kitUnit->current_qty = $request->current_qty;
        if (isset($request->reorder_qty)){
            $kitUnit->reorder_qty = $request->reorder_qty;
        }
        $kitUnit->selling_price = $request->selling_price;
        $kitUnit->purchase_price = $request->purchase_price;
        $kitUnit->per_unit_qty = $request->per_unit_qty;
        $kitUnit->from_unit = $request->from_unit;
        $kitUnit->to_unit = $request->to_unit;
        $kitUnit->to_unit = $request->to_unit;
        $kitUnit->description = $request->description;
        $kitUnit->kit_item_id = $request->kit_item_id;
        $kitUnit->save();
        return response()->json([
            'data'=>'Success',
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitUnit  $kitUnit
     * @return \Illuminate\Http\Response
     */
    public function show(KitUnit $kitUnit)
    {
        return new KitUnitResource($kitUnit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitUnitRequest  $request
     * @param  \App\Models\KitUnit  $kitUnit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitUnitRequest $request, KitUnit $kitUnit)
    {
        $kitUnit->code = $request->code;
        $kitUnit->name = $request->name;
        $kitUnit->current_qty = $request->current_qty;
        if (isset($request->reorder_qty)){
            $kitUnit->reorder_qty = $request->reorder_qty;
        }
        $kitUnit->selling_price = $request->selling_price;
        $kitUnit->purchase_price = $request->purchase_price;
        $kitUnit->per_unit_qty = $request->per_unit_qty;
        $kitUnit->from_unit = $request->from_unit;
        $kitUnit->to_unit = $request->to_unit;
        $kitUnit->to_unit = $request->to_unit;
        $kitUnit->description = $request->description;
        $kitUnit->update();
        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitUnit  $kitUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitUnit $kitUnit)
    {
        $kitUnit->delete();
        return response()->json([
            'data'=>'Success',
        ],200);
    }
}
