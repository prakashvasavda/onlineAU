<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller{
    
    public function process_payment(Request $request){
        $merchant_id    = env('PAYFAST_MERCHANT_ID');
        $merchant_key   = env('PAYFAST_MERCHANT_KEY');

        $amount         = $request->amount;
        $item_name      = $request->item_name;
        
        //$return_url     = 'http://localhost/onlineAU/public/payment/success';
        //$cancel_url     = 'http://localhost/onlineAU/public/payment/cancel';
        //$notify_url     = 'http://localhost/onlineAU/public/payment/notify';
        
        $return_url     = 'https://onlineaupairs.co.za/public/payment/success';
        $cancel_url     = 'https://onlineaupairs.co.za/public/payment/cancel';
        $notify_url     = 'https://onlineaupairs.co.za/public/payment/notify';
        $payfast_url    = 'https://sandbox.payfast.co.za/eng/process';

        $data = array(
            'merchant_id' => $merchant_id,
            'merchant_key' => $merchant_key,
            'amount' => $amount,
            'item_name' => $item_name,
            'return_url' => $return_url,
            'cancel_url' => $cancel_url,
            'notify_url' => $notify_url,
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
       header( 'HTTP/1.0 200 OK' );
        flush();

        define( 'SANDBOX_MODE', true );
        $pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
        // Posted variables from ITN
        $pfData = $_POST;

        // Strip any slashes in data
        foreach( $pfData as $key => $val ) {
            $pfData[$key] = stripslashes( $val );
        }

        // Convert posted variables to a string
        foreach( $pfData as $key => $val ) {
            if( $key !== 'signature' ) {
                $pfParamString .= $key .'='. urlencode( $val ) .'&';
            } else {
                break;
            }
        }

        $pfParamString = substr( $pfParamString, 0, -1 );
    }
    public function payment_cancel(Request $request){
        return "canceled";
    }

    public function payment_notify(Request $request){
       
        // Tell Payfast that this page is reachable by triggering a header 200
        header( 'HTTP/1.0 200 OK' );
        flush();

        define( 'SANDBOX_MODE', true );
        $pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
        // Posted variables from ITN
        $pfData = $_POST;

        // Strip any slashes in data
        foreach( $pfData as $key => $val ) {
            $pfData[$key] = stripslashes( $val );
        }

        // Convert posted variables to a string
        foreach( $pfData as $key => $val ) {
            if( $key !== 'signature' ) {
                $pfParamString .= $key .'='. urlencode( $val ) .'&';
            } else {
                break;
            }
        }

        $pfParamString = substr( $pfParamString, 0, -1 );

        session_start();
        $_SESSION["payment"] = $pfParamString;
    }

}
