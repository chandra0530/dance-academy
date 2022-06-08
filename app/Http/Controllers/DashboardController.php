<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function dashboard(){
        $allusers=User::where('is_delete',0)->get();
        $alluserscount=count($allusers);
        $first_day_this_month = date('01-m-Y'); // hard-coded '01' for first day
        $last_day_this_month  = date('t-m-Y');
        $month = date('m', strtotime(date('d-m-Y', time())));
        $thismonthusers = DB::table('users')
           ->whereMonth('created_at', $month)
           ->where('is_delete',0)
           ->count();
        $totalrevenue = DB::table('fees')->where('status','paid')->sum('fees');
        $amounttobecollected = DB::table('fees')->where('status','unpaid')->sum('fees');


        return view('home',compact('alluserscount','thismonthusers','totalrevenue','amounttobecollected'));
    }

    public function newStudents(){
        $month = date('m', strtotime(date('d-m-Y', time())));
        $studentslist = User::with('batch','batch.location')
        ->leftJoin('student_batches', function($join) {
            $join->on('student_batches.student_id', '=', 'users.id');
          })
        ->select('users.*')->where('users.is_delete',0)
           ->whereMonth('users.created_at', $month)
           ->where('users.is_delete',0)
           ->orderBY('users.name','ASC')->groupBy('users.id')->paginate(10)->withQueryString();
        //    return $thismonthusers;
        return view('student.new-students',compact('studentslist'));

    }

    public function deletedStudents(){
        $studentslist = User::with('batch','batch.location')
        ->leftJoin('student_batches', function($join) {
            $join->on('student_batches.student_id', '=', 'users.id');
          })
        ->select('users.*')
           ->where('users.is_delete',1)
           ->orderBY('users.name','ASC')->groupBy('users.id')->paginate(10)->withQueryString();
        //    return $thismonthusers;
        return view('student.delete-students',compact('studentslist'));

    }
}
