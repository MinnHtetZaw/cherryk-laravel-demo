<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_name',
        'patient_status',
        'doctor_name',
        'date',
        'time',
        'phone',
        'treatment_id',
    ];
}
