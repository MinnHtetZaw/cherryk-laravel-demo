<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierCreditRequest;
use App\Http\Requests\UpdateSupplierCreditRequest;
use App\Models\Supplier;
use App\Models\SupplierCredit;

class SupplierCreditController extends Controller
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
     * @param  \App\Http\Requests\StoreSupplierCreditRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierCreditRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierCredit  $supplierCredit
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierCredit $supplierCredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierCreditRequest  $request
     * @param  \App\Models\SupplierCredit  $supplierCredit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierCreditRequest $request, SupplierCredit $supplierCredit)
    {
        $credit_amount = $supplierCredit->credit_amount;
        $pay_amount = $request->pay_amount;
        $supplier = Supplier::find($request->supplier_id);
        $supplier->credit_amount -= $request->pay_amount;
        $supplier->update();
        $supplierCredit->credit_amount -= $pay_amount;
        if ( $credit_amount - $pay_amount = 0){
            $supplierCredit->status = '2';
        }else{
            $supplierCredit->status = '1';
        }
        $supplierCredit->update();
        return response()->json([
            'data' => 'Success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierCredit  $supplierCredit
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierCredit $supplierCredit)
    {
        //
    }
}
