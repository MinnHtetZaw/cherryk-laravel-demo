<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEmrCosmeticRequest;
use App\Http\Requests\UpdateCustomerEmrCosmeticRequest;
use App\Models\CustomerEmrCosmetic;

class CustomerEmrCosmeticController extends Controller
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
     * @param  \App\Http\Requests\StoreCustomerEmrCosmeticRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEmrCosmeticRequest $request)
    {
        //
        $request->validate([
            'customer_emr_id'=>'required',
            'cosmetic_id'=>'required',
        ]);
        $cosmetic = new CustomerEmrCosmetic();
        $cosmetic->customer_emr_id = $request->customer_emr_id;
        $cosmetic->cosmetic_id = $request->cosmetic_id;
        $cosmetic->save();
        return response()->json([
            'data'=>$cosmetic,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerEmrCosmetic  $customerEmrCosmetic
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEmrCosmetic $customerEmrCosmetic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEmrCosmeticRequest  $request
     * @param  \App\Models\CustomerEmrCosmetic  $customerEmrCosmetic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEmrCosmeticRequest $request, CustomerEmrCosmetic $customerEmrCosmetic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerEmrCosmetic  $customerEmrCosmetic
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEmrCosmetic $customerEmrCosmetic)
    {
        //
    }
}
