<?php

namespace App\Http\Resources;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class CountingUnitItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $item = Item::find($this->item_id);
        $brand = Brand::find($item->brand_id ?? 1);
        $subCategory = SubCategory::find($brand->sub_category_id ?? 1);

        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'name'=>$this->name,
            'item_id'=>$this->item_id,
            'current_qty'=>$this->current_qty,
            'reorder_qty'=>$this->reorder_qty,
            'selling_price'=>$this->selling_price,
            'purchase_price'=>$this->purchase_price,
            'to_unit'=>$this->to_unit,
            'from_unit'=>$this->from_unit,
            'subcategory_id'=>$subCategory->id ?? 111,
            'description'=>$this->description,
            'category_id' => $subCategory->category_id,
        ];
    }
}
