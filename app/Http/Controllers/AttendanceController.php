<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Attendance;
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
        $query=Attendance::with('location','batch','student');
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
       $Attendance=$query->paginate();
        // return $Attendance;
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
}
