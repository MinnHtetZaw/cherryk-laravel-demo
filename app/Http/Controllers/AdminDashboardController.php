<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminDashboardRequest;
use App\Http\Requests\UpdateAdminDashboardRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\ProcedureResource;
use App\Http\Resources\ProcedureTreatmentResource;
use App\Models\AdminDashboard;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Procedure;
use App\Models\ProcedureTreatment;
use App\Models\ProcedureVoucher;
use App\Models\Purchase;
use App\Models\SaleVoucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_month = Carbon::now()->format('m');
        $procedure = ProcedureVoucher::whereMonth('voucher_date',$current_month)->get();
        $monthly_procedure = $procedure->pluck('pay_amount')->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $sale = SaleVoucher::whereMonth('voucher_date',$current_month)->get();
        $monthly_sale = $sale->pluck('total_price')->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $incomeByMonth = Income::whereMonth('date',$current_month)->get();
        $monthly_income = $incomeByMonth->pluck('amount')->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $expenseByMonth = Expense::whereMonth('date',$current_month)->get();
        $monthly_expense = $expenseByMonth->pluck('amount')->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $purchaseByMonth = Purchase::whereMonth('purchase_date',$current_month)->get();
        $monthly_purchase = $purchaseByMonth->pluck('total_price')->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        $monthly_net_profit = ($monthly_procedure ?? 0 + $monthly_sale ?? 0 + $monthly_income ?? 0) - ($monthly_expense ?? 0 + $monthly_purchase ?? 0);
        $customer= Customer::latest()->get()->take(5);
        $popular_customer= Customer::orderBy('total_amount','desc')->get()->take(5);
        $recent_customers= CustomerResource::collection($customer);
        $popular_customers= CustomerResource::collection($popular_customer);

        $procedure = Procedure::orderBy('created_at','desc')->get()->take(5);
        $recent_activity = ProcedureResource::collection($procedure);
        $profit_loss = [];
        array_push($profit_loss,$monthly_procedure ?? 0);
        array_push($profit_loss,$monthly_sale ?? 0);
        array_push($profit_loss,$monthly_income ?? 0);
        array_push($profit_loss,$monthly_expense ?? 0);
        array_push($profit_loss,$monthly_purchase ?? 0);

//        return $total_sale;
//        Profit Loss
//        $sale = SaleVoucher::whereMonth('voucher_date','')->get();

        $income = Income::orderBy('date','desc')->get();
        $expenses = Expense::orderBy('date','desc')->get();
//        =============
//        Patient Visit By Month
        $patient_visits = [];
        for ($i=1; $i <= 12; $i++){
            $count = Procedure::whereMonth('created_at',$i)->count();
            array_push($patient_visits,$count);
        }


        $procedure_treatment = ProcedureTreatment::all()->pluck('name');
        $popular_treatment = $procedure_treatment->countBy()->sortDesc()->take(10);
//        $a = array_map(function($v){return array_values($v);}, $a);

//        $procedure_treatment_count = array_count_values($procedure_treatment->treatment_unit_id);

        //Today Date
        $today = Carbon::now()->format('Y-m-d');

//        Today Appointment
        $today_appointment = Appointment::where('date',$today)->orderBy('date','desc')->get();
        $today_appointments = AppointmentResource::collection($today_appointment);

        //Sale
        $sale = SaleVoucher::all();
        $sale_price = $sale->pluck('pay');
        $total_sale = $sale_price->reduce(function ($carry, $item) {
            return $carry + $item;
        });

        $today_sale = SaleVoucher::where('voucher_date',$today)->get();
        $today_sale_price = $today_sale->pluck('pay');
        $today_sale_total = $today_sale_price->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        //=============================
        //Purchase
        $today_purchase = Purchase::where('purchase_date',$today)->get();
        $today_purchase_price = $today_purchase->pluck('total_price');
        $today_purchase_total = $today_purchase_price->reduce(function ($carry, $item) {
            return $carry + $item;
        });
        //=====================
        //Income
        $today_income = Income::where('date',$today)->get();
        $today_income_price = $today_income->pluck('amount');
        $today_income_total = $today_income_price->reduce(function ($carry, $item) {
            return $carry + $item;
        });
//        Expense
//        Today Expense
        $expense = Expense::pluck('amount');
        $total_expense = $expense->reduce(function($carry,$item){
            return $carry + $item;
        });
        $today_expense = Expense::where('date',$today)->get();
        $today_expense_price = $today_expense->pluck('amount');
        $today_expense_total = $today_expense_price->reduce(function($carry,$item){
            return $carry + $item;
        });
        //Patient
        $total_patient= Customer::count();
        $today_patient = ProcedureVoucher::where('voucher_date',$today)->count();
            //=========================
        $info = null;
        $info_array = array('sale_total'=>$total_sale ?? 0,'today_sale_total'=> $today_sale_total ?? 0, 'patient_qty'=>$patient ?? 0,
            'today_purchase_total'=>$today_purchase_total ?? 0,'today_income_total'=>$today_income_total ?? 0,);
        $info= $info_array;
        return response()->json([
            'data' => $info,
            'today_sale'=>$today_sale_total ?? 0,
            'total_sale'=>$total_sale ?? 0,
            'total_expense'=>$total_expense,
            'today_purchase'=>$today_purchase_total ?? 0,
            'today_income' => $today_income_total ?? 0,
            'today_expense' => $today_expense_total ?? 0,
            'today_patient' => $today_patient ?? 0,
            'total_patient' => $total_patient ?? 0,
            'total_profit'=>$total_sale - $total_expense ?? 0,
            'patient_visits'=>$patient_visits,
            'popular_treatments'=>$popular_treatment,
            'monthly_sale'=>$monthly_sale ?? 0,
            'monthly_procedure'=>$monthly_procedure ?? 0,
            'monthly_income'=>$monthly_income ?? 0,
            'profit_loss'=>$profit_loss ?? 0,
            'recent_customers'=>$recent_customers ?? 'Patient',
            'popular_customers'=>$popular_customers ?? 'Patient',
            'recent_activities'=>$recent_activity ?? 'Procedure',
            'today_appointments'=>$today_appointments ?? 'Appointment',
            'monthly_net_profit'=>$monthly_net_profit ?? 'Net_Profit',
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminDashboardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminDashboard  $adminDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(AdminDashboard $adminDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminDashboardRequest  $request
     * @param  \App\Models\AdminDashboard  $adminDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminDashboardRequest $request, AdminDashboard $adminDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminDashboard  $adminDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminDashboard $adminDashboard)
    {
        //
    }
}
