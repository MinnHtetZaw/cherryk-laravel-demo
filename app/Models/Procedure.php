<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\MedicineProcedure;
use App\Models\ProcedureTreatment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Procedure extends Model
{
    use HasFactory;
    protected $with = ['skin_types','medicines','skin_cares','acnes','black_spots','meso_fats','facial_designs','procedure_photo'];

    function medicines(){
        return $this->hasMany(MedicineProcedure::class);
    }
    function treatments(){
        return $this->hasMany(ProcedureTreatment::class,);
    }
    function skin_cares(){
        return $this->hasMany(ProcedureSkinCare::class);
    }

    function skin_types(){
        return $this->hasMany(ProcedureSkinType::class);
    }
    function acnes(){
        return $this->hasMany(ProcedureAcne::class);
    }
    function black_spots(){
        return $this->hasMany(ProcedureBlackSpot::class);
    }
    function meso_fats(){
        return $this->hasMany(ProcedureMesoFat::class);
    }
    function facial_designs(){
        return $this->hasMany(ProcedureFacialDesign::class);
    }
    function procedure_photo(){
        return $this->hasMany(ProcedurePhoto::class);
    }


}
