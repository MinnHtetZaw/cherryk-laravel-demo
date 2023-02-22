<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFixAssetRequest;
use App\Http\Requests\UpdateFixAssetRequest;
use App\Models\FixAsset;
use App\Models\MachineryItem;
use Carbon\Carbon;

class FixAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = FixAsset::orderBy('start_date','desc')->get();
        $now_date = Carbon::now();
        $now = $now_date->toDateString();
        $find_date = FixAsset::where('future_date',$now)->get();
        $count = count($find_date);
        foreach($find_date as $m_dep){
            if($count != 0){
                $m_dep->future_date = date('Y-m-d', strtotime('+1 month', strtotime($m_dep->future_date)));
                $m_dep->current_price -= $m_dep->month_depreciation;
                $m_dep->save();
            }
        }
        return response()->json([
            'data'=>$assets,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFixAssetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFixAssetRequest $request)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'purchase_initial'=>'required',
            'salvage'=>'required',
            'start_date'=>'required',
        ]);
        $date = Carbon::create($request->start_date);
        $fix = new FixAsset();
        $fix->name = $request->name;
        $fix->description = $request->description;
        $fix->type = $request->type;
        $fix->purchase_initial = $request->purchase_initial;
        $fix->salvage = $request->salvage;
        $fix->use_life = $request->use_life;
        $fix->yearly_depreciation = $request->yearly_depreciation;
        $fix->month_depreciation = $request->month_depreciation;
        $fix->used_year = $request->used_year;
        $fix->remaining_year = $request->use_life;
        $fix->total_depreciation = $request->total_depreciation;
//        $fix->current_price = $request->current_price;
        $fix->start_date = $request->start_date;
        $fix->future_date = $date->addDays(30);
        $fix->save();
        //Machinery
        if($request->type == 'Machinery'){
            $machine = new MachineryItem();
            $machine->code = '001';
            $machine->name = $request->name;
            $machine->selling_price = 0;
            $machine->save();
        }
        return response()->json([
            'data'=>$machine,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FixAsset  $fixAsset
     * @return \Illuminate\Http\Response
     */
    public function show(FixAsset $fixAsset)
    {
        return response()->json([
            'data'=>$fixAsset,
        ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFixAssetRequest  $request
     * @param  \App\Models\FixAsset  $fixAsset
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFixAssetRequest $request, FixAsset $fixAsset)
    {
        if ($request->sell_end_type == 'Sell'){
            $fixAsset->sell_end_type = $request->sell_end_type;
            $fixAsset->sell_price = $request->sell_price;
            $fixAsset->profit_loss_value = $request->profit_loss_value;
            $fixAsset->sell_date = $request->sell_date;
        }else if ($request->sell_end_type == 'End'){
            $fixAsset->sell_end_type = $request->sell_end_type;
            $fixAsset->end_date = $request->end_date;
            $fixAsset->end_remark = $request->end_remark;
        }
        $fixAsset->update();
        return response()->json([
            'data'=>$fixAsset,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FixAsset  $fixAsset
     * @return \Illuminate\Http\Response
     */
    public function destroy(FixAsset $fixAsset)
    {
        //
    }
}
