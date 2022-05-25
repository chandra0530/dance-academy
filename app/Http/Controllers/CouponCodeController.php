<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CouponCode;
use App\Models\CouponCodeStudents;

use App\Models\User;

class CouponCodeController extends Controller
{
   // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon_codes=CouponCode::paginate();
        return view('coupon_code.index',compact('coupon_codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::get();
        return view('coupon_code.add',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newcoupon=new CouponCode();
        $newcoupon->coupon_code=$request->name;
        $newcoupon->type=$request->type;
        $newcoupon->amount=$request->amount;
        $newcoupon->save();
        foreach ($request->select_student as $key => $value) {
            $newcodelink= new CouponCodeStudents();
            $newcodelink->user_id=$value;
            $newcodelink->coupon_code_id=$newcoupon->id;
            $newcodelink->save();

        }

        return redirect()->back()->with(['success' => 'New Couponcode added successfully.']);

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
        $location_details=Location::find($id);
        return view('location.edit',compact('location_details'));
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
        $newlocation=Location::find($id);
        $newlocation->location_name=$request->name;
        $newlocation->save();
        return redirect()->back()->with(['success' => 'Location details updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $batches=[];
        $batcheslist=Batch::where('location_id',$id)->delete();
        // foreach ($batcheslist as $key => $batch) {
        //     array_push($batches,$batch->id);
        // }
        // $batcheslist=Batch::whereIn('id',$batches)->delete();
        
        Location::findOrFail($id)->delete();
        

        return redirect()->back()->with(['success' => 'Location deleted successfully.']);
    }
    public function getBatches($id){
        $batcheslist=Batch::where('location_id',$id)->get();
        return json_encode(['code'=>200,'responce'=>$batcheslist]);
    }
}
