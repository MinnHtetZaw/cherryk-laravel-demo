<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountingUnitProcedureItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'current_quantity',
        'reorder_quantity',
        'selling_price',
        'membership_price',
        'vip_price',
        'purchaase_price',
        'procedure_item_id',
        'selling_fixed_percent',
        'membership_fixed_percent',
        'vip_fixed_percent',
    ];
}
