<?php

namespace App\Http\Resources;

use App\Models\PhysicalExamination;
use App\Models\PhysicalExamUnit;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedurePhysicalExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $physical_exam_unit = PhysicalExamUnit::find($this->physical_exam_id);
        $physical_exam = PhysicalExamination::find($physical_exam_unit->physical_exam_id);
        return [
            'id'=>$this->id,
            'procedure_id'=>$this->procedure_id,
            'physical_exam_unit'=> $physical_exam_unit->unit,
            'physical_exam'=> $physical_exam->title,
            'description'=>$this->description,
        ];
    }
}
