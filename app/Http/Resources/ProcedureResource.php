<?php

namespace App\Http\Resources;

use App\Models\Customer;
use App\Models\ProcedureFacialDesign;
use App\Models\ProcedurePhysicalExam;
use App\Models\ProcedureTreatment;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Psy\Util\Str;

class ProcedureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $customer = Customer::find($this->customer_id);
        $doctor = User::find($this->doctor_id);
        if (is_null($customer->photo)){
            $photo = null;
        }else{
            $photo= asset('storage/photo/'.$customer->photo);
        }
        $diagnosis_excerpt = \Illuminate\Support\Str::words($this->diagnosis,10);
        return [
            'id' => $this->id,
            'doctor'=>$doctor->name ?? 'Unknown',
            'customer_id' => $this->customer_id,
            'customer_ID' => $customer->customer_id,
            'customer_name' => $customer->name,
            'customer_age' => $customer->age,
            'customer_phone' => $customer->phone,
            'customer_birth' => $customer->date_of_birth,
            'customer_gender' => ucfirst($customer->gender),
            'customer_address' => $customer->address,
            'customer_photo' => $photo,
            'consultation_charges' => $this->consultation_charges,
            'service_charges' => $this->service_charges,
            'status' => $this->status,
            'drug_his' => $this->drug_his,
            'medical_his' => $this->medical_his,
            'allergy_his' => $this->allergy_his,
            'treatment_his' => $this->treatment_his,
            'complain' => $this->complain,
            'diagnosis' => $this->diagnosis,
            'diagnosis_excerpt' => $diagnosis_excerpt,
            'prescription' => $this->prescription,
            'follow_up_date' => $this->follow_up_date,
            'other_physical_exam' => $this->other_physical_exam,
            'skin_cares' => ProcedureSkinCareResource::collection($this->skin_cares),
            'medicines' => MedicineProcedureResource::collection($this->medicines),
            'skin_types' => ProcedureSkinTypeResource::collection($this->skin_types),
            'acnes' => ProcedureAcneResource::collection($this->acnes),
            'black_spots' => ProcedureBlackSpotResource::collection($this->black_spots),
            'meso_fats' => ProcedureMesoFatResource::collection($this->meso_fats),
            'facial_designs' => ProcedureFacialDesignResource::collection($this->facial_designs),
            'treatments' => ProcedureTreatmentResource::collection($this->treatments),
            'date'=>$this->created_at->format('Y-m-d'),
//            'procedure_photo'=>asset('storage/photo/'.$this->procedure_photo),
            'procedure_photo'=> ProcedurePhotoResource::collection($this->procedure_photo),
            'time'=>$this->created_at->format('h:m a'),
        ];
    }
}
