<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ProcedureItem;
use App\Http\Requests\StoreProcedureItemRequest;
use App\Http\Requests\UpdateProcedureItemRequest;
use Illuminate\Http\Request;
class ProcedureItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $procedure_items = ProcedureItem::all();

        $procedure_item_lists = array();
        foreach($procedure_items as $item){
            $related_brand = Brand::find($item->brand_id);
            $id = $item->id;
            $code = $item->code;
            $name = $item->name;
            $description = $item->description;
            $brand = $related_brand->name ?? 'Brand';
            $combined = array('id' => $id, 'name' => $name, 'code' => $code, 'description' => $description, 'brand' =>$brand);
            array_push($procedure_item_lists, $combined);
        }

        return response()->json([
            "data" => $procedure_item_lists,
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
     * @param  \App\Http\Requests\StoreProcedureItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureItemRequest $request)
    {
        //
        $request->validate([
           'code'=>'required',
           'name'=>'required',
        ]);
        $procedure_item = new ProcedureItem();
        $procedure_item->code = $request->code;
        $procedure_item->name = $request->name;
        $procedure_item->brand_id = $request->brand_id;
        $procedure_item->description = $request->description;
        $procedure_item->save();
        return response()->json([
            "data" => $procedure_item,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureItem  $procedureItem
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureItem $procedureItem)
    {
      return response()->json([
          'data'=> $procedureItem
      ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProcedureItem  $procedureItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcedureItem $procedureItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureItemRequest  $request
     * @param  \App\Models\ProcedureItem  $procedureItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureItemRequest $request, ProcedureItem $procedureItem)
    {
        //
        $request->validate([
            'code'=>'required',
            'name'=>'required',
            'brand_id' => 'required'
        ]);
        $procedureItem->code = $request->code;
        $procedureItem->name = $request->name;
        $procedureItem->brand_id = $request->brand_id;
        $procedureItem->description = $request->description;
        $procedureItem->update();
        return response()->json([
            "data" => $procedureItem,
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureItem  $procedureItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureItem $procedureItem)
    {
        //
        $procedureItem->delete();
        return response()->json(null);
    }

    public function search(Request $request){
        $search = $request->search;
        $items = ProcedureItem::where('name', 'like', '%'.$search.'%')->orWhere('code','like','%'.$search.'%')->get();
        $item_list = array();
        foreach($items as $item){
            $related_brand = Brand::find($item->brand_id);
            $id = $item->id;
            $code = $item->code;
            $name = $item->name;
            $description = $item->description;
            $brand = $related_brand->name;
            $combined = array('id' => $id, 'name' => $name, 'code' => $code, 'description' => $description, 'brand' =>$brand);
            array_push($item_list, $combined);
        }

        return response()->json([
            "data" =>$item_list,
        ],200);
    }
}
