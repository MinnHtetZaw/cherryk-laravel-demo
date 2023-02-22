<?php

namespace App\Http\Resources;

use App\Models\Acne;
use Illuminate\Http\Resources\Json\JsonResource;

class ProcedureAcneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $acne = Acne::find($this->acne_id);
        return [
            'id'=>$this->id,
            'acne_id'=>$this->acne_id,
            'name'=>$acne->name,
            'description'=>$this->description,
        ];
    }
}
