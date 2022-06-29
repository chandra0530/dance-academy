<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Location;
class LocationController extends Controller
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
        $locationslist=Location::paginate();
        return view('location.index',compact('locationslist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('location.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newlocation=new Location();
        $newlocation->location_name=$request->name;
        $newlocation->save();
        return redirect()->back()->with(['success' => 'New location added successfully.']);

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


    public function getMultipleBatches($id){
        $batches=(explode(",",$id));
        $batcheslist=Batch::whereIN('location_id',$batches)->get();
        return json_encode(['code'=>200,'responce'=>$batcheslist]);
    }
}
