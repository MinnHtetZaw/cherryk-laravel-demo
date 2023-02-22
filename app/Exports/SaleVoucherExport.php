<?php

namespace App\Exports;

use App\Http\Resources\SaleVoucherResource;
use App\Models\SaleVoucher;
use Maatwebsite\Excel\Concerns\FromCollection;

class SaleVoucherExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SaleVoucherResource::collection(SaleVoucher::all());
    }
}
