<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $title = $this->patient_name;
        $doctor = User::find($this->doctor_name);
        $start = $this->date.'T'.$this->time;
        if (is_null($this->old_customer_id)){
            $old_customer_id = null;
        }else{
            $old_customer_id = $this->old_customer_id;
        }
        return [
            'id'=>$this->id,
            'patient_name'=>$this->patient_name,
            'doctor_name'=>$doctor->name,
            'doctor_id'=>$this->doctor_name,
            'date'=>$this->date,
            'phone'=>$this->phone,
            'time'=>$this->time,
            'patient_status'=>$this->patient_status,
            'old_customer_id'=>$old_customer_id,
            'start'=>$start,
            'title'=>$title,
            'description'=>$this->description,

        ];
    }
}
