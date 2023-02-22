<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'purchase_date'=>$this->purchase_date,
            'supplier_name'=>$this->supplier_name,
            'supplier_id'=>$this->supplier_id,
            'total_price'=>$this->total_price,
            'total_qty'=>$this->total_qty,
            'remark'=>$this->remark,
            'payment_type'=>$this->payment_type,
            'credit_amount'=>$this->credit_amount,
            'pay_amount'=>$this->pay_amount,
            'purchase_items'=>$this->purchase_items,
        ];
    }
}
