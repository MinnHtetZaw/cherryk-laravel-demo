<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CountingUnitItem;

class Item extends Model
{
    use HasFactory;

    protected $with = ['item_units'];
    function item_units(){
        return $this->hasMany(CountingUnitItem::class);
    }
}
