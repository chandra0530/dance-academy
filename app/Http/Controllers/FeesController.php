<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Batch;
use App\Models\Fees;
use App\Models\invoice;
use App\Models\StudentBatch;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Location;
use App\Models\Attendance;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=Fees::with(['user','batch'])->leftJoin('users', function($join) {
            $join->on('users.id', '=', 'fees.student_id');
          });
        $selectedlocation='all';
        $selected_batch='all';
        $selected_student='all';
        if($request->location){
            $selectedlocation=$request->location;
        }

        if($request->batch&&$request->batch!='all'){
            $query->where('fees.batch_id','=',$request->batch);
        }
        if($request->select_student&&$request->select_student!='all'){
            $query->where('fees.student_id','=',$request->select_student);
        }
        $query->where('users.is_delete','=',0);
        $fees=$query->latest()->paginate();
        $locationlist=Location::get();  
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
        
        $allstudents=User::where('is_delete',0)->pluck('id')->toArray();
        
        $student_batches = DB::table('student_batches')->whereIN('student_id',$allstudents)->get();
        foreach ($student_batches as $key => $value) {
            $batchDetails=Batch::find($value->batch_id);
            $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
            $last_day_this_month  = date('Y-m-t');

            $first_day_this_month = '2022-06-01';
            $last_day_this_month  = '2022-06-30';

            
            $total_number_of_classes=Attendance::whereBetween('date',[$first_day_this_month,$last_day_this_month])->where('batch_id',$value->batch_id)->count();
            $student_classes_attended=Attendance::whereBetween('date',[$first_day_this_month,$last_day_this_month])->where('batch_id',$value->batch_id)->where('student_id',$value->student_id)->where('attendance','present')->count();
            $user_fees=$batchDetails->fees;

            if(!in_array($value->batch_id,array(9,10,11))){
                if($student_classes_attended>($total_number_of_classes/2)){

                }else{
                    $user_fees=($user_fees/2);
                }
            }

            
            
           $fees=new Fees();
           $fees->student_id=$value->student_id;
           $fees->batch_id=$value->batch_id;
           $fees->month=Carbon::now()->month;
           $fees->month='06';
           $fees->year=Carbon::now()->year;
           $fees->fees=$user_fees;
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

    public function feesInvoiceWise(Request $request){

        
        $query=invoice::with(['user']);
        $selectedStudents=[];
        $selectedBatches=[];
        $selectedDate='';
        $selected_fees_status=0;
        if($request->selected_students){
            $selectedStudents=$request->selected_students;
           $query= $query->whereIN('student_id',$request->selected_students);
        }

        if($request->selected_batches){
            $selectedBatches=$request->selected_batches;
            $students=StudentBatch::whereIN('batch_id',$selectedBatches)->pluck('student_id')->toArray();
            
            $query->whereIN('student_id',$students);
        }

        if($request->invoice_status){
            $selected_fees_status=$request->invoice_status;
            if($request->invoice_status==1){
                $query= $query->where('status','paid');
            }
            if($request->invoice_status==2){
                $query= $query->where('status','unpaid');
            }
            
            
         }

         if($request->month){
            $selectedDate=$request->month;
            $year = date('Y', strtotime($request->month));
            $month = date('m', strtotime($request->month));
            $query->where('month',$month)->where('year',$year);
        }

        $fees=$query->orderBy('id','DESC')->paginate();
        $all_users=User::orderBy('name','ASC')->where('is_delete',0)->get();
        $batches=Batch::with(['location'])->get();
        // return $fees;
        return view('fees.invoice',compact('fees','all_users','selectedStudents','selected_fees_status','batches','selectedBatches','selectedDate'));
    }

    public function payInvoice(Request $request){
        $invoice_details=invoice::find($request->invoice_id);
         $user_Details= User::find($invoice_details->student_id);
        $fees=(explode(",",$invoice_details->fees_ids));;
        foreach ($fees as $key => $value) {
            $fee= Fees::find($value);
            $fee->status='paid';
            $fee->save();
        }

        $phone=$user_Details->phone;
        $monthName = \date("F", mktime(0, 0, 0, $invoice_details->month, 10));
        
        $invoice_details->status='paid';
        $invoice_details->save();

        $curl = curl_init();
        

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=PSxUw2ow9kGieUgttJqKWw&senderid=LOBDNC&channel=2&DCS=0&flashsms=0&number=91".$phone."&text=PAID:%20Your%20payment%20for%20the%20month%20of%20".$monthName."%20has%20successfully%20been%20completed.%20Regards%20Leaps%20On%20Beats&route=31&EntityId=1301163974361249106&dlttemplateid=1307164326505635540",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response;


        return  redirect()->back()->with(['success' => 'Invoice sent successfully.']);

    }


    private function invoicePaidChanges($phone_number,$month){
        $curl = curl_init();
        

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=PSxUw2ow9kGieUgttJqKWw&senderid=LOBDNC&channel=2&DCS=0&flashsms=0&number=91".$phone."&text=PAID:%20Your%20payment%20for%20the%20month%20of%20".$monthName."%20has%20successfully%20been%20completed.%20Regards%20Leaps%20On%20Beats&route=31&EntityId=1301163974361249106&dlttemplateid=1307164326505635540",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }


    public function monthlyfeesView(){
        return view('fees.fees-generate');
    }

    public function generateMonthlyFeesCustom(Request $request){

    $firstdate = date('Y-m-01', strtotime($request->date));
    $lastDate = date('Y-m-t', strtotime($request->date));
    $year = date('Y', strtotime($request->date));
    $month = date('m', strtotime($request->date));

    echo "first date".$firstdate."<br>";;
    echo "Last date".$lastDate."<br>";;

    echo "Year".$year."<br>";;

    echo "MOnth".$month."<br>";;


    Fees::where('month',$month)->where('year',$year)->delete();
    $allstudents=User::where('is_delete',0)->pluck('id')->toArray();
        
    $student_batches = DB::table('student_batches')->whereIN('student_id',$allstudents)->get();
    foreach ($student_batches as $key => $value) {
        $batchDetails=Batch::find($value->batch_id);
        // $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
        // $last_day_this_month  = date('Y-m-t');

        // $first_day_this_month = '2022-06-01';
        // $last_day_this_month  = '2022-06-30';

        $first_day_this_month=$firstdate;
        $last_day_this_month=$lastDate;

        
        $total_number_of_classes=Attendance::whereBetween('date',[$first_day_this_month,$last_day_this_month])->where('batch_id',$value->batch_id)->count();
        $student_classes_attended=Attendance::whereBetween('date',[$first_day_this_month,$last_day_this_month])->where('batch_id',$value->batch_id)->where('student_id',$value->student_id)->where('attendance','present')->count();
        $user_fees=$batchDetails->fees;

        if(!in_array($value->batch_id,array(9,10,11))){
            if($student_classes_attended>($total_number_of_classes/2)){

            }else{
                $user_fees=($user_fees/2);
            }
        }

        
        
       $fees=new Fees();
       $fees->student_id=$value->student_id;
       $fees->batch_id=$value->batch_id;
       $fees->month=$month;
       $fees->year=$year;
       $fees->fees=$user_fees;
       $fees->status='unpaid';
       $fees->save();

    }
    return  json_encode(['code'=>200,'responce'=>'Fees generates successfully. ']);

    }


    public function monthlyInvoiceView(){
        return view('fees.invoice-generate');
    }


    public function generateMonthlyInvoiceCustom(Request $request){

        $firstdate = date('Y-m-01', strtotime($request->date));
        $lastDate = date('Y-m-t', strtotime($request->date));
        $year = date('Y', strtotime($request->date));
        $month = date('m', strtotime($request->date));
    
        echo "first date".$firstdate."<br>";
        echo "Last date".$lastDate."<br>";
    
        echo "Year".$year."<br>";
    
        echo "MOnth".$month."<br>";
    
    
        invoice::where('month',$month+1)->where('year',$year)->delete();
        $allstudents=User::where('is_delete',0)->pluck('id')->toArray();
            
        $student_batches = DB::table('student_batches')->whereIN('student_id',$allstudents)->get();
        foreach ($student_batches as $key => $value) {
            $batchDetails=Batch::find($value->batch_id);

            $details = DB::select("select student_id,GROUP_CONCAT(batch_id,'') as batch_ids,GROUP_CONCAT(id,'') as fees_ids, sum(fees) as amount from fees where month='".$month."' AND status='unpaid'  AND student_id='".$value->student_id."'  group by student_id");
            if(isset($details->batch_ids)){
                $invoice=new invoice();
                $invoice->student_id=$value->student_id;
                $invoice->batch_id=$details->batch_ids;
                $invoice->month=$month+1;
                $invoice->year=$year;
                $invoice->fees_ids=$details->fees_ids;
                $invoice->status='unpaid';
                $invoice->amount=$details->amount;
                $invoice->save();
            }
            


            // $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
            // $last_day_this_month  = date('Y-m-t');
    
            // $first_day_this_month = '2022-06-01';
            // $last_day_this_month  = '2022-06-30';
    
        //     $first_day_this_month=$firstdate;
        //     $last_day_this_month=$lastDate;
    
            
        //     $total_number_of_classes=Attendance::whereBetween('date',[$first_day_this_month,$last_day_this_month])->where('batch_id',$value->batch_id)->count();
        //     $student_classes_attended=Attendance::whereBetween('date',[$first_day_this_month,$last_day_this_month])->where('batch_id',$value->batch_id)->where('student_id',$value->student_id)->where('attendance','present')->count();
        //     $user_fees=$batchDetails->fees;
    
        //     if(!in_array($value->batch_id,array(9,10,11))){
        //         if($student_classes_attended>($total_number_of_classes/2)){
    
        //         }else{
        //             $user_fees=($user_fees/2);
        //         }
        //     }
    
            
            
        //    $fees=new Fees();
        //    $fees->student_id=$value->student_id;
        //    $fees->batch_id=$value->batch_id;
        //    $fees->month=$month;
        //    $fees->year=$year;
        //    $fees->fees=$user_fees;
        //    $fees->status='unpaid';
        //    $fees->save();
    
        }
        return  json_encode(['code'=>200,'responce'=>'Invoices generated successfully. ']);
    
        }


}
