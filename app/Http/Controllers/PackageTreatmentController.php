<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageTreatmentRequest;
use App\Http\Requests\UpdatePackageTreatmentRequest;
use App\Models\PackageTreatment;

class PackageTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageTreatmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageTreatmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageTreatment  $packageTreatment
     * @return \Illuminate\Http\Response
     */
    public function show(PackageTreatment $packageTreatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageTreatmentRequest  $request
     * @param  \App\Models\PackageTreatment  $packageTreatment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageTreatmentRequest $request, PackageTreatment $packageTreatment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageTreatment  $packageTreatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageTreatment $packageTreatment)
    {
        //
    }
}
