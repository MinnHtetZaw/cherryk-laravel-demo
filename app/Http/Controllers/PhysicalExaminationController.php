<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhysicalExaminationRequest;
use App\Http\Requests\UpdatePhysicalExaminationRequest;
use App\Http\Resources\PhysicalExaminationResource;
use App\Models\PhysicalExamination;

class PhysicalExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $physicalExamination = PhysicalExamination::all();
        return PhysicalExaminationResource::collection($physicalExamination);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhysicalExaminationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhysicalExaminationRequest $request)
    {
        $physicalExamination = new PhysicalExamination();
        $physicalExamination->title = $request->title;
        $physicalExamination->save();
        return response()->json([
            'data'=>'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhysicalExamination  $physicalExamination
     * @return \Illuminate\Http\Response
     */
    public function show(PhysicalExamination $physicalExamination)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhysicalExaminationRequest  $request
     * @param  \App\Models\PhysicalExamination  $physicalExamination
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhysicalExaminationRequest $request, PhysicalExamination $physicalExamination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhysicalExamination  $physicalExamination
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhysicalExamination $physicalExamination)
    {
        //
    }
}
