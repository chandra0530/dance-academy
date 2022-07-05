<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;
    public function user(){
        return $this->hasone(User::class,'id','student_id');
    }
    public function batch(){
        return $this->belongsTo(Batch::class,'batch_id','id');
    }
}
