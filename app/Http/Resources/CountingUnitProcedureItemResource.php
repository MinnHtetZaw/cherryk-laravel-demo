<?php

namespace App\Http\Resources;

use App\Models\Brand;
use App\Models\Item;
use App\Models\ProcedureItem;
use App\Models\SubCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class CountingUnitProcedureItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $procedureItem = ProcedureItem::find($this->procedure_item_id);
        $brand = Brand::find($procedureItem->brand_id ?? 1);
        $subCategory = SubCategory::find($brand->sub_category_id ?? 1);
        if ($this->to_unit < 1){
            $per_unit_price = $this->selling_price / 1;
        }else{
            $per_unit_price = $this->selling_price / $this->to_unit ?? 1;

        }

        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'name'=>$this->name,
            'current_qty'=>$this->current_qty,
            'reorder_qty'=>$this->reorder_qty,
            'selling_price'=>$this->selling_price,
            'per_unit_price'=>$per_unit_price,
            'purchase_price'=>$this->purchase_price,
            'to_unit'=>$this->to_unit,
            'from_unit'=>$this->from_unit,
            'per_unit_qty'=>$this->per_unit_qty,
            'subcategory_id'=>$subCategory->id ?? 111,
            'description'=>$this->description,
            'procedure_item_id'=>$this->procedure_item_id,
        ];
    }
}
