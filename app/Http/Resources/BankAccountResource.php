<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankAccountResource extends JsonResource
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
            'bank_name'=>$this->bank_name,
            'account_number'=>$this->account_number,
            'holder_name'=>$this->holder_name,
            'open_date'=>$this->open_date,
            'balance'=>$this->balance,
            'bank_address'=>$this->bank_address,
            'bank_contact'=>$this->bank_contact,
        ];
    }
}
