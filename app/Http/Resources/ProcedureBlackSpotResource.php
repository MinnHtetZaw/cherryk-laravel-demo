<?php

namespace App\Http\Resources;

use App\Models\BlackSpot;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureBlackSpotResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $black_spot = BlackSpot::find($this->black_spot_id);
        return [
            'id'=>$this->id,
            'black_spot_id'=>$this->black_spot_id,
            'name'=>$black_spot->name,
            'description'=>$this->description,
        ];
    }
}
