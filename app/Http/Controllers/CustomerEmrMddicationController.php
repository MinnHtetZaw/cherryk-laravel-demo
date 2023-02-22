<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEmrMddicationRequest;
use App\Http\Requests\UpdateCustomerEmrMddicationRequest;
use App\Models\CustomerEmrMddication;

class CustomerEmrMddicationController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomerEmrMddicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEmrMddicationRequest $request)
    {
        //
        $request->validate([
            'customer_emr_id'=>'required',
            'medication_id'=>'required',
        ]);
        $medication = new CustomerEmrMddication();
        $medication->customer_emr_id = $request->customer_emr_id;
        $medication->medication_id = $request->medication_id;
        $medication->save();
        return response()->json([
            'data'=>$medication,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerEmrMddication  $customerEmrMddication
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEmrMddication $customerEmrMddication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEmrMddicationRequest  $request
     * @param  \App\Models\CustomerEmrMddication  $customerEmrMddication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEmrMddicationRequest $request, CustomerEmrMddication $customerEmrMddication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerEmrMddication  $customerEmrMddication
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEmrMddication $customerEmrMddication)
    {
        //
    }
}
