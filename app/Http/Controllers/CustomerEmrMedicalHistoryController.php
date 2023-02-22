<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEmrMedicalHistoryRequest;
use App\Http\Requests\UpdateCustomerEmrMedicalHistoryRequest;
use App\Models\CustomerEmrMedicalHistory;

class CustomerEmrMedicalHistoryController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomerEmrMedicalHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEmrMedicalHistoryRequest $request)
    {
        //
        $request->validate([
            'customer_emr_id'=>'required',
            'medical_history_id'=>'required',
        ]);
        $medical_history = new CustomerEmrMedicalHistory();
        $medical_history->customer_emr_id = $request->customer_emr_id;
        $medical_history->medical_history_id = $request->medical_history_id;
        $medical_history->save();
        return response()->json([
            'data'=>$medical_history,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerEmrMedicalHistory  $customerEmrMedicalHistory
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEmrMedicalHistory $customerEmrMedicalHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEmrMedicalHistoryRequest  $request
     * @param  \App\Models\CustomerEmrMedicalHistory  $customerEmrMedicalHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEmrMedicalHistoryRequest $request, CustomerEmrMedicalHistory $customerEmrMedicalHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerEmrMedicalHistory  $customerEmrMedicalHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEmrMedicalHistory $customerEmrMedicalHistory)
    {
        //
    }
}
