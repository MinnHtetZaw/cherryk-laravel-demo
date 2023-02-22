<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CountingUnitMachineryItem;

class MachineryItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'brand_id',
        'description',
        'per_unit_charge'
    ];
    protected $with = ['counting_unit_machinery_items'];
    function counting_unit_machinery_items(){
        return $this->hasMany(CountingUnitMachineryItem::class);
    }
    public function treatment_units()
    {
        return $this->belongsToMany('App\Models\TreatmentUnit')->withPivot('id','usage_amount','usage_cost');
    }
}
