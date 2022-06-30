<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Attendance;
use App\Models\Batch;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locationlist=Location::get();
        $selectedlocation='all';
        $query=Attendance::with('location','batch','student')
        ->leftJoin('users', function($join) {
            $join->on('users.id', '=', 'attendances.student_id');
          })->select('attendances.*');
        if($request->location !='all'){
            $query->where('location_id','=',$request->location);
        }
        if($request->batch !='all'&&$request->batch){
            $query->where('batch_id','=',$request->batch);
        }
        if($request->select_student !='all' && $request->select_student){
            $query->where('student_id','=',$request->select_student);
        }
        if($request->date){
            $query->where('date','=',$request->date);
        }else{
            // $query->where('date','=',now());
        }
        $query->where('users.is_delete',0);
       $Attendance=$query->paginate();
        return view('Attendance.index',compact('locationlist','selectedlocation','Attendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locationlist=Location::get();
        return view('Attendance.add',compact('locationlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $array = (array) $request->input('attendance');
        foreach ($array as $key => $value) {
            $attendance=new Attendance();
            $attendance->location_id=$request->location;
            $attendance->batch_id=$request->batch;
            $attendance->student_id=$key;
            $attendance->date=$request->date;
            $attendance->attendance=$value;
            $attendance->save();

        }
        return redirect()->back()->with(['success' => 'Attendance added successfully.']);
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
    public function edit(Attendance $id)
    {
        $allstudentsAttendance=Attendance::with(['student'])->where('batch_id',$id->batch_id)->where('date',$id->date)->get();
        return view('Attendance.edit',compact('allstudentsAttendance','id'));
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
    public function destroy(Attendance $id)
    {
        Attendance::where('batch_id',$id->batch_id)->where('date',$id->date)->delete();
        return redirect()->route('attendance.lista')->with(['success' => 'Attendance updated successfully.']);
    }

    public function registerView(Request $request){

        $locationlist=Location::get();
        $selectedlocation='all';

        $begin = new \DateTime( $request->date ); 
        $end = new \DateTime( $request->end_date );

$interval = new \DateInterval('P1D'); $daterange = new \DatePeriod($begin, $interval ,$end);

$attendanceregister=[];
$studentsarray=[];
$dateArray=[];
$studentsnames=[];

foreach($daterange as $date){ 
    $query=Attendance::with('location','batch','student')
    ->leftJoin('student_batches', function($join) {
        $join->on('attendances.batch_id', '=', 'student_batches.id');
      })->leftJoin('users', function($join) {
        $join->on('student_batches.student_id', '=', 'users.id');
        $join->where('users.is_delete','=',0) ;
      })->select('attendances.*','users.is_delete')->orderBy('users.name', 'ASC');
       
        if($request->batch !='all'&&$request->batch){
            $query->where('attendances.batch_id','=',$request->batch);
        }
        if($request->select_student !='all' && $request->select_student){
            $query->where('student_batches.student_id','=',$request->select_student);
        }
        $query->whereDate('attendances.date','=',$date->format("Y-m-d"));

        
        $Attendance=$query->get();
        // return $Attendance;
        foreach ($Attendance as $key => $value) {
            if(!in_array($value->student->id,$studentsarray)){
                array_push($studentsarray,$value->student->id);
            }
            if(!in_array($date->format("Y-m-d"),$dateArray)){
                array_push($dateArray,$date->format("Y-m-d"));
            }
            
            $studentsnames[$value->student->id]['name']=$value->student->name;
            $attendanceregister[$value->student->id][$date->format("Y-m-d")]['name']=$value->student->name;
            $attendanceregister[$value->student->id][$date->format("Y-m-d")]['attendance']=$value->attendance??'-';
        }
 }
//  return $attendanceregister;
        return view('Attendance.details',compact('locationlist','selectedlocation','daterange','studentsarray','attendanceregister','studentsnames'));
    }


    public function attendanceList(){
        $attendancelist=Attendance::query()->select('date as attendance_date','location_id','batch_id','id')->with('location','batch')->groupBy('batch_id','attendance_date')->orderBy('id', 'DESC')->paginate();
        return view('Attendance.list',compact('attendancelist'));
    }

    public function updateAttendance(Request $request){
        Attendance::where('batch_id',$request->batch)->where('date',$request->previous_date)->delete();
        $batch_details=Batch::find($request->batch);
        $array = (array) $request->input('attendance');
        foreach ($array as $key => $value) {
            $attendance=new Attendance();
            $attendance->location_id=$batch_details->location_id;
            $attendance->batch_id=$request->batch;
            $attendance->student_id=$key;
            $attendance->date=$request->date;
            $attendance->attendance=$value;
            $attendance->save();
        }
        return redirect()->route('attendance.lista')->with(['success' => 'Attendance updated successfully.']);

    }


}
