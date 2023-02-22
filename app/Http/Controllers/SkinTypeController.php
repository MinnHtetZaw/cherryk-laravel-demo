<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkinTypeRequest;
use App\Http\Requests\UpdateSkinTypeRequest;
use App\Http\Resources\SkinCareResource;
use App\Models\SkinType;

class SkinTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skin_types = SkinType::all();
        return SkinCareResource::collection($skin_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkinTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkinTypeRequest $request)
    {
        $skinType = new SkinType();
        $skinType->name = $request->name;
        $skinType->save();
        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SkinType  $skinType
     * @return \Illuminate\Http\Response
     */
    public function show(SkinType $skinType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkinTypeRequest  $request
     * @param  \App\Models\SkinType  $skinType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkinTypeRequest $request, SkinType $skinType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SkinType  $skinType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkinType $skinType)
    {
        //
    }
}
