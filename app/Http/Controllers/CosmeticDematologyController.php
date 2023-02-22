<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCosmeticDematologyRequest;
use App\Http\Requests\UpdateCosmeticDematologyRequest;
use App\Models\CosmeticDematology;

class CosmeticDematologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cosmetics = CosmeticDematology::all();
        return response()->json([
            'data'=>$cosmetics,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCosmeticDematologyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCosmeticDematologyRequest $request)
    {
        //
        $request->validate([
            'name'=>'required',
        ]);
        $cosmetic = new CosmeticDematology();
        $cosmetic->name = $request->name;
        $cosmetic->save();
        return response()->json([
            'data'=>$cosmetic,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CosmeticDematology  $cosmeticDematology
     * @return \Illuminate\Http\Response
     */
    public function show(CosmeticDematology $cosmeticDematology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCosmeticDematologyRequest  $request
     * @param  \App\Models\CosmeticDematology  $cosmeticDematology
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCosmeticDematologyRequest $request, CosmeticDematology $cosmeticDematology)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CosmeticDematology  $cosmeticDematology
     * @return \Illuminate\Http\Response
     */
    public function destroy(CosmeticDematology $cosmeticDematology)
    {
        //
    }
}
