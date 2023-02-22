<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $with = ['customer_emr','procedures','credits'];

    function customer_emr(){
        return $this->hasOne(CustomerEmr::class);
    }
    function procedures(){
	return $this->hasMany(Procedure::class);
    }
    function credits(){
	return $this->hasMany(CustomerCredit::class);
    }

}
