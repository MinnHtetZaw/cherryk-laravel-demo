<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CountingUnitProcedureItem;

class ProcedureItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'brand_id',
        'description',
        'per_unit_charge'
    ];
    protected $with = ['counting_unit_procedure_items'];
   function counting_unit_procedure_items(){
    return $this->hasMany(CountingUnitProcedureItem::class,'procedure_item_id');
    }
}
