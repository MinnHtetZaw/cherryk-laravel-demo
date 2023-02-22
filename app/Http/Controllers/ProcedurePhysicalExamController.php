<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedurePhysicalExamRequest;
use App\Http\Requests\UpdateProcedurePhysicalExamRequest;
use App\Models\ProcedurePhysicalExam;

class ProcedurePhysicalExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcedurePhysicalExamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedurePhysicalExamRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedurePhysicalExam  $procedurePhysicalExam
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedurePhysicalExam $procedurePhysicalExam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedurePhysicalExamRequest  $request
     * @param  \App\Models\ProcedurePhysicalExam  $procedurePhysicalExam
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedurePhysicalExamRequest $request, ProcedurePhysicalExam $procedurePhysicalExam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedurePhysicalExam  $procedurePhysicalExam
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedurePhysicalExam $procedurePhysicalExam)
    {
        //
    }
}
