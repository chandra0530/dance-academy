<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SmsTemplates;
use App\Models\Location;
use App\Models\User;
use App\Models\invoice;

use Illuminate\Support\Str;

class SmsController extends Controller
{
    //

    public function customMessage(){
        $smstemplates=SmsTemplates::all();
        $locationlist=Location::all();

        $selectedlocation='all';
        return view('sms.index',compact('smstemplates','selectedlocation','locationlist'));
    }
    public function smsTemplate($id){
        $smstemplate=SmsTemplates::find($id);

        return json_encode(['code'=>200,'responce'=>$smstemplate]);
    }

    public function publishMessage(Request $request){
        $smstemplate=SmsTemplates::find($request->input('sms_template'));
        $inputvalues=$request->input('input');
        $sms_template_message=$smstemplate->sms_template;
        $sms_variables=$smstemplate->variables;
        $array_variables = explode(',', $sms_variables);
        foreach ($array_variables as $key => $value) {
            $sms_template_message=Str::replace('##'.$value.'##', $inputvalues[$value], $sms_template_message);

        }
        $this->sendSms();
       return $sms_template_message;
        dd($request->input('input'));
    }


    private function sendSms(){

        $curl = curl_init();
        $message="Attendance:%2520Dear%2520Sir/Ma%2527am,%2520You%2520have%2520attended%252012%2520number%2520of%2520classes%2520in%2520the%2520month%2520of%2520march%25202022%2520.%2520Regards%2520Leaps%2520On%2520Beats";
        $phone="7609924157";
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=PSxUw2ow9kGieUgttJqKWw&senderid=LOBDNC&channel=2&DCS=0&flashsms=0&number=91'.$phone.'&text='.$message.'&route=31&EntityId=1301163974361249106&dlttemplateid=1307164326722855115',
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


    public function sendFeesReminder(){
        $allUsers=User::all();
        foreach ($allUsers as $key => $value) {
            $this->sendFeesReminderMessage($value['phone']);
        }
    }


    private function sendFeesReminderMessage($phone_number){
        $curl = curl_init();
        $phone=$phone_number;
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=PSxUw2ow9kGieUgttJqKWw&senderid=LOBDNC&channel=2&DCS=0&flashsms=0&number=91'.$phone.'&text=REMINDER%20Dear%20Sir/Ma\'am,%20You%20are%20requested%20to%20make%20the%20payment%20for%20the%20month%20of%20June%20on%20or%20before%2010th.%20Any%20payment%20after%2010th%20will%20lead%20to%20a%20fine%20of%20Rs.%20250%20.%20Regards%20Leaps%20On%20Beats%20(Rajashree%20Charitable%20Trust)&route=31&EntityId=1301163974361249106&dlttemplateid=1307164326438993620',
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



    public function sendFine(){
        $all_pending_invoices=invoice::where('status','unpaid')->get();
        foreach ($all_pending_invoices as $key => $value) {
            $user_Details=User::find($value['student_id']);
            $this->sendFineReminder($user_Details->phone);
        }
    }

    private function sendFineReminder($phone_number){

        $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=PSxUw2ow9kGieUgttJqKWw&senderid=LOBDNC&channel=2&DCS=0&flashsms=0&number=91'.$phone_number.'&text=Dear%20Sir/Ma\'am%20Your%20payment%20for%20the%20month%20of%20June%20has%20not%20been%20made%20yet.%20Kindly%20deposit%20it%20with%20a%20fine%20of%20Rs.250%20Regards%20Leaps%20On%20Beats%20(Rajashree%20Charitable%20trust)&route=31&EntityId=1301163974361249106&dlttemplateid=1307164322502778632',
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



}
