<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcneRequest;
use App\Http\Requests\UpdateAcneRequest;
use App\Http\Resources\AcneResource;
use App\Models\Acne;

class AcneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $acne = Acne::all();
        return AcneResource::collection($acne);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcneRequest $request)
    {
        $acne = new Acne();
        $acne->name = $request->name;
        $acne->save();
        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acne  $acne
     * @return \Illuminate\Http\Response
     */
    public function show(Acne $acne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcneRequest  $request
     * @param  \App\Models\Acne  $acne
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcneRequest $request, Acne $acne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acne  $acne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acne $acne)
    {
        //
    }
}
