<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcedureTreatmentRequest;
use App\Http\Requests\UpdateProcedureTreatmentRequest;
use App\Models\Customer;
use App\Models\Procedure;
use App\Models\ProcedureTreatment;
use App\Models\ProcedurePhoto;
use App\Models\MedicineProcedure;
use App\Models\ProcedureVoucher;
use App\Models\Transaction;
use App\Models\Treatment;
use App\Models\TreatmentUnit;
use Carbon\Carbon;

class ProcedureTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedureTreatments = ProcedureTreatment::all();
        $procedure_treatment_lists = array();

        foreach ($procedureTreatments as $procedureTreatment){
            $id = $procedureTreatment->id;
            $procedure = Procedure::find($procedureTreatment->procedure_id);
            $customer = Customer::find($procedureTreatment->customer_id);
            $treatment = Treatment::find($procedureTreatment->treatment_id);
            $treatment_unit = TreatmentUnit::find($procedureTreatment->treatment_unit_id);
            $customer_name = $customer->name;
            $customer_address = $customer->address;
            $treatment_name = $treatment->name;
            $treatment_unit_name = $treatment_unit->name;
            $description = $procedureTreatment->description;
            $status = $procedureTreatment->status;
            $payment_type = $procedureTreatment->payment_type;
            $total_amount = $procedureTreatment->total_amount;
            $procedure_total_amount = $procedure->total_amount;
            $advance = $procedureTreatment->advance;
            $balance = $procedureTreatment->balance;
            $appointment_date = $procedureTreatment->appointment_date;
            $treatment_diagnosis = $procedureTreatment->treatment_diagnosis;
            $prescription = $procedureTreatment->prescription;
            $remark = $procedureTreatment->remark;
            $count = $procedureTreatment->count;
            $skin = $procedure->skin;
            $skin_type = $procedure->skin_type;
            $diagnosis = $procedure->diagnosis;
            $total_amount = $procedure->total_amount;
            $procedure_status = $procedure->status;

            $medicine_obj = array();
            $medicines = $procedureTreatment->medicines;
            foreach ($medicines as $medicine) {
                $medicine_id = $medicine->id;
                $medicine_item_id = $medicine->item_id;
                $medicine_name = $medicine->name;
                $medicine_dose_unit = $medicine->dose_unit;
                $medicine_dose_qty = $medicine->dose_qty;
                $medicine_total_qty = $medicine->total_qty;
                $medicine_duration = $medicine->duration;
                $medicine_price = $medicine->price;
                $medicine_total_price = $medicine->total_price;
                $medicine_array = array('id'=>$medicine_id, 'item_id'=>$medicine_item_id, 'name'=>$medicine_name,'dose_unit'=>$medicine_dose_unit,
                    'dose_qty'=>$medicine_dose_qty, 'total_qty'=>$medicine_total_qty, 'duration'=>$medicine_duration, 'price'=>$medicine_price,
                    'total_price'=>$medicine_total_price);
                array_push($medicine_obj,$medicine_array);
            }

            $photo_obj = array();
            $photos = $procedureTreatment->photos;
            foreach ($photos as $photo) {
                $photo_id = $photo->id;
                $photo_name = asset('storage/photo/'.$photo->photo);
                $photo_array = array('id'=>$medicine_id, 'photo'=>$photo_name);
                array_push($photo_obj,$photo_array);
            }
            $procedure_treatment_array = array(
                'id'=>$id, 'customer_name'=>$customer_name, 'treatment_name'=>$treatment_name, 'treatment_unit'=>$treatment_unit_name,
                'description'=>$description, 'status'=>$status, 'payment_type'=>$payment_type, 'total_amount' => $total_amount,'procedure_total_amount'=>$procedure_total_amount,
                'advance'=>$advance, 'balance'=>$balance, 'appointment_date'=>$appointment_date, 'treatment_diagnosis' => $treatment_diagnosis,
                'prescription'=>$prescription,'remark'=>$remark,'count'=>$count,'skin'=>$skin, 'skin_type'=>$skin_type, 'diagnosis'=>$diagnosis,
                'procedure_status'=> $procedure_status, 'medicines'=>$medicine_obj,'photos' => $photo_obj,
            );
            array_push($procedure_treatment_lists,$procedure_treatment_array);

        }






//        $procedure_treatment_array = array(
//            'id'=>$id, 'customer_name'=>$customer_name, 'treatment_name'=>$treatment_name, 'treatment_unit'=>$treatment_unit_name,
//            'description'=>$description, 'status'=>$status, 'payment_type'=>$payment_type, 'total_amount' => $total_amount,
//            'advance'=>$advance, 'balance'=>$balance, 'appointment_date'=>$appointment_date, 'treatment_diagnosis' => $treatment_diagnosis,
//            'prescription'=>$prescription,'remark'=>$remark,'count'=>$count,'skin'=>$skin, 'skin_type'=>$skin_type, 'diagnosis'=>$diagnosis,
//            'total_amount'=>$total_amount,'procedure_status'=> $procedure_status, 'medicines'=>$medicine_obj,'photos' => $photo_obj,
//        );
//        $procedureTreatment->photos->each(function($photo){
//            $photo->photo = asset('storage/photo/'.$photo->photo);
//        });
        return response()->json([
		'data' => $procedure_treatment_lists,
	],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcedureTreatmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureTreatmentRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProcedureTreatment  $procedureTreatment
     * @return \Illuminate\Http\Response
     */
    public function show(ProcedureTreatment $procedureTreatment)
    {
        $procedure_treatment_lists = null;
        $id = $procedureTreatment->id;
        $procedure = Procedure::find($procedureTreatment->procedure_id);
        $procedure_id = $procedureTreatment->procedure_id;
        $customer = Customer::find($procedureTreatment->customer_id);
        $treatment = Treatment::find($procedureTreatment->treatment_id);
        $treatment_unit = TreatmentUnit::find($procedureTreatment->treatment_unit_id);
        $customer_name = $customer->name;
        $customer_address = $customer->address;
        $customer_id = $procedureTreatment->customer_id;
        $customer_phone = $customer->phone;
        $treatment_name = $treatment->name;
        $treatment_unit_name = $treatment_unit->name;
        $description = $procedureTreatment->description;
        $status = $procedureTreatment->status;
        $payment_type = $procedureTreatment->payment_type;
        $total_amount = $procedureTreatment->total_amount;
        $advance = $procedureTreatment->advance;
        $balance = $procedureTreatment->balance;
        $appointment_date = $procedureTreatment->appointment_date;
        $treatment_diagnosis = $procedureTreatment->treatment_diagnosis;
        $prescription = $procedureTreatment->prescription;
        $remark = $procedureTreatment->remark;
        $count = $procedureTreatment->count;
        $skin = $procedure->skin;
        $skin_type = $procedure->skin_type;
        $diagnosis = $procedure->diagnosis;
        $total_amount = $procedureTreatment->total_amount;
        $procedure_status = $procedure->status;
        $procedure_total_amount = $procedure->total_amount;
        $service_charges = $procedureTreatment->service_charges;
        $consultation_charges = $procedureTreatment->consultation_charges;

        $medicine_obj = array();
        $medicines = $procedureTreatment->medicines;
        foreach ($medicines as $medicine) {
            $medicine_id = $medicine->id;
            $medicine_item_id = $medicine->item_id;
            $medicine_name = $medicine->name;
            $medicine_dose_unit = $medicine->dose_unit;
            $medicine_dose_qty = $medicine->dose_qty;
            $medicine_total_qty = $medicine->total_qty;
            $medicine_duration = $medicine->duration;
            $medicine_price = $medicine->price;
            $medicine_total_price = $medicine->total_price;
            $medicine_array = array('id'=>$medicine_id, 'item_id'=>$medicine_item_id, 'name'=>$medicine_name,'dose_unit'=>$medicine_dose_unit,
                'dose_qty'=>$medicine_dose_qty, 'total_qty'=>$medicine_total_qty, 'duration'=>$medicine_duration, 'price'=>$medicine_price,
                'total_price'=>$medicine_total_price);
            array_push($medicine_obj,$medicine_array);
        }

        $photo_obj = array();
        $photos = $procedureTreatment->photos;
        foreach ($photos as $photo) {
            $photo_id = $photo->id;
            $photo_name = asset('storage/photo/'.$photo->photo);
            $photo_array = array('id'=>$medicine_id, 'photo'=>$photo_name);
            array_push($photo_obj,$photo_array);
        }
        $transaction_obj = array();
        $transactions = $procedureTreatment->transactions;
        foreach ($transactions as $transaction) {
            $transaction_id = $transaction->id;
            $payment_date = $transaction->payment_date;
            $bank_account = $transaction->id;
            $payment_type = $transaction->payment_type;
            $pay_amount = $transaction->pay_amount;
            $remark = $transaction->remark;
            $transaction_array = array('id'=>$transaction_id, 'payment_date'=>$payment_type, 'bank_account'=>$bank_account,
                'payment_type'=>$payment_date,'pay_amount'=>$pay_amount,'remark'=>$remark);
            array_push($transaction_obj,$transaction_array);
        }

        $procedure_treatment_array = array(
            'id'=>$id,'procedure_id'=>$procedure_id, 'customer_id'=>$customer_id, 'customer_name'=>$customer_name,'customer_phone'=>$customer_phone, 'treatment_name'=>$treatment_name, 'treatment_unit_name'=>$treatment_unit_name,
            'description'=>$description, 'status'=>$status, 'payment_type'=>$payment_type, 'total_amount' => $total_amount,'procedure_total_amount'=>$procedure_total_amount,
            'advance'=>$advance, 'balance'=>$balance, 'appointment_date'=>$appointment_date, 'treatment_diagnosis' => $treatment_diagnosis,
            'prescription'=>$prescription,'remark'=>$remark,'count'=>$count,'skin'=>$skin, 'skin_type'=>$skin_type, 'diagnosis'=>$diagnosis,
            'procedure_status'=> $procedure_status,'medicines'=>$medicine_obj,'photos' => $photo_obj,'consultation_charges'=>$consultation_charges,
            'service_charges' => $service_charges, 'transactions'=>$transaction_obj,
        );
        $procedure_treatment_lists = $procedure_treatment_array;
        $procedureTreatment->photos->each(function($photo){
        $photo->photo = asset('storage/photo/'.$photo->photo);
        });
            return response()->json([
        'data'=>$procedure_treatment_lists,
        ],200);

}
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureTreatmentRequest  $request
     * @param  \App\Models\ProcedureTreatment  $procedureTreatment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureTreatmentRequest $request, ProcedureTreatment $procedureTreatment)
    {
	if($request->file('photos')){
   	 foreach ($request->file('photos') as $photo) {
        $newName = 'photo_'.uniqid().".".$photo->extension();
        $photo->storeAs('public/photo',$newName);
        $procedure_photo = new ProcedurePhoto();
        $procedure_photo->photo = $newName;
        $procedure_photo->procedure_treatment_id = $procedureTreatment->id;
        $procedure_photo->save();
	}
	}

	if ($request->prescription){
	    $procedureTreatment->prescription = $request->prescription;
    }
if($request->file('after_photos')){
foreach ($request->file('after_photos') as $photo) {
    $newName = 'photo_'.uniqid().".".$photo->extension();
    $photo->storeAs('public/photo',$newName);
    $procedure_photo = new ProcedurePhoto();
    $procedure_photo->photo = $newName;
    $procedure_photo->status = 2;
    $procedure_photo->procedure_treatment_id = $procedureTreatment->id;
    $procedure_photo->save();
}
}
if($request->item_id){
 $dose_qty = $request->dose_qty;
    $total_qty = $request->quantity;
    $dose_unit = $request->dose_unit;
    $duration = $request->duration;
    $code = $request->code;
    $name = $request->name;
    $item = $request->item_id;
    $price = $request->price;
    $total_price = $request->total_price;
    $i = 0;$j = 0;$k = 0; $m = 0;$n = 0;$g = 0; $p = 0;$q=0;
    foreach($dose_qty as $do){
         $med = new MedicineProcedure();
         $med->procedure_treatment_id = $procedureTreatment->id;
         $med->item_id = $item[$i++];
         $med->name = $name[$m++];
         $med->dose_unit =  $dose_unit[$j++];
         $med->dose_qty =  $dose_qty[$k++];
         $med->total_qty = $total_qty[$n++];
         $med->duration = $duration[$g++];
         $med->price = $price[$p++];
         $med->total_price = $total_price[$q++];
         $med->save();
}
    $medicine = MedicineProcedure::where('procedure_treatment_id',$procedureTreatment->id)->pluck('total_price');
    $total = $medicine->reduce(function ($carry, $item) {
        return $carry + $item;
    });
        $procedureTreatment->total_amount = $total;
        $procedureTreatment->balance = $total;
        $procedure = Procedure::find($procedureTreatment->procedure_id);
//        $procedure->total_amount += $total;
//        $procedure->update();


}
 if ($request->status == 'finish'){
     $procedureTreatment->remark = $request->remark;
     $procedureTreatment->status = 'finish';
     $procedure = Procedure::find($procedureTreatment->procedure_id);
     $procedure->time_left -= 1;
     $procedure->update();

//     $procedureVou = new ProcedureVoucher();
//     $procedureVou->procedure_treatment_id = $procedureTreatment->id;
//     $procedureVou->treatment_unit_id = $procedureTreatment->id;
//     $procedureVou->customer_id = $procedureTreatment->customer_id;
//     $procedureVou->total_amount = $procedureTreatment->total_amount;
//     $procedureVou->pay_amount = $procedureTreatment->pay_amount;
//     $procedureVou->balance = $procedureTreatment->balance;
//     $procedureVou->remark = $procedureTreatment->remark;
//     $procedureVou->is_discount = $procedureTreatment->is_discount;
//     $procedureVou->discount_value = $procedureTreatment->discount_value;
//     $procedureVou->discount_type = $procedureTreatment->discount_type;
//     $procedureVou->is_promotion = $procedureTreatment->is_promotion;
//     $procedureVou->promotion_value = $procedureTreatment->promotion_value;
//     $procedureVou->voucher_date = $procedureTreatment->voucher_date;

 }
if ($request->description){
    $procedureTreatment->description = $request->description;
}

if ($request->treatment_diagnosis){
    $procedureTreatment->treatment_diagnosis = $request->treatment_diagnosis;
}

if ($request->appointment_date){
    $procedureTreatment->appointment_date = $request->appointment_date;
}

if ($request->consultation_charges){
    $procedureTreatment->consultation_charges = $request->consultation_charges;
}
if ($request->service_charges){
    $procedureTreatment->service_charges = $request->service_charges;
}
 $procedureTreatment->update();
 return response()->json([
	'data'=>$procedureTreatment,
    ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProcedureTreatment  $procedureTreatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcedureTreatment $procedureTreatment)
    {
        $procedureTreatment->delete();
        return response()->json([
            'data'=>'Success'
        ]);
    }
}
