<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentMachineResource extends JsonResource
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
            'id'=>$this->id,
            'item_id'=>$this->medicine_id,
            'machine_name'=>$this->machine_name,
            'machine_qty'=>$this->qty,
            'machine_selling_price'=>$this->selling_price,
            'machine_total_price'=>$this->total_price,
        ];
    }
}
