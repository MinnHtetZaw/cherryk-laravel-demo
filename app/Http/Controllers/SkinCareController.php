<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkinCareRequest;
use App\Http\Requests\UpdateSkinCareRequest;
use App\Http\Resources\SkinCareResource;
use App\Models\SkinCare;

class SkinCareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skinCares = SkinCare::all();
        return SkinCareResource::collection($skinCares);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkinCareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkinCareRequest $request)
    {
        $skinCare = new SkinCare();
        $skinCare->name = $request->name;
        $skinCare->save();
        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SkinCare  $skinCare
     * @return \Illuminate\Http\Response
     */
    public function show(SkinCare $skinCare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkinCareRequest  $request
     * @param  \App\Models\SkinCare  $skinCare
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkinCareRequest $request, SkinCare $skinCare)
    {
        $skinCare->skin_care_id = $request->skin_care_id;
        $skinCare->description = $request->description;
        $skinCare->update();
        return response()->json([
            'data'=> 'Success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SkinCare  $skinCare
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkinCare $skinCare)
    {
        $skinCare->delete();
        return  response()->json([
            'data'=>'Success'
        ]);
    }
}
