<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerEmrRequest;
use App\Http\Requests\UpdateCustomerEmrRequest;
use App\Models\CustomerEmr;
use App\Models\CustomerEmrCosmetic;
use App\Models\CustomerEmrDocument;
use App\Models\CustomerEmrDrugAllergy;
use App\Models\CustomerEmrHealthCondition;
use App\Models\CustomerEmrMddication;
use App\Models\CustomerEmrMedicalHistory;
use App\Models\CustomerEmrSymptom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CustomerEmrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_emrs = CustomerEmr::all();
        return response()->json([
            'data'=>$customer_emrs,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerEmrRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerEmrRequest $request)
    {
        $request->validate([
            'customer_id'=>'required',
        ]);
        $customer_emr = new CustomerEmr();
        $customer_emr->customer_id = $request->customer_id;
        $customer_emr->health_condition = $request->health_condition;
        $customer_emr->medications = $request->medications;
        $customer_emr->drug_allergy = $request->drug_allergy;
        $customer_emr->medical_history = $request->medical_history;
        $customer_emr->cosmetic_dermatology = $request->cosmetic_dermatology;
        $customer_emr->remark = $request->remark;
        $customer_emr->save();
//        $c =isset($request->health_condition_id);
        if (isset($request->health_condition_id) == true){
            $health_condition_id = $request->health_condition_id;
            foreach ($health_condition_id as $health_id){
                $customer_emr_health = new CustomerEmrHealthCondition();
                $customer_emr_health->customer_emr_id = $customer_emr->id;
                $customer_emr_health->health_condition_id = $health_id;
                $customer_emr_health->save();
            }
        }

        if (isset($request->medication_id) == true){
            $medication_id = $request->medication_id;
            foreach ($medication_id as $med){
                $medication = new CustomerEmrMddication();
                $medication->customer_emr_id = $customer_emr->id;
                $medication->medication_id = $med;
                $medication->save();
            }
        }

        if (isset($request->drug_id)== true){
            $drug_ids = $request->drug_id;
            foreach ($drug_ids as $drug_id){
                $drug_con = new CustomerEmrDrugAllergy();
                $drug_con->customer_emr_id = $customer_emr->id;
                $drug_con->drug_id = $drug_id;
                $drug_con->save();
            }
        }

        if (isset($request->symptom_unit_id) == true){
            $symptom_unit_id = $request->symptom_unit_id;
            $condition = $request->condition;
            $description = $request->description;
            $a=$b=$c=$d=0;
            foreach ($symptom_unit_id as $su){
                $symptom_unit = new CustomerEmrSymptom();
                $symptom_unit->customer_emr_id = $customer_emr->id;
                $symptom_unit->symptom_unit_id = $su[$a++];
                $symptom_unit->condition = $condition[$b++];
                $symptom_unit->description = $description[$c++];
                $symptom_unit->save();
            }
        }
        return response()->json([
            'data'=>$medication_id,
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerEmr  $customerEmr
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerEmr $customerEmr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerEmrRequest  $request
     * @param  \App\Models\CustomerEmr  $customerEmr
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerEmrRequest $request, CustomerEmr $customerEmr)
    {
        $request->validate([
            'customer_id'=>'required',
        ]);
        if (isset($request->health_condition_id) == true){
            $health_condition_id = $request->health_condition_id;
            foreach ($health_condition_id as $health_id){
                $customer_emr_health = new CustomerEmrHealthCondition();
                $customer_emr_health->customer_emr_id = $customerEmr->id;
                $customer_emr_health->health_condition_id = $health_id;
                $customer_emr_health->save();
            }
        }
        if (isset($request->medication_id) == true){
            $medication_id = $request->medication_id;
            foreach ($medication_id as $med){
                $medication = new CustomerEmrMddication();
                $medication->customer_emr_id = $customerEmr->id;
                $medication->medication_id = $med;
                $medication->save();
            }
        }

        if (isset($request->drug_id) == true){
            $drug_id = $request->drug_id;
            foreach ($drug_id as $d){
                $drug = new CustomerEmrDrugAllergy();
                $drug->customer_emr_id = $customerEmr->id;
                $drug->drug_id = $d;
                $drug->save();
            }
        }

        if (isset($request->medical_history_id) == true){
            $medical_history_id = $request->medical_history_id;
            foreach ($medical_history_id as $mh){
                $medical_history = new CustomerEmrMedicalHistory();
                $medical_history->customer_emr_id = $customerEmr->id;
                $medical_history->medical_history_id = $mh;
                $medical_history->save();
            }
        }

        if (isset($request->cosmetic_id) == true){
            $cosmetic_id = $request->cosmetic_id;
            foreach ($cosmetic_id as $c){
                $cosmetic = new CustomerEmrCosmetic();
                $cosmetic->customer_emr_id = $customerEmr->id;
                $cosmetic->cosmetic_id = $c;
                $cosmetic->save();
            }
        }

        if ($request->file('file')){

            $files = $request->file('file');

            foreach ($files as $file){
                $date = Carbon::now()->toDateString();
                $extension = $file->extension();
                $newName='file_'.uniqid().".".$extension;
                $file->storeAs('public/document',$newName);
                $document = new CustomerEmrDocument();
                $document->customer_emr_id = $customerEmr->id;
                $document->file = $newName;
                $document->type = $extension;
                $document->date = $date;
                $document->save();
            }
        }
        $customerEmr->customer_id = $request->customer_id;
        $customerEmr->health_condition = $request->health_condition;
        $customerEmr->medications = $request->medications;
        $customerEmr->drug_allergy = $request->drug_allergy;
        $customerEmr->medical_history = $request->medical_history;
        $customerEmr->cosmetic_dermatology = $request->cosmetic_dermatology;
        $customerEmr->remark = $request->remark;
        $customerEmr->update();
        return response()->json([
            'data'=>$customerEmr,
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerEmr  $customerEmr
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerEmr $customerEmr)
    {
        //
    }
}
