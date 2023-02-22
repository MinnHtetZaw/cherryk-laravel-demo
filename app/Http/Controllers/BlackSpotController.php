<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlackSpotRequest;
use App\Http\Requests\UpdateBlackSpotRequest;
use App\Http\Resources\BlackSpotResource;
use App\Models\BlackSpot;

class BlackSpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blackSpot = BlackSpot::all();
        return BlackSpotResource::collection($blackSpot);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlackSpotRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlackSpotRequest $request)
    {
        $blackSpot = new BlackSpot();
        $blackSpot->name = $request->name;
        $blackSpot->save();
        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlackSpot  $blackSpot
     * @return \Illuminate\Http\Response
     */
    public function show(BlackSpot $blackSpot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlackSpotRequest  $request
     * @param  \App\Models\BlackSpot  $blackSpot
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlackSpotRequest $request, BlackSpot $blackSpot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlackSpot  $blackSpot
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlackSpot $blackSpot)
    {
        //
    }
}
