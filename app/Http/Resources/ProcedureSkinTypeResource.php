<?php

namespace App\Http\Resources;

use App\Models\SkinType;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureSkinTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $skin_type = SkinType::find($this->skin_type_id);
        return [
            'id'=>$this->id,
            'skin_type_id'=>$this->skin_type_id,
            'name'=>$skin_type->name,
            'description'=>$this->description,
        ];
    }
}
