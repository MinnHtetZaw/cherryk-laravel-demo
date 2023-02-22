<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMesoFatRequest;
use App\Http\Requests\UpdateMesoFatRequest;
use App\Http\Resources\MesoFatResource;
use App\Models\MesoFat;

class MesoFatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesoFat = MesoFat::all();
        return MesoFatResource::collection($mesoFat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMesoFatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMesoFatRequest $request)
    {
        $mesoFat = new MesoFat();
        $mesoFat->name = $request->name;
        $mesoFat->save();
        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MesoFat  $mesoFat
     * @return \Illuminate\Http\Response
     */
    public function show(MesoFat $mesoFat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMesoFatRequest  $request
     * @param  \App\Models\MesoFat  $mesoFat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMesoFatRequest $request, MesoFat $mesoFat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MesoFat  $mesoFat
     * @return \Illuminate\Http\Response
     */
    public function destroy(MesoFat $mesoFat)
    {
        //
    }
}
