<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePackageMedicineRequest;
use App\Http\Requests\UpdatePackageMedicineRequest;
use App\Models\PackageMedicine;

class PackageMedicineController extends Controller
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
     * @param  \App\Http\Requests\StorePackageMedicineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageMedicineRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageMedicine  $packageMedicine
     * @return \Illuminate\Http\Response
     */
    public function show(PackageMedicine $packageMedicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageMedicineRequest  $request
     * @param  \App\Models\PackageMedicine  $packageMedicine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageMedicineRequest $request, PackageMedicine $packageMedicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageMedicine  $packageMedicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageMedicine $packageMedicine)
    {
        //
    }
}
