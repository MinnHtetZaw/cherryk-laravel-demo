<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEmrSymptomRequest;
use App\Http\Requests\UpdateCustomerEmrSymptomRequest;
use App\Models\CustomerEmrSymptom;

class CustomerEmrSymptomController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomerEmrSymptomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEmrSymptomRequest $request)
    {
        //
        $request->validate([
            'customer_emr_id'=>'required',
            'symptom_unit_id'=>'required',
            'condition'=>'required',
        ]);
        $cus_symptom = new CustomerEmrSymptom();
        $cus_symptom->customer_emr_id = $request->customer_emr_id;
        $cus_symptom->symptom_unit_id = $request->symptom_unit_id;
        $cus_symptom->condition = $request->condition;
        $cus_symptom->description = $request->description;
        $cus_symptom->save();
        return response()->json([
            'data'=>$cus_symptom,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerEmrSymptom  $customerEmrSymptom
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEmrSymptom $customerEmrSymptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEmrSymptomRequest  $request
     * @param  \App\Models\CustomerEmrSymptom  $customerEmrSymptom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEmrSymptomRequest $request, CustomerEmrSymptom $customerEmrSymptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerEmrSymptom  $customerEmrSymptom
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEmrSymptom $customerEmrSymptom)
    {
        //
    }
}
