<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Item;
use App\Models\Treatment;
use App\Http\Requests\StoreTreatmentRequest;
use App\Http\Requests\UpdateTreatmentRequest;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $treatment = Treatment::all();
        return response()->json([
            "data" => $treatment,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTreatmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreatmentRequest $request)
    {
        $request->validate([
           'code'=>'required',
           'name'=>'required',
           'body_part'=>'required',
        ]);
        $treatment = new Treatment();
        $treatment->code = $request->code;
        $treatment->name = $request->name;
        $treatment->body_part = $request->body_part;
        $treatment->description = $request->description;
        $treatment->save();
        return response()->json([
            "data" => $treatment,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        return response()->json([
            "data"=>$treatment
            ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTreatmentRequest  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTreatmentRequest $request, Treatment $treatment)
    {
        //
        $request->validate([
            'code'=>'required',
            'name'=>'required',
            'body_part'=>'required',
        ]);
        $treatment->code = $request->code;
        $treatment->name = $request->name;
        $treatment->body_part = $request->body_part;
        $treatment->description = $request->description;
        $treatment->update();
        return response()->json([
            "data" => $treatment,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment)
    {
        //
        $treatment->delete();
        return response()->json(null);
    }

    public function search(Request $request){
        $search = $request->search;
        $treatments = Treatment::where('name', 'like', '%'.$search.'%')->orWhere('code','like','%'.$search.'%')->orWhere('body_part','like','%'.$search.'%')->get();
        return response()->json([
            "data" =>$treatments,
        ],200);
    }
}
