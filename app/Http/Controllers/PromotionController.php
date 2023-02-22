<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();
        return response()->json([
            'data'=>$promotions,
        ],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        $promotion = new Promotion();
        $promotion->code = $request->code;
        $promotion->name = $request->name;
        $promotion->description = $request->description;
        $promotion->to = $request->to;
        $promotion->from = $request->from;
        $promotion->amount_type = $request->amount_type;
        if ($request->amount_type = 'percent'){
            $promotion->amount = $request->percent;

        }
        if ($request->amount_type = 'amount'){
            $promotion->amount = $request->amount;

        }

        if ($request->status == false){
            $promotion->status = 'active';
        }
        if ($request->status == true){
            $promotion->status = 'non-active';
        }
        $promotion->save();
        return response()->json([
            'data'=>$promotion,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePromotionRequest  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePromotionRequest $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
