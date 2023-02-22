<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
            'question_id',
            'customer_id',
            'answer_value',
            'other_answer_value',
    ];
}
