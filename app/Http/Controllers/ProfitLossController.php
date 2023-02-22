<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfitLossRequest;
use App\Http\Requests\UpdateProfitLossRequest;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\IncomeResource;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\SaleVoucherResource;
use App\Models\Expense;
use App\Models\Income;
use App\Models\ProcedureVoucher;
use App\Models\ProfitLoss;
use App\Models\Purchase;
use App\Models\SaleVoucher;

class ProfitLossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Total Sale By Month
        $monthly_total_sale = array();
        for ($i=1; $i <= 12; $i++){
            $sale_voucher = SaleVoucher::whereMonth('created_at',$i)->pluck('pay');
            $total = $sale_voucher->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            array_push($monthly_total_sale,$total ?? 0);
        }
        //Total Procedure Value By Month
        $monthly_procedure_value = array();
        for ($i=1; $i <= 12; $i++){
            $procedure_voucher = ProcedureVoucher::whereMonth('created_at',$i)->pluck('pay_amount');
            $total = $procedure_voucher->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            array_push($monthly_procedure_value,$total ?? 0);
        }

        //Total Income By Month
        $monthly_income = array();
        for ($i=1; $i <= 12; $i++){
            $income = Income::whereMonth('created_at',$i)->pluck('amount');
            $total = $income->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            array_push($monthly_income,$total ?? 0);
        }
        //Total Expense By Month
        $monthly_expense = array();
        for ($i=1; $i <= 12; $i++){
            $expense = Expense::whereMonth('created_at',$i)->pluck('amount');
            $total = $expense->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            array_push($monthly_expense,-$total ?? 0);
        }

        //Total Procedure Value By Month
        $monthly_purchase_value = array();
        for ($i=1; $i <= 12; $i++){
            $purchase = Purchase::whereMonth('created_at',$i)->pluck('pay_amount');
            $total = $purchase->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            array_push($monthly_purchase_value,-$total ?? 0);
        }

        //Total Procedure Value By Month
        $monthly_profit_value = array();
        for ($i=1; $i <= 12; $i++){
            $sale_voucher = SaleVoucher::whereMonth('created_at',$i)->pluck('pay');
            $procedure_voucher = ProcedureVoucher::whereMonth('created_at',$i)->pluck('pay_amount');
            $income = Income::whereMonth('created_at',$i)->pluck('amount');
            $expense = Expense::whereMonth('created_at',$i)->pluck('amount');
            $purchase = Purchase::whereMonth('created_at',$i)->pluck('pay_amount');

            $sale_val = $sale_voucher->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $procedure_val = $procedure_voucher->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $income_val = $income->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $expense_val = $expense->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $purchase_val = $purchase->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $total = $sale_val ?? 0 + $procedure_val ?? 0 + $income_val ?? 0;
            array_push($monthly_profit_value,$total ?? 0);
        }

        //Total loss Value By Month
        $monthly_loss_value = array();
        for ($i=1; $i <= 12; $i++){
            $expense = Expense::whereMonth('created_at',$i)->pluck('amount');
            $purchase = Purchase::whereMonth('created_at',$i)->pluck('pay_amount');
            $expense_val = $expense->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $purchase_val = $purchase->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $total = $expense_val ?? 0 + $purchase_val ?? 0;
            array_push($monthly_loss_value,-$total ?? 0);
        }

        //Total Net Profit Value By Month
        $monthly_net_value = array();
        for ($i=1; $i <= 12; $i++){
            $sale_voucher = SaleVoucher::whereMonth('created_at',$i)->pluck('pay');
            $procedure_voucher = ProcedureVoucher::whereMonth('created_at',$i)->pluck('pay_amount');
            $income = Income::whereMonth('created_at',$i)->pluck('amount');
            $expense = Expense::whereMonth('created_at',$i)->pluck('amount');
            $purchase = Purchase::whereMonth('created_at',$i)->pluck('pay_amount');
            $sale_val = $sale_voucher->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $procedure_val = $procedure_voucher->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $income_val = $income->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $expense_val = $expense->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $purchase_val = $purchase->reduce(function ($carry, $item) {
                return $carry + $item;
            });
            $plus = $sale_val ?? 0 + $procedure_val ?? 0+ $income_val ?? 0;
            $minus = $expense_val ?? 0 + $purchase_val ?? 0;
            $total = $plus - $minus;
            array_push($monthly_net_value,$total ?? 0);
        }


        $sale = SaleVoucher::orderBy('voucher_date','desc')->get();

        $income = Income::orderBy('date','desc')->get();
        $expenses = Expense::orderBy('date','desc')->get();
        $purchase = Purchase::all();


//        $purchase = Purchase::orderBy('date','desc')->get();
//        $purchase_price =
        $sale_price = $sale->pluck('pay');
        $income_price = $income->pluck('amount');
        $total_sale = $sale_price->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $total_income = $income_price->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $total_value = $total_sale + $total_income;

        //Percent
        $sale_percent = round(($total_sale / $total_value) * 100)  ;
        $income_percent = round(($total_income / $total_value) * 100)  ;
        return response()->json([
            'monthly_total_sale'=>$monthly_total_sale,
            'monthly_procedure_value'=>$monthly_procedure_value,
            'monthly_income'=>$monthly_income,
            'monthly_expense'=>$monthly_expense,
            'monthly_purchase'=>$monthly_purchase_value,
            'monthly_profit'=>$monthly_profit_value,
            'monthly_loss'=>$monthly_loss_value,
            'monthly_net'=>$monthly_net_value,
            'sales'=>SaleVoucherResource::collection($sale),
            'income'=>IncomeResource::collection($income),
            'sale_total'=> $total_sale,
            'income_total'=>$total_income,
            'total_value'=>$total_value,
            'sale_percent'=>$sale_percent,
            'income_percent'=>$income_percent,
            'expenses'=>ExpenseResource::collection($expenses),
            'purchases'=>PurchaseResource::collection($purchase),
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfitLossRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfitLossRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfitLoss  $profitLoss
     * @return \Illuminate\Http\Response
     */
    public function show(ProfitLoss $profitLoss)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfitLossRequest  $request
     * @param  \App\Models\ProfitLoss  $profitLoss
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfitLossRequest $request, ProfitLoss $profitLoss)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfitLoss  $profitLoss
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfitLoss $profitLoss)
    {
        //
    }
}
