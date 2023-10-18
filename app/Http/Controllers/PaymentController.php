<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use Session;


class PaymentController extends Controller{
    
    public function process_payment(Request $request){
        /*Merchant details*/
        $merchant_id    = env('PAYFAST_MERCHANT_ID');
        $merchant_key   = env('PAYFAST_MERCHANT_KEY');

        /*Buyer details*/
        $name_first     = $request->name_first;
        $name_last      = $request->name_last;
        $email_address  = $request->email_address;
        $custom_int1    = $request->custom_int1;

        /*Transaction details*/
        $amount         = $request->amount;
        $item_name      = $request->item_name;
        $m_payment_id   = rand();
        
        /*Local testing urls*/
        // $return_url     = 'http://localhost/onlineAU/public/api/payment/success';
        // $cancel_url     = 'http://localhost/onlineAU/public/api/payment/cancel';
        // $notify_url     = 'http://localhost/onlineAU/public/api/payment/notify';

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
            'custom_int1'   => $custom_int1,
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
        return redirect()->route('payment-details');
    }

    public function payment_details(){
        $data['menu']       = 'payment details';
        $data['payment']    = Payment::latest()->first();
        return view('user.payment_details', $data)->with('success', 'payment completed successfully.');
    }

    public function payment_cancel(Request $request){
        return "canceled";
    }

    public function payment_notify(Request $request){
        header( 'HTTP/1.0 200 OK' );
        flush();

        $data               = $request->all();
        $data['user_id']    = isset($request->custom_int1) ? $request->custom_int1 : null;
        $status             = Payment::create($data);

        \Log::info(print_r($request->all(), true));
    }
}
