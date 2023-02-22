<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacialDesignRequest;
use App\Http\Requests\UpdateFacialDesignRequest;
use App\Http\Resources\FacialDesignResource;
use App\Models\FacialDesign;

class FacialDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facialDesign = FacialDesign::all();
        return FacialDesignResource::collection($facialDesign);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFacialDesignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacialDesignRequest $request)
    {
        $facialDesign = new FacialDesign();
        $facialDesign->name = $request->name;
        $facialDesign->save();
        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacialDesign  $facialDesign
     * @return \Illuminate\Http\Response
     */
    public function show(FacialDesign $facialDesign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFacialDesignRequest  $request
     * @param  \App\Models\FacialDesign  $facialDesign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacialDesignRequest $request, FacialDesign $facialDesign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacialDesign  $facialDesign
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacialDesign $facialDesign)
    {
        //
    }
}
