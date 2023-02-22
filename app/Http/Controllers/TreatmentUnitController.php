<?php

namespace App\Http\Controllers;

use App\Http\Resources\TreatmentUnitResource;
use App\Models\CountingUnitProcedureItem;
use App\Models\Treatment;
use App\Models\TreatmentMachine;
use App\Models\TreatmentProcedureItem;
use App\Models\TreatmentUnit;
use App\Models\TreatmentUnitSale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTreatmentUnitRequest;
use App\Http\Requests\UpdateTreatmentUnitRequest;
use Illuminate\Support\Facades\Storage;

class TreatmentUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $treatment_units = TreatmentUnit::when(request('keyword'),fn($q)=>$q->where('name','like',"%".request('keyword')."%"))
//            ->latest('id')
//            ->paginate(20)
//            ->withQueryString()
//            ->onEachSide(1);
        $treatment_units = TreatmentUnit::when(request('keyword'),fn($q)=>$q->where('name','like',"%".request('keyword')."%"))->get();
        return TreatmentUnitResource::collection($treatment_units);
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
     * @param  \App\Http\Requests\StoreTreatmentUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreatmentUnitRequest $request)
    {
        sleep(2);
        $treatment = Treatment::find($request->treatment_id);
        $treatment_unit = new TreatmentUnit();
        $treatment_unit->code = $request->code;
        $treatment_unit->name = $treatment->name.' '.$request->name;
        $treatment_unit->treatment_id = $request->treatment_id;
        $treatment_unit->description = $request->description;
        $treatment_unit->est_cost = $request->est_cost;
        $treatment_unit->selling_price = $request->selling_price;
        $treatment_unit->description = $request->description;
        if ($request->photo){
            $newName='photo_'.uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs('public/photo',$newName);
            $treatment_unit->photo = $newName;
        }
        $treatment_unit->tag = $treatment->body_part;
        $treatment_unit->save();

        if ($request->medicine_id){
            $medicine_id = $request->medicine_id;
            $medicine_name = $request->medicine_name;
            $medicine_qty = $request->medicine_qty;
            $medicine_selling_price = $request->medicine_selling_price;
            $medicine_total_price = $request->medicine_total_price;
            $a=$b=$c=$d=$e=0;
            foreach ($medicine_id as $item) {
                $medicine = new TreatmentProcedureItem();
                $medicine->treatment_unit_id = $treatment_unit->id;
                $medicine->medicine_id = $medicine_id[$a++];
                $medicine->medicine_name = $medicine_name[$b++];
                $medicine->qty = $medicine_qty[$c++];
                $medicine->selling_price = $medicine_selling_price[$d++];
                $medicine->total_price = $medicine_total_price[$e++];
                $medicine->save();
            }

        }
        if ($request->machine_id){
            $machine_id = $request->machine_id;
            $machine_name = $request->machine_name;
            $machine_qty = $request->machine_qty;
            $machine_selling_price = $request->machine_selling_price;
            $machine_total_price = $request->machine_total_price;
            $aa=$bb=$cc=$dd=$ee=0;
            foreach ($machine_id as $item) {
                $machine = new TreatmentMachine();
                $machine->treatment_unit_id = $treatment_unit->id;
                $machine->machine_id = $machine_id[$aa++];
                $machine->machine_name = $machine_name[$bb++];
                $machine->qty = $machine_qty[$cc++];
                $machine->selling_price = $machine_selling_price[$dd++];
                $machine->total_price = $machine_total_price[$ee++];
                $machine->save();
            }

        }

        return response()->json([
            "data" => 'Success',
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TreatmentUnit  $treatmentUnit
     * @return \Illuminate\Http\Response
     */
    public function show(TreatmentUnit $treatmentUnit)
    {
        return new TreatmentUnitResource($treatmentUnit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TreatmentUnit  $treatmentUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(TreatmentUnit $treatmentUnit)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTreatmentUnitRequest  $request
     * @param  \App\Models\TreatmentUnit  $treatmentUnit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTreatmentUnitRequest $request, TreatmentUnit $treatmentUnit)
    {
        sleep(2);
        $treatment = Treatment::find($treatmentUnit->treatment_id);
        $treatmentUnit->code = $request->code;
        $treatmentUnit->name = $request->name;
        $treatmentUnit->description = $request->description;
        $treatmentUnit->est_cost = $request->est_cost;
        $treatmentUnit->selling_price = $request->selling_price;
        $treatmentUnit->description = $request->description;
        if ($request->photo){
            $old_photo = $treatmentUnit->photo;
            Storage::delete('public/photo'.$old_photo);
            $newName='photo_'.uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs('public/photo',$newName);
            $treatmentUnit->photo = $newName;
        }
        $treatmentUnit->update();

        if ($request->medicine_id){
            $medicine_ids = $request->medicine_id;
            $medicine_name = $request->medicine_name;
            $medicine_qty = $request->medicine_qty;
            $medicine_selling_price = $request->medicine_selling_price;
            $medicine_total_price = $request->medicine_total_price;
            $a=$b=$c=$d=$e=0;
            foreach ($medicine_ids as $medicine_id) {
                $medicine = new TreatmentProcedureItem();
                $medicine->treatment_unit_id = $treatmentUnit->id;
                $medicine->medicine_id = $medicine_id;
                $medicine->medicine_name = $medicine_name[$b++];
                $medicine->qty = $medicine_qty[$c++];
                $medicine->selling_price = $medicine_selling_price[$d++];
                $medicine->total_price = $medicine_total_price[$e++];
                $medicine->save();
            }
        }
        if ($request->machine_id){
            $machine_id = $request->machine_id;
            $machine_name = $request->machine_name;
            $machine_qty = $request->machine_qty;
            $machine_selling_price = $request->machine_selling_price;
            $machine_total_price = $request->machine_total_price;
            $aa=$bb=$cc=$dd=$ee=0;
            foreach ($machine_id as $item) {
                TreatmentMachine::destroy($machine_id);
                $machine = new TreatmentMachine();
                $machine->treatment_unit_id = $treatmentUnit->id;
                $machine->machine_id = $machine_id[$aa++];
                $machine->machine_name = $machine_name[$bb++];
                $machine->qty = $machine_qty[$cc++];
                $machine->selling_price = $machine_selling_price[$dd++];
                $machine->total_price = $machine_total_price[$ee++];
                $machine->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreatmentUnit  $treatmentUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(TreatmentUnit $treatmentUnit)
    {
        //
        $treatmentUnit->delete();
        return response()->json(null);
    }

    public function search(Request $request){
        $search = $request->search;
        $treatmentUnit = TreatmentUnit::where('name', 'like', '%'.$search.'%')->orWhere('code','like','%'.$search.'%')->get();
        return response()->json(
            [
                'data'=>$treatmentUnit
            ]
        );
    }
}
