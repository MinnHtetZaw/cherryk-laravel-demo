<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousEmr extends Model
{
    use HasFactory;
   protected $with = ['emr_symptoms','emr_healths'];
   function emr_symptoms(){
       return $this->hasMany(EmrSymptom::class,'emr_id');
   }
    function emr_healths(){
        return $this->hasMany(EmrHealth::class);
    }
}
