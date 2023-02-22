<?php

namespace App\Http\Controllers;

use App\Models\CountingUnitMachineryItem;
use App\Http\Requests\StoreCountingUnitMachineryItemRequest;
use App\Http\Requests\UpdateCountingUnitMachineryItemRequest;

class CountingUnitMachineryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $counting_unit = CountingUnitMachineryItem::all();
        return response()->json([
            "data" => $counting_unit,
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
     * @param  \App\Http\Requests\StoreCountingUnitMachineryItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountingUnitMachineryItemRequest $request)
    {
        //
        $counting_unit = new CountingUnitMachineryItem();
        $counting_unit->code = $request->code;
        $counting_unit->name = $request->name;
        $counting_unit->current_quantity = $request->current_quantity;
        $counting_unit->reorder_quantity = $request->reorder_quantity;
        $counting_unit->selling_price = $request->selling_price;
        $counting_unit->membership_price = $request->membership_price;
        $counting_unit->vip_price = $request->vip_price;
        $counting_unit->purchase_price = $request->purchase_price;
        $counting_unit->procedure_item_id = $request->procedure_item_id;
        $counting_unit->selling_fixed_percent = $request->selling_fixed_percent;
        $counting_unit->membership_fixed_percent = $request->membership_fixed_percent;
        $counting_unit->vip_fixed_percent = $request->vip_fixed_percent;
        $counting_unit->save();
        return response()->json([
            "data" => $counting_unit,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountingUnitMachineryItem  $countingUnitMachineryItem
     * @return \Illuminate\Http\Response
     */
    public function show(CountingUnitMachineryItem $countingUnitMachineryItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountingUnitMachineryItem  $countingUnitMachineryItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CountingUnitMachineryItem $countingUnitMachineryItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountingUnitMachineryItemRequest  $request
     * @param  \App\Models\CountingUnitMachineryItem  $countingUnitMachineryItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountingUnitMachineryItemRequest $request, CountingUnitMachineryItem $countingUnitMachineryItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountingUnitMachineryItem  $countingUnitMachineryItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountingUnitMachineryItem $countingUnitMachineryItem)
    {
        //
        $countingUnitMachineryItem->delete();
        return response()->json(null);
    }
}
