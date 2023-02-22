<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcedurePhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (is_null($this->photo)){
            $photo = null;
        }else{
            $photo = $this->photo;
        }

        return [
            'id'=>$this->id,
            'procedure_id'=>$this->procedure_id,
            'photo'=>asset('storage/'.$this->photo),
        ];
    }
}
