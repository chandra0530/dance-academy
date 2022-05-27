<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBatch extends Model
{
    use HasFactory;

    public function batch(){
        return $this->hasone(Batch::class,'id','batch_id');
    }
}
