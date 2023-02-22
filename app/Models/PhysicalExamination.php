<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExamination extends Model
{
    use HasFactory;
    protected $with = ['physical_exam_units'];
    function physical_exam_units(){
        return $this->hasMany(PhysicalExamUnit::class,'physical_exam_id');
    }
}
