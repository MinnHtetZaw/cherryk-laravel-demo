<?php

namespace App\Http\Resources;

use App\Models\Treatment;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentUnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $treatment = Treatment::find($this->treatment_id);
        if (is_null($this->photo)){
            $photo = null;
        }else{
            $photo= asset('storage/photo/'.$this->photo);
        }
        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'name'=>$this->name,
            'treatment_id'=> $this->treatment_id,
            'description'=>$this->description,
            'est_cost'=>$this->est_cost,
            'per_unit_qty'=>$this->per_unit_qty,
            'unit_type'=>$this->unit_type,
            'kit'=>$this->kit,
            'status'=>$this->status,
            'tag'=>$this->tag,
            'photo' => $photo,
            'selling_price'=>$this->selling_price,
            'treatment_name'=>$treatment->name,
            'treatment_body_part'=>$treatment->body_part,
            'medicines'=> TreatmentProcedureItemResource::collection($this->treatment_medicines),
            'machines'=> TreatmentMachineResource::collection($this->treatment_machines),
        ];
    }
}
