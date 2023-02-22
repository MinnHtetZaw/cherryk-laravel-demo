<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\CountingUnitItem;
use App\Models\CountingUnitProcedureItem;
use App\Models\ItemPurchase;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\SupplierCredit;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase_Lists = Purchase::orderBy('purchase_date','desc')->get();
        return response()->json([
            'data'=>$purchase_Lists,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        try {
            DB::beginTransaction();
            $supplier = Supplier::find($request->supplier_id);
            $purchase = new Purchase();
            $purchase->purchase_date = $request->purchase_date;
            $purchase->supplier_name = $supplier->name;
            $purchase->supplier_id = $supplier->id;
            $purchase->total_qty = $request->total_qty;
            $purchase->total_price = $request->total_price;
            $purchase->remark = $request->remark;
            $purchase->payment_type = $request->payment_type;
            $purchase->pay_amount = $request->pay_amount;
            $purchase->credit_amount = $request->credit_amount;
            $purchase->save();

            if ($request->credit_amount){ //Supplier ကို credit amount တိုး
                $supplier->credit_amount += $purchase->credit_amount;
                $supplier->update();
            }
            if ($purchase->total_price > $purchase->pay_amount){
                $credit_amount = $purchase->total_price - $purchase->pay_amount;
                $supplierCredit = new SupplierCredit();
                $supplierCredit->purchase_id = $purchase->id;
                $supplierCredit->supplier_id = $purchase->supplier_id;
                $supplierCredit->credit_amount = $credit_amount;
                $supplierCredit->status = '0';// 0 is unpaid
                $supplierCredit->save();
            }
            if (isset($request->item_id)){
                $item_types = $request->item_type;
                $item_id = $request->item_id;
                $item_name = $request->item_name;
                $purchase_price = $request->purchase_price;
                $qty = $request->qty;
                $sub_total = $request->sub_total;
                $a=$b=$c=$d=$e=$f=$g=0;
                $aa=$bb=$cc=$dd=$ee=0;
                foreach ($item_types as $item_type){

                    $item = new ItemPurchase();
                    $item->purchase_id = $purchase->id;
                    $item->item_id = $item_id[$a++];
                    $item->item_name = $item_name[$b++];
                    $item->purchase_price = $purchase_price[$c++];
                    $item->qty = $qty[$d++];
                    $item->sub_total = $sub_total[$e++];
                    $item->save();

                    if ($item_type == 1){

                        $current_item = CountingUnitItem::find($item->item_id);
                        $current_qty = $current_item->current_qty;
                        $current_item->current_qty = $current_qty + $item->qty;
                        $current_item->update();

                    }else if ($item_type == 2){
                        $current_procedure_item = CountingUnitProcedureItem::find($item->item_id);
                        $current_qty = $current_procedure_item->current_qty;
                        $current_procedure_item->current_qty = $current_qty + $item->qty;
                        $current_procedure_item->update();
                    }
                }
            }
            DB::commit();
            return response()->json([
                'data'=>'Success',
            ],200);
        }catch (Exception $exception){
            DB::rollBack();
            return response()->json([
                'data'=>$exception,
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return  response()->json([
            "data" => $purchase,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        $supplier = Supplier::find($request->supplier_id);
        $purchase->purchase_date = $request->purchase_date;
        $purchase->supplier_name = $supplier->name;
        $purchase->supplier_id = $supplier->id;
        $purchase->remark = $request->remark;
        $purchase->update();
        return response()->json([
            'data'=>'Success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return response()->json([
            'data'=>'Success'
        ]);
    }
}
