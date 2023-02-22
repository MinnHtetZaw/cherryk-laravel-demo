<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcedureVoucher extends Model
{
    use HasFactory;
    protected $with = ['items'];

    function items(){
        return $this->hasMany(ProcedureVoucherItem::class);
    }
}
