<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureVoucherItemResource extends JsonResource
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
            'item_unit_id'=>$this->item_unit_id,
            'name'=>$this->name,
            'qty'=>$this->qty,
            'selling_price'=>$this->selling_price,
            'total_price'=>$this->total_price,
            'discount_value'=>$this->discount_value,
            'discount_type'=>$this->discount_type,
        ];
    }
}
