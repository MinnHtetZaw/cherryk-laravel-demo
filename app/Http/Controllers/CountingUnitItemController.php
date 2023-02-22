<?php

namespace App\Http\Controllers;

use App\Exports\MedicineItemsExport;
use App\Http\Resources\CountingUnitItemResource;
use App\Models\CountingUnitItem;
use App\Http\Requests\StoreCountingUnitItemRequest;
use App\Http\Requests\UpdateCountingUnitItemRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class CountingUnitItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_unit_item = CountingUnitItem::when(request('keyword'),fn($q)=>$q->where('name','like',"%".request('keyword')."%"))->get();
	    return CountingUnitItemResource::collection($count_unit_item);
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
     * @param  \App\Http\Requests\StoreCountingUnitItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountingUnitItemRequest $request)
    {
        $item = Item::find($request->item_id);
        $counting_unit = new CountingUnitItem();
        $counting_unit->code = $request->code;
        $counting_unit->name = $item->name.' '.$request->name;
        $counting_unit->current_qty = $request->current_qty;
        $counting_unit->reorder_qty = $request->reorder_qty;
        $counting_unit->selling_price = $request->selling_price;
        $counting_unit->selling_percent = $request->selling_percent;
        $counting_unit->purchase_price = $request->purchase_price;
        $counting_unit->to_unit = $request->to_unit;
        $counting_unit->from_unit = $request->from_unit;
        $counting_unit->item_id = $request->item_id;
        $counting_unit->description = $request->description;
        $counting_unit->save();
        return response()->json([
            "data" => $counting_unit,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountingUnitItem  $countingUnitItem
     * @return \Illuminate\Http\Response
     */
    public function show(CountingUnitItem $countingUnitItem)
    {
      return response()->json([
          $countingUnitItem
      ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CountingUnitItem  $countingUnitItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CountingUnitItem $countingUnitItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountingUnitItemRequest  $request
     * @param  \App\Models\CountingUnitItem  $countingUnitItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountingUnitItemRequest $request, CountingUnitItem $countingUnitItem)
    {
        $countingUnitItem= CountingUnitItem::find($request->id);
        if ($request->code){
            $item = Item::find($request->item_id);
            $countingUnitItem->code = $request->code;
            $countingUnitItem->name = $request->name;
            $countingUnitItem->reorder_qty = $request->reorder_qty;
            $countingUnitItem->selling_percent = $request->selling_percent;
            $countingUnitItem->description = $request->description;
        }

        if ($request->to_unit){
            $countingUnitItem->to_unit = $request->to_unit;
        }
        if ($request->from_unit){
            $countingUnitItem->from_unit = $request->from_unit;
        }
        if (isset($request->current_qty)){
            $countingUnitItem->current_qty = $request->current_qty;
        }
        if ($request->selling_price){
            $countingUnitItem->selling_price = $request->selling_price;

        }
        if ($request->purchase_price){
            $countingUnitItem->purchase_price = $request->purchase_price;
        }
        $countingUnitItem->update();

        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountingUnitItem  $countingUnitItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountingUnitItem $countingUnitItem)
    {
        //
//         $countingUnitItem->delete();
         return response()->json([
             'data'=>$countingUnitItem,
         ],200);
    }

    public function showItemUnit($id){
        $item = CountingUnitItem::find($id);
        return response()->json([
            'data'=>$item,
        ],200);
    }
    public function deleteItemUnit($id){
        $item = CountingUnitItem::find($id);
        $item->delete();
        return response()->json([
            'data'=>$item,
        ],200);
    }

    public function search(Request $request){


        $search = $request->search;
        $countingUnitItems = CountingUnitItem::where('name', 'like', '%'.$search.'%')->orWhere('code','like','%'.$search.'%')->get();

        return response()->json([
            "data" =>$countingUnitItems,
        ],200);
    }

    public function export(){
        return \Maatwebsite\Excel\Facades\Excel::download(new MedicineItemsExport(),'medicine-items.xlsx');
    }
}
