<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKitItemRequest;
use App\Http\Requests\UpdateKitItemRequest;
use App\Http\Resources\KitItemResource;
use App\Models\KitItem;

class KitItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kitItem = KitItem::all();
        return KitItemResource::collection($kitItem);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKitItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKitItemRequest $request)
    {
        $kitItem = new KitItem();
        $kitItem->code = $request->code;
        $kitItem->name = $request->name;
        $kitItem->brand_id = $request->brand_id;
        $kitItem->description = $request->description;
        $kitItem->save();
        return request()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KitItem  $kitItem
     * @return \Illuminate\Http\Response
     */
    public function show(KitItem $kitItem)
    {
        return new KitItemResource($kitItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKitItemRequest  $request
     * @param  \App\Models\KitItem  $kitItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKitItemRequest $request, KitItem $kitItem)
    {
        $kitItem->code = $request->code;
        $kitItem->name = $request->name;
        $kitItem->brand_id = $request->brand_id;
        $kitItem->description = $request->description;
        $kitItem->update();
        return request()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KitItem  $kitItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(KitItem $kitItem)
    {
        $kitItem->delete();
        return response()->json([
            'data'=>'Success',
        ],200);
    }
}
