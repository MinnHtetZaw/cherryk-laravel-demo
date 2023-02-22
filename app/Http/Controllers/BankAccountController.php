<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Http\Resources\BankAccountResource;
use App\Models\BankAccount;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = BankAccount::all();
        return BankAccountResource::collection($banks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBankAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankAccountRequest $request)
    {
        $request->validate([
           'bank_name' => 'required',
           'account_number' => 'required',
           'holder_name' => 'required',
           'open_date' => 'required',
           'balance' => 'required',
           'bank_address' => 'required',
           'bank_contact' => 'required',
        ]);
        $bank = new BankAccount();
        $bank->bank_name = $request->bank_name;
        $bank->account_number = $request->account_number;
        $bank->holder_name = $request->holder_name;
        $bank->open_date = $request->open_date;
        $bank->balance = $request->balance;
        $bank->bank_address = $request->bank_address;
        $bank->bank_contact = $request->bank_contact;
        $bank->save();
        return response()->json([
            'data'=>$bank,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bankAccount)
    {
        return response()->json([
            'data'=>$bankAccount,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankAccountRequest  $request
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankAccountRequest $request, BankAccount $bankAccount)
    {
        $request->validate([
            'bank_name' => 'required',
            'account_number' => 'required',
            'holder_name' => 'required',
            'open_date' => 'required',
            'balance' => 'required',
            'bank_address' => 'required',
            'bank_contact' => 'required',
        ]);
        $bankAccount->bank_name = $request->bank_name;
        $bankAccount->account_number = $request->account_number;
        $bankAccount->holder_name = $request->holder_name;
        $bankAccount->open_date = $request->open_date;
        $bankAccount->balance = $request->balance;
        $bankAccount->bank_address = $request->bank_address;
        $bankAccount->bank_contact = $request->bank_contact;
        $bankAccount->update();
        return response()->json([
            'data'=>$bankAccount,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        $bankAccount->delete();
        return response()->json([
            'data'=>'Success',
        ],200);
    }
}
