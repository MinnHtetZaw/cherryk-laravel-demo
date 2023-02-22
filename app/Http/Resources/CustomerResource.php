<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)

    {
        $procedures = $this->procedures->sortByDesc('created_at');
        return [
        'id' => $this->id,
        'customer_id' => $this->customer_id,
        'name' => $this->name,
        'age' => $this->age,
        'gender' => $this->gender,
        'date_of_birth' => $this->date_of_birth,
        'occupation' => $this->occupation,
        'phone' => $this->phone,
        'email' => $this->email,
        'photo' => asset('storage/photo/'.$this->photo),
        'address' => $this->address,
        'visit_time' => $this->visit_time,
        'customer_status' => $this->status,
        'level' => $this->level,
        'total_amount' => $this->total_amount,
        'credit_amount' => $this->credit_amount,
        'procedures' => ProcedureResource::collection($procedures),
        'credits' => CustomerCreditResource::collection($this->credits),
        ];
    }
}
