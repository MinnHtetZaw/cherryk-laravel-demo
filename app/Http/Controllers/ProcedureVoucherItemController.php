<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureVoucherItemRequest;
use App\Http\Requests\UpdateProcedureVoucherItemRequest;
use App\Models\ProcedureVoucherItem;

class ProcedureVoucherItemController extends Controller
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
     * @param  \App\Http\Requests\StoreProcedureVoucherItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureVoucherItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureVoucherItem  $procedureVoucherItem
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureVoucherItem $procedureVoucherItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureVoucherItemRequest  $request
     * @param  \App\Models\ProcedureVoucherItem  $procedureVoucherItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureVoucherItemRequest $request, ProcedureVoucherItem $procedureVoucherItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureVoucherItem  $procedureVoucherItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureVoucherItem $procedureVoucherItem)
    {
        //
    }
}
