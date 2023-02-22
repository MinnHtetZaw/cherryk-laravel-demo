<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MachineryItem;
use App\Http\Requests\StoreMachineryItemRequest;
use App\Http\Requests\UpdateMachineryItemRequest;

class MachineryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machinery_item = MachineryItem::all();
        $machinery_item_lists = array();
        foreach($machinery_item_lists as $item){

            $id = $item->id;
            $code = $item->code;
            $name = $item->name;
            $description = $item->description;
            $per_unit_qty = $item->per_unit_qty;
            $selling_price = $item->selling_price;

            $combined = array('id' => $id, 'name' => $name, 'code' => $code, 'description' => $description,
                'per_unit_qty'=>$per_unit_qty, 'selling_price' => $selling_price);
            array_push($procedure_item_lists, $combined);
        }



        return response()->json([
            "data" => $machinery_item,
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
     * @param  \App\Http\Requests\StoreMachineryItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMachineryItemRequest $request)
    {

        $request->validate([
           'code'=>'required',
           'name'=>'required',
           'selling_price'=>'required',
        ]);
        $machinery_item = new MachineryItem();
        $machinery_item->code = $request->code;
        $machinery_item->name = $request->name;
        $machinery_item->brand_id = $request->brand_id;
        $machinery_item->description = $request->description;
        $machinery_item->per_unit_qty = $request->per_unit_qty;
        $machinery_item->selling_price = $request->selling_price;
        $machinery_item->save();
        return response()->json([
            "data" => $machinery_item,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MachineryItem  $machineryItem
     * @return \Illuminate\Http\Response
     */
    public function show(MachineryItem $machineryItem)
    {
        return response()->json([
            "data" => $machineryItem,
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MachineryItem  $machineryItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MachineryItem $machineryItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMachineryItemRequest  $request
     * @param  \App\Models\MachineryItem  $machineryItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMachineryItemRequest $request, MachineryItem $machineryItem)
    {
        $request->validate([
            'code'=>'required',
            'name'=>'required',
            'selling_price'=>'required',
        ]);

        $machineryItem->code = $request->code;
        $machineryItem->name = $request->name;
        $machineryItem->description = $request->description;
        $machineryItem->per_unit_qty = $request->per_unit_qty;
        $machineryItem->selling_price = $request->selling_price;
        $machineryItem->update();
        return response()->json([
            "data" => $machineryItem,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MachineryItem  $machineryItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MachineryItem $machineryItem)
    {
        //
        $machineryItem->delete();
        return response()->json(null);
    }
}
