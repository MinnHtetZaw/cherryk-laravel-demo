<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureVoucherResource extends JsonResource
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
            'customer_name'=>$this->customer_name,
            'customer_phone'=>$this->customer_phone,
            'total_amount'=>$this->total_amount,
            'pay_amount'=>$this->pay_amount,
            'balance'=>$this->balance,
            'voucher_date'=>$this->voucher_date,
            'procedure_voucher_number'=>$this->procedure_voucher_number,
            'discount_value'=>$this->discount_value,
            'items'=>ProcedureVoucherItemResource::collection($this->items),
        ];
    }
}
