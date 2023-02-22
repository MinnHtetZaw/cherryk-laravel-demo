<?php

namespace App\Http\Resources;

use App\Models\Purchase;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierCreditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $purchase = Purchase::find($this->purchase_id);
        return [
            'id'=>$this->id,
            'purchase_amount' => $purchase->total_price,
            'purchase_id'=>$this->purchase_id,
            'supplier_id'=>$this->supplier_id,
            'credit_amount'=>$this->credit_amount,
            'status'=>$this->status,
        ];
    }
}
