<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TreatmentUnitSale;

class TreatmentUnit extends Model
{
    use HasFactory;
    protected $with = ['treatment_medicines','treatment_machines'];

    function treatment_medicines(){
        return $this->hasMany(TreatmentProcedureItem::class);
    }

    function treatment_machines(){
        return $this->hasMany(TreatmentMachine::class);
    }
//    function treatment_unit_sales(){
//        return $this->hasMany(TreatmentUnitSale::class);
//    }

}
