<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDrugAllergyRequest;
use App\Http\Requests\UpdateDrugAllergyRequest;
use App\Models\DrugAllergy;

class DrugAllergyController extends Controller
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
     * @param  \App\Http\Requests\StoreDrugAllergyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDrugAllergyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DrugAllergy  $drugAllergy
     * @return \Illuminate\Http\Response
     */
    public function show(DrugAllergy $drugAllergy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDrugAllergyRequest  $request
     * @param  \App\Models\DrugAllergy  $drugAllergy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDrugAllergyRequest $request, DrugAllergy $drugAllergy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DrugAllergy  $drugAllergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugAllergy $drugAllergy)
    {
        //
    }
}
