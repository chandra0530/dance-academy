<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date','location_id','batch_id','student_id','attendance'
        
    ];
    protected $dates = ['date'];

  
  

    public function batch(){
        return $this->hasOne(Batch::class,'id','batch_id');
    }

    public function location(){
        return $this->hasOne(Location::class,'id','location_id');
    }

    public function student(){
        return $this->hasOne(User::class,'id','student_id');
    }

}
