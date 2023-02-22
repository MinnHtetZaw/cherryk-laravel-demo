<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProcedurePhoto;
use App\Models\MedicineProcedure;
class ProcedureTreatment extends Model
{
    use HasFactory;
//    protected $with = ['photos','medicines','transactions'];
//    function photos(){
//	return $this->hasMany(ProcedurePhoto::class);
//	}
//
//     function medicines(){
//	 return $this->hasMany(MedicineProcedure::class);
//}
//    function transactions(){
//        return $this->hasMany(Transaction::class);
//    }
}
