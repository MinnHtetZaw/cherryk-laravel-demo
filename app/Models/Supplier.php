<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $with = ['supplier_credit'];

    function supplier_credit(){
        return $this->hasMany(SupplierCredit::class);
    }
}
