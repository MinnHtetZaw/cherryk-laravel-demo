<?php

namespace App\Http\Controllers;

use App\Exports\SaleVoucherExport;
use App\Http\Requests\StoreSaleVoucherRequest;
use App\Http\Requests\UpdateSaleVoucherRequest;
use App\Http\Resources\SaleVoucherResource;
use App\Models\BankAccount;
use App\Models\CountingUnitItem;
use App\Models\CountingUnitSale;
use App\Models\SaleVoucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SaleVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleVoucher = SaleVoucher::
        when(\request('keyword'),fn($q)=>$q
            ->where('voucher_no','like','%'.\request('keyword').'%')
            ->orWhere('voucher_date',\request('keyword'))
            ->orWhere('customer_name','like','%'.\request('keyword').'%')
        )
            ->orderBy('voucher_date', 'Desc')->get();
        return SaleVoucherResource::collection($saleVoucher);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleVoucherRequest $request)
    {
        $count = SaleVoucher::count();
        $sale_voucher = new SaleVoucher();
        $sale_voucher->voucher_no = "SVOU-".sprintf("%04s", $count + 1);
        $sale_voucher->voucher_date = Carbon::now();
        $sale_voucher->total_price = $request->total_price;
        $sale_voucher->customer_name = $request->customer_name;
        $sale_voucher->customer_phone = $request->customer_phone;
        $sale_voucher->pay = $request->pay_amount;
        $sale_voucher->payment_type = $request->payment_type;
        $sale_voucher->refund = $request->refund;
        $sale_voucher->balance = $request->balance;
        $sale_voucher->net_amount = $request->net_amount;
        $sale_voucher->discount_type = $request->discount_type;

        //bank transition
        if ($request->payment_type == 2){
            $bank = BankAccount::find($request->bank_account);
            $bank->balance += $request->pay_amount;
            $bank->update();
        }
        if ($request->discount_value){
            $sale_voucher->discount_value = $request->discount_value;
        }
        $sale_voucher->save();
        $item_name = $request->item_name;
        $item_qty = $request->item_qty;
        $item_price = $request->item_price;
        $item_sub_total = $request->item_sub_total;
        $item_id = $request->item_id;
        $item_discount_type = $request->item_discount_type;
        $item_discount_value = $request->item_discount_value;
        $a=$b=$c=$d=$e=$f=$g=0;
//        ===========
        foreach($item_id as $item){
            $item = new CountingUnitSale();
            $item->sale_voucher_id = $sale_voucher->id;
            $item->item_id = $item_id[$a++];
            $item->item_name = $item_name[$b++];
            $item->item_qty = $item_qty[$c++];
            $item->item_price = $item_price[$d++];
            $item->item_sub_total = $item_sub_total[$e++];
            $item->item_discount_type = $item_discount_type[$f++];
            $item->item_discount_value = $item_discount_value[$g++];
            $item->save();

            $current_item = CountingUnitItem::find($item->item_id);
            $current_qty = $current_item->current_qty;
            $current_item->current_qty = $current_qty - $item->item_qty;
            $current_item->update();
        }
//        ===========
        return response()->json([
            'data'=>$sale_voucher,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleVoucher  $saleVoucher
     * @return \Illuminate\Http\Response
     */
    public function show(SaleVoucher $saleVoucher)
    {
        return response()->json([
            'data'=>$saleVoucher,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleVoucherRequest  $request
     * @param  \App\Models\SaleVoucher  $saleVoucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleVoucherRequest $request, SaleVoucher $saleVoucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleVoucher  $saleVoucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleVoucher $saleVoucher)
    {

    }

    public function searchByDate(Request $request){
        $sales = SaleVoucher::where('voucher_date',$request->date)->get();
        $sale_price = $sales->pluck('pay');
        $total = $sale_price->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        return response()->json([
            'data'=>$sales,
            'total'=>$total,
        ],200);
    }

    public function export(Excel $excel,SaleVoucherExport $export)
    {
        return Excel::download(new SaleVoucherExport(), 'sale.xlsx');
    }
}
