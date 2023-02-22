<?php

namespace App\Http\Controllers;

use App\Events\CustomerRegister;
use App\Exports\CustomerExport;
use App\Http\Resources\CustomerResource;
use App\Listeners\SendNewCustomerNotification;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Appointment;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\CustomerEmr;
use App\Models\CustomerEmrDocument;
use App\Models\CustomerEmrHealthCondition;
use App\Models\Drug;
use App\Models\HealthCondition;
use App\Models\Item;
use App\Models\Medication;
use App\Models\Member;
use App\Models\Procedure;
use App\Models\Treatment;
use App\Models\TreatmentUnit;
use App\Models\User;
use App\Notifications\NewCustomerNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::
        when(\request('gender'),fn($q)=>$q->where('gender',\request('gender')))
            ->when(\request('status'),fn($q)=>$q
                ->where('status',\request('status')))->latest()
            ->get();
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $count = Customer::count();
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->age = $request->age;
        $customer->gender = $request->gender;
        $customer->date_of_birth = $request->date_of_birth;
        $customer->occupation = $request->occupation;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->customer_id = "CUS-".sprintf("%04s", $count + 1);
        if ($request->file('photo')){
            $newName='photo_'.uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs('public/photo',$newName);
            $customer->photo = $newName;
        }
        $customer->save();

        $cus_emr = new CustomerEmr();
        $cus_emr->customer_id = $customer->id;
        $cus_emr->save();

        if($request->appointment_id){
          $appointment = Appointment::find($request->appointment_id);
        $appointment->patient_status = 2;
        $appointment->old_customer_id = $customer->id;
        $appointment->save();
        }
        $users = User::where('role','0')->get();
        \Illuminate\Support\Facades\Notification::send($users, new NewCustomerNotification($customer));

        return response()->json([
          "data"=>$customer
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);

//	$customer->photo = asset('storage/photo/'.$customer->photo);
	$customer_list = null;
	$cus_id = $customer->id;
    $customer_id = $customer->customer_id;
    $name = $customer->name;
    $age = $customer->age;
    $gender = $customer->gender;
    $date_of_birth = $customer->date_of_birth;
    $occupation = $customer->occupation;
    $phone = $customer->phone;
    $email = $customer->email;
    $photo = asset('storage/photo/'.$customer->photo);
    $address = $customer->address;
    $visit_time = $customer->visit_time;
    $customer_status = $customer->status;
    $total_amount = $customer->total_amount;
    $customer_emr = $customer->customer_emr;
    $customer_emr_id = $customer->customer_emr->id;

    //Emr
    $customer_emr_obj = null;
    $cus_emr_id = $customer_emr->id;
    $cus_health_con = $customer_emr->health_condition;
    $cus_medications = $customer_emr->medications;
    $cus_drug_allergy = $customer_emr->drug_allergy;
    $cus_medical_history = $customer_emr->medical_history;
    $cus_cosmetic_dermatology = $customer_emr->cosmetic_dermatology;
    $cus_remark = $customer_emr->remark;
    $cus_emr_id = $customer_emr->id;
    //Emr Health
    $healths_array = array();
    $healths = $customer_emr->health_conditions;
    foreach ($healths as $health){
        $health_con = HealthCondition::find($health->health_condition_id);
        $health_name = $health_con->name;
        $health_id = $health_con->id;
        $healthObj = array('health_name'=>$health_name,'health_id'=>$health_id);
        array_push($healths_array,$healthObj);
    }
    ///============
        ///
    //Med
    $medication_array = array();
    $medications = $customer_emr->cus_medications;
    foreach ($medications as $med){
        $med_con = Medication::find($med->medication_id);
        $med_name = $med_con->name;
        $med_id = $med_con->id;
        $medObj = array('medication_name'=>$med_name,'medication_id'=>$med_id);
        array_push($medication_array,$medObj);
    }
    ///=============

//        Drug Allergy
        $drug_array = array();
        $drugs = $customer_emr->cus_drugs;
        foreach ($drugs as $drug){
            $drug_con = Drug::find($drug->drug_id);
            $drug_name = $drug_con->name;
            $drug_id = $drug_con->id;
            $drugObj = array('drug_name'=>$drug_name,'drug_id'=>$drug_id);
            array_push($drug_array,$drugObj);
        }
        //=====//

        //        Medical History Allergy
        $medical_history_array = array();
        $medical_historys = $customer_emr->cus_medical_historys;
        foreach ($medical_historys as $medical_history){
            $medical_history_con = Drug::find($medical_history->medical_history_id);
            $medical_history_name = $medical_history_con->name;
            $medical_history_id = $medical_history_con->id;
            $medical_historyObj = array('medical_history_name'=>$medical_history_name,'medical_history_id'=>$medical_history_id);
            array_push($medical_history_array,$medical_historyObj);
        }
        //=====//

        //        Document
        $document_array = array();
        $documents = $customer_emr->cus_documents;
        foreach ($documents as $document){
            $document_con = CustomerEmrDocument::find($document->id);
            $document_file = asset('storage/document/'.$document->file);
            $document_id = $document_con->id;
            $documentObj = array('document_file'=>$document_file,'document_id'=>$document_id);
            array_push($document_array,$documentObj);
        }
        //=====//
        $customer_emr_array = array(
        'id'=>$cus_emr_id,
        'health_condition'=>$cus_health_con,
        'medication_des'=>$cus_medications,
        'drug_allergy'=>$cus_drug_allergy,
        'medical_history'=>$cus_medical_history,
        'cosmetic_dermatology'=>$cus_cosmetic_dermatology,
        'remark'=>$cus_remark,
        'health_conditions'=>$healths_array,
        'medications'=>$medication_array,
        'drugs'=>$drug_array,
        'medical_historys'=>$medical_history_array,
        'documents'=>$document_array,
    );
        $customer_emr_obj = $customer_emr_array;
    ///==============



//    $emr = n();
//    $emr_id = $customer_emr->id;
//    $emr_obj = array('id'=>$emr_id);
//    array_push($emr,$emr_obj);


    //Procedures
        $procedures = $customer->procedures;
        $procedure_lists = array();
        foreach($procedures as $procedure){
            $treatment = Treatment::find($procedure->treatment_id);
            $treatment_unit = TreatmentUnit::find($procedure->treatment_unit_id);
            $customer = Customer::find($procedure->customer_id);
            $id = $procedure->id;
            $procedure_customer_id = $procedure->customer_id;
            $customer_name = $customer->name;
            $customer_id = $customer->customer_id;
            $skin = $procedure->skin;
            $skin_type = $procedure->skin_type;
            $diagnosis = $procedure->diagnosis;
            $procedure_status = $procedure->status;
            $treatment_id = $procedure->treatment_id;
            $treatment_name = $treatment->name;
            $treatment_unit_id = $procedure->treatment_unit_id;
            $treatment_unit_name = $treatment_unit->name;
            $unit_qty = $procedure->unit_qty;
            $percent = 100 / $procedure->unit_qty;

            $time_left = $procedure->time_left;
            $current_percent = 100 - ($percent * $time_left);
            $unit = $procedure->unit;
            $unit_selling_price = $procedure->unit_selling_price;
            $procedure_total_amount = $procedure->total_amount;
            $consultation_fee = $procedure->consultation_fee;

            $procedure_treatments = $procedure->procedure_treatments;
            $procedure_treatment_list = array();
            foreach ($procedure_treatments as $procedure_treatment){
                $procedure_treatment_id = $procedure_treatment->id;
                $customer_id = $procedure_treatment->customer_id;
                $customer = Customer::find($customer_id);
                $customer_name = $customer->name;
                $procedure_id = $procedure_treatment->procedure_id;
                $treatment_id = $procedure_treatment->treatment_id;
                $treatment= Treatment::find($treatment_id);
                $treatment_name = $treatment->name;
                $treatment_unit_id = $procedure_treatment->treatment_unit_id;
                $treatment_unit = TreatmentUnit::find($treatment_unit_id);
                $treatment_unit_name = $treatment_unit->name;
                $appointment_date = $procedure_treatment->appointment_date;
                $description = $procedure_treatment->description;
                $status = $procedure_treatment->status;
                $payment_type = $procedure_treatment->payment_type;
                $total_amount = $procedure_treatment->total_amount;
                $advance = $procedure_treatment->advance;
                $balance = $procedure_treatment->balance;
                $treatment_diagnosis = $procedure_treatment->treatment_diagnosis;
                $prescription = $procedure_treatment->prescription;
                $remark = $procedure_treatment->remark;
                $count = $procedure_treatment->count;
                $procedure_treatment_array = array('id'=>$procedure_treatment_id, 'customer_id'=>$customer_id,
                    'customer_name' => $customer_name  ,'procedure_id' => $procedure_id, 'treatment_id' => $treatment_id,
                    'treatment_name'=>$treatment_name,'treatment_unit_name'=>$treatment_unit_name,'appointment_date'=>$appointment_date,
                    'description'=>$description,'status'=>$status, 'payment_type'=>$payment_type,'total_amount'=>$total_amount,
                    'advance'=>$advance,'balance'=>$balance,'treatment_diagnosis'=>$treatment_diagnosis,'prescription'=>$prescription,
                    'remark'=>$remark,'count'=>$count);
                array_push($procedure_treatment_list, $procedure_treatment_array);
            }

            $combined = array('id'=>$id,'customer_name'=>$customer_name,'customer_id'=>$customer_id,'skin'=>$skin,'skin_type'=>$skin_type,
                'diagnosis'=>$diagnosis,'status'=>$procedure_status,'treatment_name'=>$treatment_name,'treatment_unit_name'=>$treatment_unit_name,
                'unit_qty'=>$unit_qty,'unit_selling_price'=>$unit_selling_price,'unit'=>$unit,'total_amount'=>$procedure_total_amount,'consultation_fee'=>$consultation_fee,
                'procedure_treatments'=>$procedure_treatment_list,'time_left'=>$time_left,'current_percent'=>$current_percent);
            array_push($procedure_lists, $combined);
        }
        //============//
	$customer_array = array(
	  'id'=>$cus_id,
	  'customer_id'=>$customer_id,
	  'name'=>$name,
	  'age'=>$age,
	  'gender'=>$gender,
	  'date_of_birth'=>$date_of_birth,
	  'occupation'=>$occupation,
	  'phone'=>$phone,
	  'email'=>$email,
	  'photo'=>$photo,
	  'address'=>$address,
	  'visit_time'=>$visit_time,
	  'status'=>$customer_status,
	  'total_amount'=>$total_amount,
//	  'customer_emr'=>$customer_emr,
	  'customer_emr_obj'=>$customer_emr_obj,
	  'procedures'=>$procedure_lists,
      'customer_emr_id'=>$customer_emr_id,
//       'health'=>$healths_array,
    );
//	array_push($customer_list,$customer_array);
    $customer_list = $customer_array;

        return response()->json([
            "data"=>$customer_list
            ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->name = $request->name;
        $customer->age = $request->age;
        $customer->gender = $request->gender;
        $customer->date_of_birth = $request->date_of_birth;
        $customer->occupation = $request->occupation;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        if ($request->file('photo')){
            $old_photo = $customer->photo;
            Storage::delete('public/photo'.$old_photo);
            $newName='photo_'.uniqid().".".$request->file('photo')->extension();
            $request->file('photo')->storeAs('public/photo',$newName);
            $customer->photo = $newName;
        }
        $customer->update();
        return response()->json([
            "status"=> $customer,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        sleep(3);
        $customer->delete();
        return response()->json([
            "status"=> "Success"
            ],200);
    }

    public function search(Request $request){
        $search = $request->search;
        $customers = Customer::where('name', 'like', '%'.$search.'%')
            ->orWhere('customer_id','like','%'.$search.'%')
            ->orWhere('age','like','%'.$search.'%')
            ->orWhere('gender','like','%'.$search.'%')
            ->orWhere('date_of_birth','like','%'.$search.'%')
            ->orWhere('address','like','%'.$search.'%')
            ->get();
        return CustomerResource::collection($customers);
    }

    public function export(Excel $excel,CustomerExport $export)
    {
//        return response()-> $excel->download($export, 'customer.xlsx');
        return Excel::download(new CustomerExport(), 'customer.xlsx');
    }

    public function  customerBirthday(){
        $current_month = Carbon::now()->format('m');
        $customer = Customer::whereMonth('date_of_birth',$current_month)->get(['id','name','date_of_birth']);
        return response()->json([
            'data'=>$customer,
        ]);
    }
}
