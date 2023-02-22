<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'cost',
        'doctor_charges',
        'dressing_charges',
        'description',
    ];
}
