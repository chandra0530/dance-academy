<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\User;
use App\Models\Location;
use App\Models\state;
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
    public function index()
    {
        $studentslist=User::with('batch','batch.location')->paginate();
        // return $studentslist;
        return view('student.index',compact('studentslist'));
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
}
