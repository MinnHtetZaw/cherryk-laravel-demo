<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentUnitSale extends Model
{
    use HasFactory;
    protected $fillable = [
        'treatment_unit_id',
        'selling_price',
        'type',
        'type_option',
        'interval_type',
        'interval_value',
    ];
}
