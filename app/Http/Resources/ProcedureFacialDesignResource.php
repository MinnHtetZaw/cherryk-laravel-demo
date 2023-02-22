<?php

namespace App\Http\Resources;

use App\Models\FacialDesign;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureFacialDesignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $facial_design = FacialDesign::find($this->facial_design_id);
        return [
            'id'=>$this->id,
            'facial_design_id'=>$this->facial_design_id,
            'name'=>$facial_design->name,
            'description'=>$this->description,
        ];
    }
}
