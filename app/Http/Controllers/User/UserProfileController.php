<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\User;
use App\Models\Location;
use App\Models\state;
use App\Models\StudentBatch;
use Auth;
class UserProfileController extends Controller
{
    //

    public function show()
    {
        $userdetails=User::find(Auth::guard('web')->user()->id);
        $userbatchdetails=StudentBatch::with(['batch','batch.location'])->where('student_id',Auth::guard('web')->user()->id)->get();
        return view('student.sview',compact('userdetails','userbatchdetails'));
        return $userdetails;
    }

    public function edit()
    {
        $batchlist=Batch::with('location')->get();
        
        $userdetails=User::find(Auth::guard('web')->user()->id);
        $selected_batch=Batch::with('location')->find($userdetails->batch_id);
        // return $selected_batch->location->id;
        $locationlist=Location::get();  
        $stateslist=state::get();  
        $minor=1;
       if( $userdetails->dob){

        $date1 = date('Y-m-d H:i:s');
        $date2 = $userdetails->dob;

        $diff = abs(strtotime($date2) - strtotime($date1));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        if($years>18){
            $minor=0;
        }else{
            $minor=1;
        }

       }else{
        $minor=1;

       }
        return view('student-edit',compact('selected_batch','batchlist','userdetails','locationlist','stateslist','minor'));
    }


    public function addBatch(){
        $locationlist=Location::get();

        return view('student.sadd-batch',compact('locationlist'));
    }

    public function addNewBatch(Request $request){
        $new_batch=new StudentBatch();
        $new_batch->student_id=$request->student_id;
        $new_batch->batch_id=$request->batch;
        $new_batch->save();
        return redirect()->back()->with(['success' => 'New batch added successfully.']);

    }


    

}
