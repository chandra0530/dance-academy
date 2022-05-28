<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Batch;
use App\Models\Fees;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Location;
class FeesController extends Controller
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
        $query=Fees::leftJoin('users', 'users.id', '=', 'fees.student_id')
                ->leftJoin('student_batches', 'student_batches.student_id', '=', 'fees.student_id')
                ->leftJoin('batches', 'batches.id', '=', 'student_batches.batch_id');
        if($request->batch){
            $query->where('batches.id','=',$request->batch);
        }
        if($request->select_student){
            $query->where('users.id','=',$request->select_student);
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
        
        $users = DB::table('users')
            ->leftJoin('batches', 'batches.id', '=', 'users.batch_id')
            ->get();
        foreach ($users as $key => $value) {
           $fees=new Fees();
           $fees->student_id=$value->id;
           $fees->month=Carbon::now()->month;
           $fees->fees=$value->fees;
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
