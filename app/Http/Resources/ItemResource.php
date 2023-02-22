<?php

namespace App\Http\Resources;

use App\Models\Brand;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $brand = Brand::find($this->brand_id ?? 1);
        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'name'=>$this->name,
            'brand'=>$brand->name ?? 'brand',
            'description'=>$this->description,
            'units'=>$this->units,
        ];
    }
}
