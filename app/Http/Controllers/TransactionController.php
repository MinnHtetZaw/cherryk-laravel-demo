<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Customer;
use App\Models\Procedure;
use App\Models\ProcedureTreatment;
use App\Models\ProcedureVoucher;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json([
            'data'=>$transactions,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $transaction = new Transaction();
        $transaction->procedure_id = $request->procedure_id;
        $transaction->procedure_treatment_id = $request->procedure_treatment_id;
        $transaction->customer_id = $request->customer_id;
        $transaction->payment_type = $request->payment_type;
        $transaction->remark = $request->remark;
        $transaction->bank_account = $request->bank_account;
        $transaction->total_amount = $request->total_amount;
        $transaction->pay_amount = $request->pay_amount;
        $transaction->collect_amount = $request->collect_amount;
        $transaction->payment_date = $request->payment_date;
        $transaction->save();

        $procedure_treatment = ProcedureTreatment::find($request->procedure_treatment_id);
        $procedure_treatment->total_amount -= $request->pay_amount;
        $procedure_treatment->balance -= $request->pay_amount;
        $procedure_treatment->advance += $request->pay_amount;
        $procedure_treatment->update();

        $procedure = Procedure::find($request->procedure_id);
        $procedure->total_amount -= $request->pay_amount;
        if ($procedure->total_amount == 0){
            $procedure->status = 'paid';
        }
        $procedure->update();

        //Procedure Voucher
        $customer = Customer::find($transaction->customer_id);
        $customer->total_amount += $transaction->pay_amount;
        $customer->update();
//        $date = new \DateTime('Asia/Yangon');
//        $procedure_voucher = new ProcedureVoucher();
//        $procedure_voucher->voucher_date = $transaction->payment_date;
//        $procedure_voucher->customer_id = $customer->id;
//        $procedure_voucher->payment_type =  $transaction->payment_type;
//        $procedure_voucher->total_amount =  $transaction->total_amount;
//        $procedure_voucher->pay_amount =  $transaction->pay_amount;
//        $procedure_voucher->balance =  $transaction->collect_amount;
//        $procedure_voucher->remark =  $transaction->remark;
//        $procedure_voucher->save();

        return response()->json([
            $procedure
//            'transaction'=>$transaction,
//            'procedure_treatment' => $procedure_treatment,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
