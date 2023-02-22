<?php

namespace App\Http\Resources;

use App\Models\CountingUnitItem;
use Illuminate\Http\Resources\Json\JsonResource;

class CountingUnitSaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $item = CountingUnitItem::find($this->item_id);
        $item_price = $item->purchase_price;

        return [
            'id' => $this->id,
            'item_id' => $this->item_id,
            'item_price' => $this->item_price,
            'item_purchase_price' => $item->purchase_price,

        ];
    }
}
