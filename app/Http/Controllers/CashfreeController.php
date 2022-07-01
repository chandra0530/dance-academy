<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Fees;
use App\Models\Transaction;
use App\Models\invoice;

use DateTime;

class CashfreeController extends Controller
{
    public function __construct() {
        $this->APP_ID = "132635bf9b1d10e056faf7ff54536231";
        $this->SECRET_KEY = "ef65937343b0078cd25128c769c8407d17e96409";

        $this->minimumAmount = 10;
        $this->maximumAmount = 5000;
    }

    function cashfree_payment_gateway (){
        return View('cashfree_payment_gateway');
    }

    function order (Request $request){
        $this->validate($request, [
            'customerName' => 'required',
            'customerPhone' => 'required',
            'customerEmail' => 'required|email',
            'amount' => 'required|numeric|between:'.$this->minimumAmount.','.$this->maximumAmount.'',
        ]);

        $customerName = $request->customerName;
        $customerPhone = $request->customerPhone;
        $customerEmail = $request->customerEmail;
        $amount = $request->amount;
        $order_id = $request->order_id;
        $now = new DateTime();
        $ctime = $now->format('Y-m-d H:i:s');

      
        $secretKey =  $this->SECRET_KEY;
        $postData = array(
            "appId" => $this->APP_ID,
            "orderId" => $order_id,
            "orderAmount" => $amount,
            "orderCurrency" => 'INR',
            "orderNote" => 'Wallet',
            "customerName" => $customerName,
            "customerPhone" => $customerPhone,
            "customerEmail" => $customerEmail,
            "returnUrl" => url('return-url'),
            "notifyUrl" => url('notify-url'),
            'secretKey' => $secretKey,
        );
        return view('cashfree_confirmation')->with($postData);
    }

    function return_url (Request $request){
        
        $orderId = $request->orderId;
        $orderAmount = $request->orderAmount;
        $referenceId = $request->referenceId;
        $txStatus = $request->txStatus;
        $paymentMode = $request->paymentMode;
        $txMsg = $request->txMsg;
        $txTime = $request->txTime;
        $signature = $request->signature;
        $secretkey = $this->SECRET_KEY;

        $transaction=new Transaction();
        $transaction->order_id=$request->orderId;
        $transaction->amount=$request->orderAmount;
        $transaction->payment_mode=$request->paymentMode;
        $transaction->referance_id=$request->referenceId;
        $transaction->signature=$request->signature;
        $transaction->transaction_message=$request->txMsg;
        $transaction->transaction_status=$request->txStatus;
        $transaction->transaction_time=$request->txTime;
        $transaction->save();



        $data = $orderId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
        $hash_hmac = hash_hmac('sha256', $data, $secretkey, true);
        $computedSignature = base64_encode($hash_hmac);
        if ($signature == $computedSignature) {
            if ($txStatus == 'SUCCESS'){
                // success query
                invoice::where('id', $orderId)->update(['status' => 'paid']);
                return redirect('login')->with('successMessage', $txTime);
            }else{
                // rejected query
                invoice::where('id', $orderId)->update(['status' => 'unpaid']);
                return redirect('login')->with('errorMessage', $txTime);
            }
        }else{
            return redirect('login')->with('errorMessage', 'Signature not match');
        }
    }
}
