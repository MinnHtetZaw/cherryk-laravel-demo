<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureTreatmentMedicineRequest;
use App\Http\Requests\UpdateProcedureTreatmentMedicineRequest;
use App\Models\ProcedureTreatmentMedicine;

class ProcedureTreatmentMedicineController extends Controller
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
     * @param  \App\Http\Requests\StoreProcedureTreatmentMedicineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureTreatmentMedicineRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureTreatmentMedicine  $procedureTreatmentMedicine
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureTreatmentMedicine $procedureTreatmentMedicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureTreatmentMedicineRequest  $request
     * @param  \App\Models\ProcedureTreatmentMedicine  $procedureTreatmentMedicine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureTreatmentMedicineRequest $request, ProcedureTreatmentMedicine $procedureTreatmentMedicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureTreatmentMedicine  $procedureTreatmentMedicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureTreatmentMedicine $procedureTreatmentMedicine)
    {
        //
    }
}
