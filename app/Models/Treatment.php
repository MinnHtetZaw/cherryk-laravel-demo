<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\TreatmentUnit;

class Treatment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'name',
        'description',
    ];
    protected $with = ['treatment_units'];
    function treatment_units(){
        return $this->hasMany(TreatmentUnit::class);
    }
}
