<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicineProcedureResource extends JsonResource
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
            'item_id' => $this->item_id,
            'name' => $this->name,
            'qty' => $this->qty,
            'dose' => $this->dose,
            'total_price' => $this->total_price,
            'total_qty' => $this->qty * $this->day,
            'selling_price' => $this->selling_price,
            'day' => $this->day,
            'sig' => $this->sig,
            'type' => $this->type,
        ];
    }
}
