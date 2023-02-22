<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleCustomerRequest;
use App\Http\Requests\UpdateSaleCustomerRequest;
use App\Models\SaleCustomer;

class SaleCustomerController extends Controller
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
     * @param  \App\Http\Requests\StoreSaleCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleCustomer  $saleCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(SaleCustomer $saleCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleCustomerRequest  $request
     * @param  \App\Models\SaleCustomer  $saleCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleCustomerRequest $request, SaleCustomer $saleCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleCustomer  $saleCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleCustomer $saleCustomer)
    {
        //
    }
}
