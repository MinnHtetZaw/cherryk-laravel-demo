<?php

namespace App\Http\Controllers;

use App\Exports\ProcedureVouchersExport;
use App\Http\Requests\StoreProcedureVoucherRequest;
use App\Http\Requests\UpdateProcedureVoucherRequest;
use App\Http\Resources\ProcedureVoucherResource;
use App\Models\CountingUnitItem;
use App\Models\Customer;
use App\Models\CustomerCredit;
use App\Models\Procedure;
use App\Models\ProcedureVoucher;
use App\Models\ProcedureVoucherItem;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProcedureVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedureVouchers = ProcedureVoucher::when(request('key_words'),fn($q)=>$q->
        where('procedure_voucher_number','like','%'.request('key_words').'%')->
            orWhere('customer_name','like','%'.request('key_words').'%')->
            orWhere('customer_phone','like','%'.request('key_words').'%'))->
        when(request('filter_date'),fn($q)=>$q->where('voucher_date',request('filter_date')))
            ->orderBy('id','desc')->get();
//        $procedureVouchers = ProcedureVoucher::orderBy('id','desc')->get();
        return ProcedureVoucherResource::collection($procedureVouchers);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcedureVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureVoucherRequest $request)
    {
        try {
            DB::beginTransaction();
            $count = ProcedureVoucher::count();
            $procedureVoucher = new ProcedureVoucher();
            $procedureVoucher->procedure_id = $request->procedure_id;
            $procedureVoucher->customer_name = $request->customer_name;
            $procedureVoucher->customer_phone = $request->customer_phone;
            $procedureVoucher->total_amount = $request->total_amount;
            $procedureVoucher->pay_amount = $request->pay_amount;
            $procedureVoucher->balance = $request->balance;
            $procedureVoucher->procedure_voucher_number = 'PVOU'.sprintf("%04s", $count + 1);
            $now_date = Carbon::now();
            $procedureVoucher->voucher_date = $now_date;
            $procedureVoucher->save();
            $procedure = Procedure::find($request->procedure_id);
            $procedure->status = 'check';
            $procedure->update();
            $customer = Customer::find($procedure->customer_id);
            $customer->total_amount += $request->pay_amount;
            if ($customer->total_amount >= 1000000){
                $customer->level = '1';
            }
            $customer->visit_time += 1;
            $customer->update();
            if ($request->total_amount > $request->pay_amount){
                $credit_amount = $request->total_amount - $request->pay_amount;
                $customer_credit = new CustomerCredit();
                $customer_credit->customer_id = $customer->id;
                $customer_credit->procedure_id = $procedure->id;
                $customer_credit->credit_amount = $credit_amount;
                $customer_credit->save();
                $customer->credit_amount += $credit_amount;
                $customer->update();
            }
            if ($request->procedure_items){
                foreach (json_decode($request->procedure_items) as $procedure_item){
                    $procedureVoucherItem = new ProcedureVoucherItem();
                    $procedureVoucherItem->procedure_voucher_id = $procedureVoucher->id;
                    $procedureVoucherItem->item_unit_id = $procedure_item->item_id ?? 1;
                    $procedureVoucherItem->name = $procedure_item->name;
                    $procedureVoucherItem->qty = $procedure_item->qty;
                    $procedureVoucherItem->selling_price = $procedure_item->selling_price;
                    $procedureVoucherItem->total_price = $procedure_item->total_price;
                    $procedureVoucherItem->discount_type = $procedure_item->dis_type;
                    $procedureVoucherItem->discount_value = $procedure_item->dis_val;
                    $procedureVoucherItem->is_discount = $procedure_item->is_dis;
                    $procedureVoucherItem->save();
//reduce stock
                    $item_unit = CountingUnitItem::find($procedureVoucherItem->item_unit_id);
                    $item_unit->current_qty -= $procedureVoucherItem->qty;
                    $item_unit->update();
                }
            }
            DB::commit();
            return response()->json([
                'data' => 'Success',
            ],200);
        }catch (Exception $error){
            DB::rollBack();
            return response()->json([
                'data' => $error,
            ],200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureVoucher  $procedureVoucher
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureVoucher $procedureVoucher)
    {
        return new ProcedureVoucherResource($procedureVoucher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureVoucherRequest  $request
     * @param  \App\Models\ProcedureVoucher  $procedureVoucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureVoucherRequest $request, ProcedureVoucher $procedureVoucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureVoucher  $procedureVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureVoucher $procedureVoucher)
    {
        //
    }

    public function export()
    {
        return Excel::download(new ProcedureVouchersExport, 'procedureVouchers.xlsx');
    }
}
