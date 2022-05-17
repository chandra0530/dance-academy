<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\User;
use App\Models\Location;
use App\Models\state;
use App\Models\StudentBatch;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
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
        $selectedlocation='all';
        $selectedbatch='all';

        $locationlist=Location::get();
        $query=User::with('batch','batch.location')->leftJoin('batches', function($join) {
            $join->on('users.batch_id', '=', 'batches.id');
          })->select('users.*');

        if($request->location !='all'&&$request->location){
            $selectedlocation=$request->location;
            $query->where('batches.location_id','=',$request->location);
        }
        if($request->batch !='all'&&$request->batch){
            $selectedbatch=$request->batch;

            $query->where('batch_id','=',$request->batch);
        }
        $studentslist=$query->orderBY('name','ASC')->paginate(10)->withQueryString();
        $studentscount=$query->orderBY('name','ASC')->count();
        $batcheslist=[];
        if($request->location){
            $batcheslist= Batch::where('location_id',$request->location)->get();
        }

        // return $batcheslist;
        return view('student.index',compact('studentslist','selectedlocation','locationlist','studentscount','batcheslist','selectedbatch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $batchlist=Batch::with('location')->get();
        return view('student.add',compact('batchlist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newuser=new User();
        $newuser->name=$request->name;
        $newuser->email=$request->email;
        $newuser->phone=$request->phone;
        $newuser->gender=$request->gender;
        $newuser->batch_id=$request->batch_id;
        $newuser->password=Hash::make('password', [
            'rounds' => 12,
        ]);
        $newuser->save();
        return redirect()->back()->with(['success' => 'New student registered successfully.']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userdetails=User::find($id);

        return view('student.view',compact('userdetails'));
        return $userdetails;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $batchlist=Batch::with('location')->get();
        
        $userdetails=User::find($id);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userdetails=User::find($id);
        $userdetails->name=$request->name;
        $userdetails->email=$request->email;
        $userdetails->phone=$request->phone;
        $userdetails->gender=$request->gender;
        $userdetails->batch_id=$request->batch_id;
        $userdetails->password=Hash::make('password', [
            'rounds' => 12,
        ]);
        $userdetails->save();
        return redirect()->back()->with(['success' => 'User details updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with(['success' => 'User deleted successfully.']);
    }

    public function addBatch($id){
        $locationlist=Location::get();

        return view('student.add-batch',compact('locationlist','id'));
    }

    public function addNewBatch(Request $request){
        $new_batch=new StudentBatch();
        $new_batch->student_id=$request->student_id;
        $new_batch->batch_id=$request->batch;
        $new_batch->save();
        return redirect()->back()->with(['success' => 'New batch added successfully.']);

    }
}
