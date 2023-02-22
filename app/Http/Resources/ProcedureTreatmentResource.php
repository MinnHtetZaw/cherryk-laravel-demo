<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureTreatmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'procedure_id' => $this->procedure_id,
            'treatment_unit_id' => $this->treatment_unit_id,
            'name' => $this->name,
            'qty' => $this->qty,
            'selling_price' => $this->price,
            'total_price' => $this->total_price,
            'day' => $this->day,
            'sig' => $this->sig,
        ];
    }
}
