<?php

namespace App\Http\Controllers;

use App\Exports\ProcedureItemsExport;
use App\Http\Resources\CountingUnitProcedureItemResource;
use App\Models\CountingUnitProcedureItem;
use App\Http\Requests\StoreCountingUnitProcedureItemRequest;
use App\Http\Requests\UpdateCountingUnitProcedureItemRequest;
use App\Models\ProcedureItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CountingUnitProcedureItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $counting_unit = CountingUnitProcedureItem::when(request('keyword'),fn($q)=>
        $q->where('name','like','%'.request('keyword').'%'))
            ->latest('id')->get();
        return CountingUnitProcedureItemResource::collection($counting_unit);
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
     * @param  \App\Http\Requests\StoreCountingUnitProcedureItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountingUnitProcedureItemRequest $request)
    {
        $procedureItem = ProcedureItem::find($request->procedure_item_id);
        $counting_unit = new CountingUnitProcedureItem();
        $counting_unit->code = $request->code;
        $counting_unit->name = $procedureItem->name.' '.$request->name;
        $counting_unit->current_qty = $request->current_qty;
        $counting_unit->reorder_qty = $request->reorder_qty;
        $counting_unit->selling_price = $request->selling_price;
        $counting_unit->selling_percent = $request->selling_percent;
        $counting_unit->purchase_price = $request->purchase_price;
        $counting_unit->procedure_item_id = $request->procedure_item_id;
        $counting_unit->from_unit = $request->from_unit;
        $counting_unit->to_unit = $request->to_unit;
        $counting_unit->per_unit_qty = $request->per_unit_qty;
        $counting_unit->description = $request->description;
        $counting_unit->save();
        return response()->json([
            "data" => $counting_unit,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountingUnitProcedureItem  $countingUnitProcedureItem
     * @return \Illuminate\Http\Response
     */
    public function show(CountingUnitProcedureItem $countingUnitProcedureItem)
    {
        return new CountingUnitProcedureItemResource($countingUnitProcedureItem);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountingUnitProcedureItem  $countingUnitProcedureItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CountingUnitProcedureItem $countingUnitProcedureItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountingUnitProcedureItemRequest  $request
     * @param  \App\Models\CountingUnitProcedureItem  $countingUnitProcedureItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountingUnitProcedureItemRequest $request, CountingUnitProcedureItem $countingUnitProcedureItem)
    {
        $countingUnitProcedureItem = CountingUnitProcedureItem::find($request->id);
        if ($request->code){
            $countingUnitProcedureItem->code = $request->code;
            $countingUnitProcedureItem->name = $request->name;
            $countingUnitProcedureItem->reorder_qty = $request->reorder_qty;
            $countingUnitProcedureItem->selling_percent = $request->selling_percent;
            $countingUnitProcedureItem->description = $request->description;
            $countingUnitProcedureItem->per_unit_qty = $request->per_unit_qty;
        }
        if (isset($request->current_qty)){
            $countingUnitProcedureItem->current_qty = $request->current_qty;
        }
        if ($request->from_unit){
            $countingUnitProcedureItem->from_unit = $request->from_unit;
        }
        if ($request->to_unit){
            $countingUnitProcedureItem->to_unit = $request->to_unit;
        }
        if ($request->per_unit_qty){
            $countingUnitProcedureItem->per_unit_qty = $request->per_unit_qty;
        }
        if ($request->selling_price){
            $countingUnitProcedureItem->selling_price = $request->selling_price;
        }
        if ($request->purchase_price){
            $countingUnitProcedureItem->purchase_price = $request->purchase_price;
        }
        $countingUnitProcedureItem->update();
        return response()->json([
            'data'=> 'Success',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountingUnitProcedureItem  $countingUnitProcedureItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountingUnitProcedureItem $countingUnitProcedureItem)
    {
        //
        $countingUnitProcedureItem->delete();
        return response()->json(null);
    }

    public function search(Request $request){


        $search = $request->search;
        $countingUnitProcedureItems = CountingUnitProcedureItem::where('name', 'like', '%'.$search.'%')->orWhere('code','like','%'.$search.'%')->get();

        return response()->json([
            "data" =>$countingUnitProcedureItems,
        ],200);
    }

    public function deleteItemUnit($id){


        $item = CountingUnitProcedureItem::find($id);
        $item->delete();
        return response()->json([
            'data'=>'Success',
        ],200);

        return response()->json([
            "data" =>$countingUnitProcedureItems,
        ],200);
    }

    public function export() {
        return Excel::download(new ProcedureItemsExport(),'procedure-item.xlsx');
    }
}
