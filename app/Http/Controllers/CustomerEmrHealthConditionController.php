<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEmrHealthConditionRequest;
use App\Http\Requests\UpdateCustomerEmrHealthConditionRequest;
use App\Models\CustomerEmrHealthCondition;
use Illuminate\Database\Eloquent\Model;

class CustomerEmrHealthConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerEmrHealthConditions = CustomerEmrHealthCondition::all();
        return response()->json([
            'data'=>$customerEmrHealthConditions,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerEmrHealthConditionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEmrHealthConditionRequest $request)
    {
        $request->validate([
            'customer_emr_id'=>'required',
            'health_condition_id'=>'required',
        ]);
        $customerEmrHealthCondition = new CustomerEmrHealthCondition();
        $customerEmrHealthCondition->customer_emr_id = $request->customer_emr_id;
        $customerEmrHealthCondition->health_condition_id = $request->health_condition_id;
        $customerEmrHealthCondition->save();
        return response()->json([
            'data'=>$customerEmrHealthCondition,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerEmrHealthCondition  $customerEmrHealthCondition
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEmrHealthCondition $customerEmrHealthCondition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEmrHealthConditionRequest  $request
     * @param  \App\Models\CustomerEmrHealthCondition  $customerEmrHealthCondition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEmrHealthConditionRequest $request, CustomerEmrHealthCondition $customerEmrHealthCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerEmrHealthCondition  $customerEmrHealthCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEmrHealthCondition $customerEmrHealthCondition)
    {
        //
    }
}
