<?php

namespace App\Exports;

use App\Http\Resources\CountingUnitProcedureItemResource;
use App\Models\CountingUnitProcedureItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProcedureItemsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CountingUnitProcedureItemResource::collection(CountingUnitProcedureItem::all());
    }

    public function headings():array{

        return [
            'id',
            'code',
            'name',
            'current_qty',
            'reorder_qty',
            'selling_price',
            'per_unit_price',
            'purchase_price',
            'to_unit',
            'from_unit',
            'per_unit_qty',
            'subcategory_id',
            'description',
            'procedure_item_id',
        ];

    }
}
