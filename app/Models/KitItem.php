<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitItem extends Model
{
    use HasFactory;
    protected $with = ['kit_units'];

    function kit_units(){
        return $this->hasMany(KitUnit::class);
    }

}
