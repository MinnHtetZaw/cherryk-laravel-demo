<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleVoucherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $payment_type = '';
        if ($this->payment_type == 0){
            $payment_type = 'Cash Down';
        }elseif($this->payment_type == 1){
            $payment_type = 'Partial Pay';
        }elseif ($this->payment_type == 2){
            $payment_type = 'Bank Transition';
        }
        return [
            'id'=>$this->id,
            'voucher_no'=>$this->voucher_no,
            'voucher_date'=>$this->voucher_date,
            'total_price'=>$this->total_price,
            'customer_name'=>$this->customer_name,
            'customer_phone'=>$this->customer_phone,
            'pay'=>$this->pay,
            'payment_type'=>$payment_type,
            'refund'=>$this->refund ?? 0,
            'balance'=>$this->balance ?? 0,
            'net_amount'=>$this->net_amount,
            'discount_value'=>$this->discount_value ?? 0,
        ];
    }
}
