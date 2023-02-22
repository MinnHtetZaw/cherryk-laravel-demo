<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerCreditRequest;
use App\Http\Requests\UpdateCustomerCreditRequest;
use App\Models\CustomerCredit;

class CustomerCreditController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomerCreditRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerCreditRequest $request)
    {
        $customerCredit = new CustomerCredit();
        $customerCredit->customer_id = $request->customer_id;
        $customerCredit->credit_amount = $request->credit_amount;
        $customerCredit->procedure_id = $request->procedure_id;
        $customerCredit->save();
        return request()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerCredit  $customerCredit
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerCredit $customerCredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerCreditRequest  $request
     * @param  \App\Models\CustomerCredit  $customerCredit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerCreditRequest $request, CustomerCredit $customerCredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerCredit  $customerCredit
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerCredit $customerCredit)
    {
        //
    }
}
