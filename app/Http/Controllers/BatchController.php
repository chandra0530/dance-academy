<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Location;
use App\Models\User;
class BatchController extends Controller
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
    public function index()
    {
        $batch=Batch::with('location')->paginate();
        // return $batch;
        return view('Batch.index',compact('batch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $locationlist=Location::get();
        return view('Batch.add',compact('locationlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->all());
$batch=new Batch();
$batch->location_id=$request->location;
$batch->batch_name=$request->name;
$batch->batch_start_time=$request->start_time;
$batch->batch_end_time=$request->end_time;
$batch->fees=$request->fees;
$batch->days=implode(",",$request->day);
$batch->save();
return redirect()->back()->with(['success' => 'New Batch added successfully.']);

        
        
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
        $locationlist=Location::get();
        $batch_details=Batch::find($id);
        return view('Batch.edit',compact('batch_details','locationlist'));
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
        $batch=Batch::find($id);
        $batch->location_id=$request->location;
        $batch->batch_name=$request->name;
        $batch->batch_start_time=$request->start_time;
        $batch->batch_end_time=$request->end_time;
        $batch->fees=$request->fees;
        $batch->days=implode(",",$request->day);
        $batch->save();
        return redirect()->back()->with(['success' => 'Batch details updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::findOrFail($id)->delete();
        return redirect()->back()->with(['success' => 'Location deleted successfully.']);
    }

    public function getstudentslist($id){
        $userslist=User::leftJoin('student_batches', function($join) {
            $join->on('student_batches.student_id', '=', 'users.id');
          })->where('users.batch_id',$id)->orWhere('student_batches.batch_id','=',$id)->select('users.*')->orderBY('users.name','ASC')->get();
        return json_encode(['code'=>200,'responce'=>$userslist]);
    }
}
