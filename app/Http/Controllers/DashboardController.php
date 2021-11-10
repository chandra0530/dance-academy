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
        $allusers=User::get();
        $alluserscount=count($allusers);
        $first_day_this_month = date('m-01-Y'); // hard-coded '01' for first day
        $last_day_this_month  = date('m-t-Y');
        $thismonthusers = DB::table('users')
           ->whereBetween('created_at', [$first_day_this_month, $last_day_this_month])
           ->count();
        $totalrevenue = DB::table('fees')->where('status','paid')->sum('fees');
        $amounttobecollected = DB::table('fees')->where('status','unpaid')->sum('fees');


        return view('home',compact('alluserscount','thismonthusers','totalrevenue','amounttobecollected'));
    }
}
