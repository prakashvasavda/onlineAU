<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\SubscriptionController;
use Illuminate\Http\Request;
use App\Payment;
use Session;

/*
    $return_url = 'http://localhost/onlineAU/public/api/payment/success';
    $cancel_url = 'http://localhost/onlineAU/public/api/payment/cancel';
    $notify_url = 'http://localhost/onlineAU/public/api/payment/notify';
*/


class PaymentController extends Controller{

    public function process_payment(Request $request){
        /*package details*/
        $input          = Session::has('frontUser') ? $request->all() : Session::get('guestUser');

        /*Merchant details*/
        $merchant_id    = 10031315;
        $merchant_key   = 'sbijrnrrkonrs';

        /*Buyer details*/
        $name_first     = Session::has('frontUser') ? Session::get('frontUser')->name  : Session::get('guestUser')->name;
        $name_last      = Session::has('frontUser') ? Session::get('frontUser')->name  : Session::get('guestUser')->name;
        $email_address  = Session::has('frontUser') ? Session::get('frontUser')->email : Session::get('guestUser')->email;
        $custom_int1    = Session::has('frontUser') ? Session::get('frontUser')->id    : Session::get('guestUser')->user_id;  //user_id

        /*add user subscription*/
        $subscription       = new SubscriptionController();
        $user_subscription  = $subscription->add_user_subscription($input, $custom_int1);

        /*Transaction details*/
        $amount         = Session::has('frontUser') ? $request->amount    : $guest['amount'];
        $item_name      = Session::has('frontUser') ? $request->item_name : $guest['item_name'];
        $m_payment_id   = rand();
        
        /*Merchant detail urls*/
        $return_url     = 'https://onlineaupairs.co.za/public/api/payment/success';
        $cancel_url     = 'https://onlineaupairs.co.za/public/api/payment/cancel';
        $notify_url     = 'https://onlineaupairs.co.za/public/api/payment/notify';

        $testingMode = true;
        $payfast_url = $testingMode ? 'https://sandbox.payfast.co.za/eng/process' : 'https://www.payfast.co.za/eng/process';

        $data = array(
            'merchant_id'   => $merchant_id,
            'merchant_key'  => $merchant_key,
            'amount'        => $amount,
            'item_name'     => $item_name,
            'return_url'    => $return_url,
            'cancel_url'    => $cancel_url,
            'notify_url'    => $notify_url,
            'name_first'    => $name_first,
            'name_last'     => $name_last,
            'email_address' => $email_address,
            'm_payment_id'  => $m_payment_id,
            'custom_int1'   => $custom_int1,   //user_id
            'custom_int2'   => 1,             //user_sunscription_id
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $payfast_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }

    public function payment_success(Request $request){
        $payment = Payment::latest()->first();
        $payment->update(['status' => 1]);

        /*unset guest user session*/
        if(Sesson::has('guestUser')){
            Session::forget('guestUser');
        }

        return redirect()->route('transactions');
    }

    public function payment_cancel(Request $request){
       return redirect()->back()->with('error', 'Payment canceled, please try again.');
    }

    public function payment_notify(Request $request){
        header( 'HTTP/1.0 200 OK' );
        flush();

        $data                           = $request->all();
        $data['user_id']                = $request->custom_int1;
        $data['user_subscription_id']   = $request->custom_int2;
        $status                         = Payment::create($data);

        \Log::info(print_r($request->all(), true));
    }
}
