<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemPurchaseResource extends JsonResource
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
            'purchase_id'=>$this->purchase_id,
            'item_id' => $this->item_id,
            'item_name' => $this->item_name,
            'purchase_price' => $this->purchase_price,
            'qty' => $this->qty,
            'sub_total' => $this->sub_total,
        ];
    }
}
