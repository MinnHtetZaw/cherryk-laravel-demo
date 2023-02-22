<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $with = ['purchase_items'];
    function purchase_items(){
        return $this->hasMany(ItemPurchase::class);
    }
}
