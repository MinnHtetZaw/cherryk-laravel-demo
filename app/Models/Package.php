<?php

namespace App\Models;

use App\Models\PackageTreatment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $with = ['medicines','treatments'];
    function medicines(){
        return $this->hasMany(PackageMedicine::class);
    }
    function treatments(){
        return $this->hasMany(PackageTreatment::class);
    }
}
