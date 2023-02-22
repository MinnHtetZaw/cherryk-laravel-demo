<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KitUnitResource extends JsonResource
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
            'name'=>$this->name,
            'code'=>$this->code,
            'current_qty'=>$this->current_qty,
            'reorder_qty'=>$this->reorder_qty,
            'selling_price'=>$this->selling_price,
            'purchase_price'=>$this->purchase_price,
            'per_unit_qty'=>$this->per_unit_qty,
            'from_unit'=>$this->from_unit,
            'to_unit'=>$this->to_unit,
            'description'=>$this->description,
        ];
    }
}
