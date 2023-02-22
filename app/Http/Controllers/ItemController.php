<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Brand;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('name','asc')->get();
        return ItemResource::collection($items);

//        }
        $item_lists = array();
        foreach($items as $item){
            $related_brand = Brand::find($item->brand_id);
            $id = $item->id;
            $code = $item->code;
            $name = $item->name;
            $description = $item->description;
            $brand = $related_brand->name ?? 'Brand';
            $brand_id = $item->brand_id;
            $item_units = $item->item_units;
            $combined = array('id' => $id, 'name' => $name, 'code' => $code, 'description' => $description, 'brand' =>$brand,
                'brand_id' => $brand_id,'item_units' => $item_units);
            array_push($item_lists, $combined);
        }
        return response()->json([
            "data" => $item_lists,
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
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        //
        $request->validate([
           'code'=>'required',
           'name'=>'required',
        ]);

        $item = new Item();
        $item->code = $request->code;
        $item->name = $request->name;
        $item->brand_id = $request->brand_id;
        $item->description = $request->description;
        $item->save();
        return response()->json([
            "data" => $item,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response()->json([
            "data" => $item,
        ],200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $request->validate([
            'code'=>'required',
            'name'=>'required',
            'brand_id'=>'required'
        ]);
        $item->code = $request->code;
        $item->name = $request->name;
        $item->brand_id = $request->brand_id;
        $item->description = $request->description;
        $item->save();
        return response()->json([
            "data" => $item,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
        $item->delete();
        return response()->json(null);
    }

    public function search(Request $request){
        $search = $request->search;
        $items = Item::where('name', 'like', '%'.$search.'%')->orWhere('code','like','%'.$search.'%')->get();
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
