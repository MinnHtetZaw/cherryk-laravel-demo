<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerEmr extends Model
{
    use HasFactory;

    protected $with = ['health_conditions','cus_medications', 'cus_drugs','cus_medical_historys','cus_documents'];
    function health_conditions(){
        return $this->hasMany(CustomerEmrHealthCondition::class);
    }
    function cus_medications(){
        return $this->hasMany(CustomerEmrMddication::class);
    }
    function cus_drugs(){
        return $this->hasMany(CustomerEmrDrugAllergy::class);
    }
    function cus_medical_historys(){
        return $this->hasMany(CustomerEmrMedicalHistory::class);
    }
    function cus_documents(){
        return $this->hasMany(CustomerEmrDocument::class);
    }


}
