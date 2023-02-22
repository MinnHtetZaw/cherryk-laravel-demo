<?php

namespace App\Exports;

use App\Http\Resources\CountingUnitItemResource;
use App\Models\CountingUnitItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MedicineItemsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CountingUnitItemResource::collection(CountingUnitItem::all());
    }

    public function headings():array{

        return [
            'id',
            'code',
            'name',
            'item_id',
            'current_qty',
            'reorder_qty',
            'selling_price',
            'purchase_price',
            'to_unit',
            'from_unit',
            'subcategory_id',
            'description',
            'category_id',
        ];

    }
}
