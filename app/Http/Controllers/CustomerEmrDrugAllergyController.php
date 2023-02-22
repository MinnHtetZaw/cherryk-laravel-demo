<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEmrDrugAllergyRequest;
use App\Http\Requests\UpdateCustomerEmrDrugAllergyRequest;
use App\Models\CustomerEmrDrugAllergy;

class CustomerEmrDrugAllergyController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomerEmrDrugAllergyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEmrDrugAllergyRequest $request)
    {
        $request->validate([
            'customer_emr_id'=>'required',
            'drug_id'=>'required',
        ]);
        $drug = new CustomerEmrDrugAllergy();
        $drug->customer_emr_id = $request->customer_emr_id;
        $drug->drug_id = $request->drug_id;
        $drug->save();
        return response()->json([
            'data'=>$drug,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerEmrDrugAllergy  $customerEmrDrugAllergy
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEmrDrugAllergy $customerEmrDrugAllergy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEmrDrugAllergyRequest  $request
     * @param  \App\Models\CustomerEmrDrugAllergy  $customerEmrDrugAllergy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEmrDrugAllergyRequest $request, CustomerEmrDrugAllergy $customerEmrDrugAllergy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerEmrDrugAllergy  $customerEmrDrugAllergy
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEmrDrugAllergy $customerEmrDrugAllergy)
    {
        //
    }
}
