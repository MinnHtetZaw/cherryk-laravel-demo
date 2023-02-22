<?php

namespace App\Http\Controllers;

use App\Models\CustomerEmrSymptom;
use App\Models\EmrSymptom;
use App\Models\PreviousEmr;
use App\Models\EmrHealth;
use App\Http\Requests\StorePreviousEmrRequest;
use App\Http\Requests\UpdatePreviousEmrRequest;

class PreviousEmrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emr = PreviousEmr::all();
        return response()->json([
            "data"=>$emr,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePreviousEmrRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreviousEmrRequest $request)
    {

        $pre_emr = new PreviousEmr();
        $pre_emr->remark =$request->remark;
        $pre_emr->diagnosis = $request->diagnosis;
        $pre_emr->customer_id = $request->customer_id;
        $pre_emr->save();
        $conditions = $request->condition;
        $medications = $request->medication;

        foreach ($conditions as $con) {
            $emr_health = new EmrHealth();
            $emr_health->previous_emr_id =$pre_emr->id;
            $emr_health->condition = $con;
            $emr_health->save();
        }


            $symptom_id = $request->symptom_id;
            foreach ($symptom_id as $symptom) {
                $emr = new CustomerEmrSymptom();
                $emr->customer_emr_id = $pre_emr->id;
                $emr->symptom_id = $symptom_id;
                $emr->save();
            }


        return response()->json([
            'data'=>$emr,
//            "previous_emr" => $pre_emr,
//            "emr_health" => $emr_health,
        ],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreviousEmr  $previousEmr
     * @return \Illuminate\Http\Response
     */
    public function show(PreviousEmr $previousEmr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreviousEmrRequest  $request
     * @param  \App\Models\PreviousEmr  $previousEmr
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreviousEmrRequest $request, PreviousEmr $previousEmr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreviousEmr  $previousEmr
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreviousEmr $previousEmr)
    {
        //
    }
}
