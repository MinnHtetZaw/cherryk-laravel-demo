<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhysicalExamUnitRequest;
use App\Http\Requests\UpdatePhysicalExamUnitRequest;
use App\Http\Resources\PhysicalExamUnitResource;
use App\Models\PhysicalExamUnit;

class PhysicalExamUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $physicalExamUnit = PhysicalExamUnit::all();
        return PhysicalExamUnitResource::collection($physicalExamUnit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhysicalExamUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhysicalExamUnitRequest $request)
    {
        $physicalExamUnit = new PhysicalExamUnit();
        $physicalExamUnit->unit = $request->unit;
        $physicalExamUnit->physical_exam_id = $request->physical_exam_id;
        $physicalExamUnit->save();
        return response()->json([
            'data' => 'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhysicalExamUnit  $physicalExamUnit
     * @return \Illuminate\Http\Response
     */
    public function show(PhysicalExamUnit $physicalExamUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhysicalExamUnitRequest  $request
     * @param  \App\Models\PhysicalExamUnit  $physicalExamUnit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhysicalExamUnitRequest $request, PhysicalExamUnit $physicalExamUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhysicalExamUnit  $physicalExamUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhysicalExamUnit $physicalExamUnit)
    {
        //
    }
}
