<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller{
    
    public function process_payment(Request $request){
        $merchant_id = env('PAYFAST_MERCHANT_ID');
        $merchant_key = env('PAYFAST_MERCHANT_KEY');
        $amount = $request->amount;
        $item_name = 'Test Product';
        $return_url = 'http://localhost/payfast-demo/public/payment/success';
        $payfast_url = 'https://sandbox.payfast.co.za/eng/process';

        $data = array(
            'merchant_id' => $merchant_id,
            'merchant_key' => $merchant_key,
            'amount' => $amount,
            'item_name' => $item_name,
            'return_url' => $return_url,
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
        return "success";
    }
    public function payment_cancel(Request $request){
        return "canceled";
    }

}
