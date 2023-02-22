<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;
    protected $with = ['symptom_units'];
    function symptom_units(){
        return $this->hasMany(SymptomUnit::class);
    }
}
