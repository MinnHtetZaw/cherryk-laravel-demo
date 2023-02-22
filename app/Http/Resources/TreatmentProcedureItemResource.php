<?php

namespace App\Http\Resources;

use App\Models\CountingUnitProcedureItem;
use Illuminate\Http\Resources\Json\JsonResource;

class TreatmentProcedureItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $medicine = CountingUnitProcedureItem::find($this->medicine_id);
        $per_unit_qty = $this->qty;
        $to_unit= $medicine->to_unit ?? 1234;
        $selling_price= $medicine->selling_price ?? 1234;
        $name = $medicine->name ?? "Null Val";

        if ($to_unit < 1){
            $per_unit_price = $selling_price / 1;
        }else{
            $per_unit_price = $selling_price / $to_unit ?? 1;
        }
        return [
            'id'=>$this->id,
            'item_id'=>$this->medicine_id,
            'medicine_name'=>$name,
            'medicine_qty'=>$per_unit_qty ,
            'medicine_selling_price'=>$per_unit_price,
            'medicine_total_price'=> $per_unit_qty * $per_unit_price,
        ];
    }
}
