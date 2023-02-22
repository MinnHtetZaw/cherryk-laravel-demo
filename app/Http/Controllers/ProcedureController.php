<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProcedureResource;
use App\Models\Appointment;
use App\Models\Auth;
use App\Models\CountingUnitItem;
use App\Models\CountingUnitProcedureItem;
use App\Models\Customer;
use App\Models\MesoFat;
use App\Models\Procedure;
use App\Models\ProcedureAcne;
use App\Models\ProcedureBlackSpot;
use App\Models\ProcedureFacialDesign;
use App\Models\ProcedureItem;
use App\Models\ProcedureMesoFat;
use App\Models\ProcedurePhysicalExam;
use App\Models\ProcedureSkinCare;
use App\Models\ProcedureSkinType;
use App\Models\Treatment;
use App\Models\TreatmentUnit;
use Carbon\Carbon;
use App\Models\ProcedureTreatment;
use App\Models\ProcedurePhoto;
use App\Models\MedicineProcedure;
use App\Http\Requests\StoreProcedureRequest;
use App\Http\Requests\UpdateProcedureRequest;
use http\Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isNull;

class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedures = Procedure::when(request('key_words'),fn($q)=>$q->
        where('procedure_voucher_number','like','%'.request('key_words').'%')->
        orWhere('customer_name','like','%'.request('key_words').'%')->
        orWhere('customer_phone','like','%'.request('key_words').'%'))->
        when(request('filter_date'),fn($q)=>$q->where('created_at',request('filter_date')))
        ->orderBy('created_at','DESC')->get();
        return ProcedureResource::collection($procedures);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProcedureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureRequest $request)
    {
        try {
            DB::beginTransaction();
            $procedure = new Procedure();
            $procedure->doctor_id = \auth()->user()->id;
            $procedure->customer_id = $request->customer_id;
            $procedure->drug_his = $request->drug_his;
            $procedure->medical_his = $request->medical_his;
            $procedure->allergy_his = $request->allergy_his;
            $procedure->treatment_his = $request->treatment_his;
            $procedure->complain = $request->complain;
            $procedure->diagnosis = $request->diagnosis;
            $procedure->prescription = $request->prescription;
            $procedure->follow_up_date = $request->follow_up_date;
            $procedure->other_physical_exam = $request->other_physical_exam;
            if (isset($request->consultation)){
                $procedure->consultation_charges = $request->consultation;
            }
            if (isset($request->service)){
                $procedure->service_charges = $request->service;
            }
            $procedure->save();
//Skin_care
            if (isset($request->skin_care_id)){
                $skin_care = $request->skin_care_id;
                $description = $request->skin_care_description;
                $zz = $xx = 0;
                foreach ($skin_care as $skin){
                    $procedure_skin = new ProcedureSkinCare();
                    $procedure_skin->procedure_id = $procedure->id;
                    $procedure_skin->skin_care_id = $skin_care[$zz++];
                    $procedure_skin->description = $description[$xx++];
                    $procedure_skin->save();
                }
            }
//Skin_type
            if(isset($request->skin_type_id)){
                $skin_type_id = $request->skin_type_id;
                $skin_type_description = $request->skin_type_description ?? '-';
                $j=$k=0;
                foreach ($skin_type_id as $skin_type){
                    $procedureSkinType = new ProcedureSkinType();
                    $procedureSkinType->procedure_id = $procedure->id;
                    $procedureSkinType->skin_type_id = $skin_type_id[$j++];
                    $procedureSkinType->description = $skin_type_description[$k++];
                    $procedureSkinType->save();
                }
            }
//Acne
            if(isset($request->acne_id)){
                $acne_id = $request->acne_id;
                $acne_description = $request->acne_description ?? '-';
                $jj=$kk=0;
                foreach ($acne_id as $acne){
                    $procedureAcne = new ProcedureAcne();
                    $procedureAcne->procedure_id = $procedure->id;
                    $procedureAcne->acne_id = $acne_id[$jj++];
                    $procedureAcne->description = $acne_description[$kk++];
                    $procedureAcne->save();
                }
            }
//Black_spot
            if(isset($request->black_spot_id)){
                $black_spot_id = $request->black_spot_id;
                $black_spot_description = $request->black_spot_description ?? '-';
                $jk=$mk=0;
                foreach ($black_spot_id as $black_spot){
                    $blackSpot = new ProcedureBlackSpot();
                    $blackSpot->procedure_id = $procedure->id;
                    $blackSpot->black_spot_id = $black_spot_id[$jk++];
                    $blackSpot->description = $black_spot_description[$mk++];
                    $blackSpot->save();
                }
            }
//Meso_fat
            if(isset($request->mesofat_id)){
                $meso_fat_id = $request->mesofat_id;
                $meso_fat_description = $request->meso_fat_description ?? '-';
                $ak=$sk=0;
                foreach ($meso_fat_id as $meso_fat){
                    $mesoFat = new ProcedureMesoFat();
                    $mesoFat->procedure_id = $procedure->id;
                    $mesoFat->mesofat_id = $meso_fat_id[$ak++];
                    $mesoFat->description = $meso_fat_description[$sk++];
                    $mesoFat->save();
                }
            }
//Facial_design
            if(isset($request->facial_design_id)){
                $facial_design_id = $request->facial_design_id;
                $facial_design_description = $request->facial_design_description ?? '-';
                $dk=$fk=0;
                foreach ($facial_design_id as $facial_design){
                    $facialDesign = new ProcedureFacialDesign();
                    $facialDesign->procedure_id = $procedure->id;
                    $facialDesign->facial_design_id = $facial_design_id[$dk++];
                    $facialDesign->description = $facial_design_description[$fk++];
                    $facialDesign->save();
                }
            }
//            Save Medicines
            if (isset($request->medicines)){
                foreach (json_decode($request->medicines) as $medicine){
                    $medicine_procedure = new MedicineProcedure();
                    $medicine_procedure->procedure_id = $procedure->id;
                    $medicine_procedure->item_id = $medicine->item_id;
                    $medicine_procedure->name = $medicine->name;
                    $medicine_procedure->qty = $medicine->qty;;
                    $medicine_procedure->dose = $medicine->dose;;
                    $medicine_procedure->total_price = $medicine->sub_total;
                    $medicine_procedure->sig = $medicine->sig.' '.$medicine->extra_sig;
                    $medicine_procedure->day = $medicine->day;
                    $medicine_procedure->selling_price = $medicine->selling_price;
                    $medicine_procedure->type = $medicine->type;
                    $medicine_procedure->save();
                }
            }
//Save Treatments
            if (isset($request->treatments)){
                foreach (json_decode($request->treatments) as $treatment){
                    $procedure_treatment = new ProcedureTreatment();
                    $procedure_treatment->procedure_id = $procedure->id;
                    $procedure_treatment->treatment_unit_id = $treatment->treatment_id;//treatment_unit_id
                    $procedure_treatment->name = $treatment->name;
                    $procedure_treatment->qty = $treatment->qty;
                    $procedure_treatment->price = $treatment->selling_price;
                    $procedure_treatment->total_price =  $treatment->sub_total;
                    $procedure_treatment->sig = $treatment->sig;
                    $procedure_treatment->save();
                }
            }
//photo
            if ($request->photo){
                $procedure_photo = new ProcedurePhoto();
                $image = str_replace('data:image/png;base64,', '', $request->photo);
                $image = str_replace(' ', '+', $image);
                $imageName = uniqid().'.'.'png';
                Storage::disk('public')->put($imageName, base64_decode($image));
                $procedure_photo->photo = $imageName;
                $procedure_photo->procedure_id = $procedure->id;
                $procedure_photo->save();
            }

            DB::commit();
            return response()->json([
                'data'=>'Success'
            ]);
        }catch (Exception $error){
            DB::rollBack();
            return response()->json([
                'data'=>$error
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function show(Procedure $procedure)
    {
//	$procedure->photos->each(function($photo){
//	$photo->photo = asset('storage/photo/'.$photo->photo);
//});
        return new ProcedureResource($procedure);
	return response()->json([
	'data'=>$procedure,
            ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProcedureRequest  $request
     * @param  \App\Models\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProcedureRequest $request, Procedure $procedure)
    {
        try {
            DB::beginTransaction();
            $procedure->drug_his = $request->drug_his;
            $procedure->medical_his = $request->medical_his;
            $procedure->allergy_his = $request->allergy_his;
            $procedure->treatment_his = $request->treatment_his;
            $procedure->complain = $request->complain;
            $procedure->diagnosis = $request->diagnosis;
            $procedure->prescription = $request->prescription;
            $procedure->follow_up_date = $request->follow_up_date;
            $procedure->other_physical_exam = $request->other_physical_exam;
            $procedure->consultation_charges = $request->consultation;
            $procedure->service_charges = $request->service;

            //Skin Care

            if (isset($request->skin_care)){
                $u_skin_cares = json_decode($request->skin_care);
                $skin_care_ids = array();
                $skin_cares = ProcedureSkinCare::where('procedure_id',$procedure->id)->get();
                foreach ($skin_cares as $skin_care){
                    array_push($skin_care_ids,$skin_care->id);
                }
                ProcedureSkinCare::destroy($skin_care_ids);
                foreach ($u_skin_cares as $u_skin_care){
                    $procedure_skin_care = new ProcedureSkinCare();
                    $procedure_skin_care->procedure_id = $procedure->id;
                    $procedure_skin_care->skin_care_id = $u_skin_care->skin_care_id;
                    $procedure_skin_care->description = $u_skin_care->description;
                    $procedure_skin_care->save();
                }
            }

            //Skin Type
            if (isset($request->skin_type)){
                $u_skin_types = json_decode($request->skin_type);
                $skin_type_ids = array();
                $skin_types = ProcedureSkinType::where('procedure_id',$procedure->id)->get();
                foreach ($skin_types as $skin_type){
                    array_push($skin_type_ids,$skin_type->id);
                }
                ProcedureSkinType::destroy($skin_type_ids);
                foreach ($u_skin_types as $u_skin_type){
                    $procedure_skin_type = new ProcedureSkinType();
                    $procedure_skin_type->procedure_id = $procedure->id;
                    $procedure_skin_type->skin_type_id = $u_skin_type->skin_type_id;
                    $procedure_skin_type->description = $u_skin_type->description;
                    $procedure_skin_type->save();
                }
            }

            //Acne
            if (isset($request->acne)){
                $u_acnes = json_decode($request->acne);
                $acne_ids = array();
                $acnes = ProcedureAcne::where('procedure_id',$procedure->id)->get();
                foreach ($acnes as $acne){
                    array_push($acne_ids,$acne->id);
                }
                ProcedureAcne::destroy($acne_ids);
                foreach ($u_acnes as $u_acne){
                    $procedure_acne = new ProcedureAcne();
                    $procedure_acne->procedure_id = $procedure->id;
                    $procedure_acne->acne_id = $u_acne->acne_id;
                    $procedure_acne->description = $u_acne->description;
                    $procedure_acne->save();
                }
            }
            //Black Spots
            if (isset($request->black_spot)){
                $u_black_spots = json_decode($request->black_spot);
                $black_spot_ids = array();
                $black_spots = ProcedureBlackSpot::where('procedure_id',$procedure->id)->get();
                foreach ($black_spots as $black_spot){
                    array_push($black_spot_ids,$black_spot->id);
                }
                ProcedureBlackSpot::destroy($black_spot_ids);
                foreach ($u_black_spots as $u_black_spot){
                    $procedure_black_spot = new ProcedureBlackSpot();
                    $procedure_black_spot->procedure_id = $procedure->id;
                    $procedure_black_spot->black_spot_id = $u_black_spot->black_spot_id;
                    $procedure_black_spot->description = $u_black_spot->description;
                    $procedure_black_spot->save();
                }
            }
            //Meso Fat
            if (isset($request->meso_fat)){
                $u_meso_fats = json_decode($request->meso_fat);
                $meso_fat_ids = array();
                $meso_fats = ProcedureMesoFat::where('procedure_id',$procedure->id)->get();
                foreach ($meso_fats as $meso_fat){
                    array_push($meso_fat_ids,$meso_fat->id);
                }
                ProcedureMesoFat::destroy($meso_fat_ids);
                foreach ($u_meso_fats as $u_meso_fat){
                    $procedure_meso_fat = new ProcedureMesoFat();
                    $procedure_meso_fat->procedure_id = $procedure->id;
                    $procedure_meso_fat->mesofat_id = $u_meso_fat->meso_fat_id;
                    $procedure_meso_fat->description = $u_meso_fat->description;
                    $procedure_meso_fat->save();
                }
            }
            //Facial Design
            if (isset($request->facial_design)){
                $u_facial_designs = json_decode($request->facial_design);
                $facial_design_ids = array();
                $facial_designs = ProcedureFacialDesign::where('procedure_id',$procedure->id)->get();
                foreach ($facial_designs as $facial_design){
                    array_push($facial_design_ids,$facial_design->id);
                }
                ProcedureFacialDesign::destroy($facial_design_ids);
                foreach ($u_facial_designs as $u_facial_design){
                    $procedure_facial_design = new ProcedureFacialDesign();
                    $procedure_facial_design->procedure_id = $procedure->id;
                    $procedure_facial_design->facial_design_id = $u_facial_design->facial_design_id;
                    $procedure_facial_design->description = $u_facial_design->description;
                    $procedure_facial_design->save();
                }
            }

            if (isset($request->medicines)){
                $u_medicines = json_decode($request->medicines);
                $medicine_ids = array();
                $medicines = MedicineProcedure::where('procedure_id',$procedure->id)->get();
                foreach ($medicines as $medicine) {
                    array_push($medicine_ids,$medicine->id);
                }
                MedicineProcedure::destroy($medicine_ids);
                foreach ($u_medicines as $u_medicine){
                    $procedure_medicine = new MedicineProcedure();
                    $procedure_medicine->procedure_id = $procedure->id;
                    $procedure_medicine->item_id = $u_medicine->item_id;
                    $procedure_medicine->name = $u_medicine->name;
                    $procedure_medicine->qty = $u_medicine->qty;;
                    $procedure_medicine->dose = $u_medicine->dose;;
                    $procedure_medicine->total_price = $u_medicine->total_price;
                    if (isset($u_medicine->extra_sig)){
                        $procedure_medicine->sig = $u_medicine->sig.' '.$u_medicine->extra_sig;
                    }else{
                        $procedure_medicine->sig = $u_medicine->sig;
                    }
                    $procedure_medicine->day = $u_medicine->day;
                    $procedure_medicine->selling_price = $u_medicine->selling_price;
                    $procedure_medicine->type = $u_medicine->type;
                    $procedure_medicine->save();
                }
            }
            if ($request->treatments){
                $treatment_ids = array();
                $u_treatments = json_decode($request->treatments);
                $treatments = ProcedureTreatment::where('procedure_id',$procedure->id)->get();
                foreach ($treatments as $treatment) {
                    array_push($treatment_ids,$treatment->id);
                }
                ProcedureTreatment::destroy($treatment_ids);
                foreach ($u_treatments as $u_treatment) {
                    $procedure_treatment = new ProcedureTreatment();
                    $procedure_treatment->procedure_id = $procedure->id;
                    $procedure_treatment->treatment_unit_id = $u_treatment->treatment_unit_id;//treatment_unit_id
                    $procedure_treatment->name = $u_treatment->name;
                    $procedure_treatment->qty = $u_treatment->qty;
                    $procedure_treatment->price = $u_treatment->selling_price;
                    $procedure_treatment->total_price =  $u_treatment->total_price;
                    $procedure_treatment->sig = $u_treatment->sig;
                    $procedure_treatment->save();
                }

                $v = '';
//                if ($u_treatments == []){
//                    ProcedureTreatment::destroy($treatment_ids);
//                }else{
//                    foreach ($u_treatments as $u_treatment) {
//                        if (in_array($u_treatment->id,$treatment_ids)){
//                            $p_t = ProcedureTreatment::find($u_treatment->id);
//                            $p_t->qty = $u_treatment->qty;
//                            $p_t->price = $u_treatment->selling_price;
//                            $p_t->total_price =  $u_treatment->total_price;
//                            $p_t->sig = $u_treatment->sig;
//                            $p_t->update();
//                        }else{
//                            $procedure_treatment = new ProcedureTreatment();
//                            $procedure_treatment->procedure_id = $procedure->id;
//                            $procedure_treatment->treatment_unit_id = $u_treatment->treatment_id;//treatment_unit_id
//                            $procedure_treatment->name = $u_treatment->name;
//                            $procedure_treatment->qty = $u_treatment->qty;
//                            $procedure_treatment->price = $u_treatment->selling_price;
//                            $procedure_treatment->total_price =  $u_treatment->total_price;
//                            $procedure_treatment->sig = $u_treatment->sig;
//                            $procedure_treatment->save();
//                        }
//                    }
//                }

            }
            $procedure->update();
            DB::commit();
            return response()->json([
                'data'=>$v,
            ]);
        }catch (Exception $exception){
            DB::rollBack();
            return response()->json([
                'data'=>$exception,
            ]);
        }




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Procedure  $procedure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procedure $procedure)
    {
        $procedure->delete();
        return response()->json([
            'data'=>'Success',
        ]);
    }
}
