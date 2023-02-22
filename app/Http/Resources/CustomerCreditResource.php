<?php

namespace App\Http\Resources;

use App\Models\Customer;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerCreditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $customer = Customer::find($this->customer_id);
        return [
            'id'=>$this->id,
            'customer_name'=>$customer->name,
            'customer_phone'=>$customer->phone,
            'customer_address'=>$customer->address,
            'credit_amount'=>$this->credit_amount,
            'procedure_id'=>$this->procedure_id,

        ];
    }
}
