<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerPayCreditRequest;
use App\Http\Requests\UpdateCustomerPayCreditRequest;
use App\Models\Customer;
use App\Models\CustomerCredit;
use App\Models\CustomerPayCredit;

class CustomerPayCreditController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomerPayCreditRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerPayCreditRequest $request)
    {
        $customerPayCredit = new CustomerPayCredit();
        $customerPayCredit->customer_id = $request->customer_id;
        $customerPayCredit->procedure_id = $request->procedure_id;
        $customerPayCredit->customer_credit_id = $request->customer_credit_id;
        $customerPayCredit->pay_amount = $request->pay_amount;
        $customerPayCredit->left_amount = $request->left_amount;
        $customerPayCredit->pay_date = $request->pay_date;
        $customerPayCredit->remark = $request->remark;
        if ($request->left_amount == 0){
            $customerPayCredit->status = 1;
        }
        $customerPayCredit->save();
        $customer_credit = CustomerCredit::find($request->customer_credit_id);
        $customer_credit->credit_amount -= $request->pay_amount;
        $customer_credit->update();
        $customer = Customer::find($request->customer_id);
        $customer->credit_amount -= $request->pay_amount;
        $customer->total_amount += $request->pay_amount;
        $customer->update();
        return response()->json([
            'data' => 'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerPayCredit  $customerPayCredit
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPayCredit $customerPayCredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerPayCreditRequest  $request
     * @param  \App\Models\CustomerPayCredit  $customerPayCredit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerPayCreditRequest $request, CustomerPayCredit $customerPayCredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerPayCredit  $customerPayCredit
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerPayCredit $customerPayCredit)
    {
        //
    }
}
