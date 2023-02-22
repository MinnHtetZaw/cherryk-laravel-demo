<?php

namespace App\Http\Resources;

use App\Models\MesoFat;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureMesoFatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $mesofat = MesoFat::find($this->mesofat_id);
        return [
            'id'=>$this->id,
            'meso_fat_id'=>$this->mesofat_id,
            'name'=>$mesofat->name,
            'description'=>$this->description,
        ];
    }
}
