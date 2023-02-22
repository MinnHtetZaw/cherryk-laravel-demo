<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountingUnitSaleRequest;
use App\Http\Requests\UpdateCountingUnitSaleRequest;
use App\Http\Resources\CountingUnitSaleResource;
use App\Models\CountingUnitSale;

class CountingUnitSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale_item = CountingUnitSale::all();
        return CountingUnitSaleResource::collection($sale_item);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCountingUnitSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountingUnitSaleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CountingUnitSale  $countingUnitSale
     * @return \Illuminate\Http\Response
     */
    public function show(CountingUnitSale $countingUnitSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCountingUnitSaleRequest  $request
     * @param  \App\Models\CountingUnitSale  $countingUnitSale
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountingUnitSaleRequest $request, CountingUnitSale $countingUnitSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CountingUnitSale  $countingUnitSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(CountingUnitSale $countingUnitSale)
    {
        //
    }
}
