<?php

namespace App\Exports;

use App\Http\Resources\ProcedureVoucherResource;
use App\Models\ProcedureVoucher;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProcedureVouchersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProcedureVoucherResource::collection(ProcedureVoucher::all());
    }
}
