<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\state;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locationlist=Location::get();  
        $stateslist=state::get();  
        return view('student',compact('locationlist','stateslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locationlist=Location::get();  
        $stateslist=state::get();  
        return view('student',compact('locationlist','stateslist'));
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
        $newuser->parent_name=$request->pname;
        $newuser->dob=$request->dob;
        $newuser->phone=$request->phone;
        $newuser->state_id=$request->state;

        $newuser->city=$request->city;
        $newuser->zip_code=$request->zip;
        $newuser->hobbies=$request->hobby;
        // $newuser->batch_id=$request->is_medical_injury;
        $newuser->previous_medical_Details=$request->medical_details;
        // $newuser->batch_id=$request->location;
        $newuser->batch_id=$request->batch_id;
        $newuser->school_details=$request->school;
        $newuser->std_details=$request->std;
        $newuser->educational_qualification=$request->qualification;
        $newuser->institute=$request->institution;
        $newuser->training_details=$request->dance_training_details;


        $newuser->referance=$request->institute_referance;
        $newuser->is_reality_show=$request->is_reality_show;
        $newuser->reality_show_details=$request->reality_show_details;
        $newuser->is_intreast_new_show=$request->is_intreasted_for_reality_show;
        // $newuser->batch_id=$request->intreasted_for_reality_show;
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
        $newuser=User::find($id);

        $newuser->name=$request->name;
        $newuser->parent_name=$request->pname;
        $newuser->dob=$request->dob;
        $newuser->phone=$request->phone;
        $newuser->state_id=$request->state;

        $newuser->city=$request->city;
        $newuser->zip_code=$request->zip;
        $newuser->hobbies=$request->hobby;
        // $newuser->batch_id=$request->is_medical_injury;
        $newuser->previous_medical_Details=$request->medical_details;
        // $newuser->batch_id=$request->location;
        $newuser->batch_id=$request->batch_id;
        $newuser->school_details=$request->school;
        $newuser->std_details=$request->std;
        $newuser->educational_qualification=$request->qualification;
        $newuser->institute=$request->institution;
        $newuser->training_details=$request->dance_training_details;


        $newuser->referance=$request->institute_referance;
        $newuser->is_reality_show=$request->is_reality_show;
        $newuser->reality_show_details=$request->reality_show_details;
        $newuser->is_intreast_new_show=$request->is_intreasted_for_reality_show;
        // $newuser->batch_id=$request->intreasted_for_reality_show;
        $newuser->password=Hash::make('password', [
            'rounds' => 12,
        ]);
        $newuser->save();
        return redirect()->back()->with(['success' => 'New student registered successfully.']);
        
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

    public function register(Request $request){
        $newuser=new User();
        $newuser->name=$request->name;
        $newuser->parent_name=$request->pname;
        $newuser->dob=$request->dob;
        $newuser->phone=$request->phone;
        $newuser->state_id=$request->state;

        $newuser->city=$request->city;
        $newuser->zip_code=$request->zip;
        $newuser->hobbies=$request->hobby;
        // $newuser->batch_id=$request->is_medical_injury;
        $newuser->previous_medical_Details=$request->medical_details;
        // $newuser->batch_id=$request->location;
        $newuser->batch_id=$request->batch_id;
        $newuser->school_details=$request->school;
        $newuser->std_details=$request->std;
        $newuser->educational_qualification=$request->qualification;
        $newuser->institute=$request->institution;
        $newuser->training_details=$request->dance_training_details;


        $newuser->referance=$request->institute_referance;
        $newuser->is_reality_show=$request->is_reality_show;
        $newuser->reality_show_details=$request->reality_show_details;
        $newuser->is_intreast_new_show=$request->is_intreasted_for_reality_show;
        // $newuser->batch_id=$request->intreasted_for_reality_show;
        $newuser->password=Hash::make('password', [
            'rounds' => 12,
        ]);
        $newuser->save();
        return redirect()->back()->with(['success' => 'New student registered successfully.']);
       return $request->all();
    }
}
