<?php

namespace App\Http\Resources;

use App\Models\SkinCare;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureSkinCareResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $skin_care = SkinCare::find($this->skin_care_id);
        return [
            'id'=>$this->id,
            'skin_care_id'=>$this->skin_care_id,
            'name'=>$skin_care->name,
            'description'=>$this->description,
        ];
    }
}
