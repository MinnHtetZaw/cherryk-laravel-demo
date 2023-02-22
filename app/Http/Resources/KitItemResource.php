<?php

namespace App\Http\Resources;

use App\Models\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

class KitItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $brand = Brand::find($this->brand_id);
        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'name'=>$this->name,
            'brand'=>$brand->name,
            'brand_id'=>$this->brand_id,
            'description'=>$this->description,
            'units'=>KitUnitResource::collection($this->kit_units)
        ];
    }
}
