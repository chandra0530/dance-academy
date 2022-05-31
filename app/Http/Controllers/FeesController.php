<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Batch;
use App\Models\Fees;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Location;
use App\Models\Attendance;

class FeesController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=Fees::with(['user','batch']);
        if($request->batch){
            $query->where('batch_id','=',$request->batch);
        }
        if($request->select_student){
            $query->where('student_id','=',$request->select_student);
        }


        $fees=$query->paginate();
        $locationlist=Location::get();  
        $selectedlocation='all';
        return view('fees.index',compact('fees','locationlist','selectedlocation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function generateMonthlyFees(){
        
        $student_batches = DB::table('student_batches')->get();

        foreach ($student_batches as $key => $value) {
            $batchDetails=Batch::find($value->batch_id);
             $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
            $last_day_this_month  = date('Y-m-t');
            $total_number_of_classes=Attendance::whereBetween('date',[$first_day_this_month,$last_day_this_month])->where('batch_id',$value->batch_id)->count();
            $student_classes_attended=Attendance::whereBetween('date',[$first_day_this_month,$last_day_this_month])->where('batch_id',$value->batch_id)->where('student_id',$value->student_id)->where('attendance','present')->count();
            $user_fees=$batchDetails->fees;
            if($student_classes_attended>($total_number_of_classes/2)){

            }else{
                $user_fees=($user_fees/2);
            }
           $fees=new Fees();
           $fees->student_id=$value->student_id;
           $fees->batch_id=$value->batch_id;
           $fees->month=Carbon::now()->month;
           $fees->year=Carbon::now()->year;
           $fees->fees=$batchDetails->fees;
           $fees->status='unpaid';
           $fees->save();

        }
        return  json_encode(['code'=>200,'responce'=>'Fees generates successfully. ']);

    }
    public function updateFeesStatus($id)
    {
        $fees= Fees::find($id);
           $fees->status='paid';
           $fees->save();
           return  redirect()->back()->with(['success' => 'Fees added successfully.']);
    }
}
