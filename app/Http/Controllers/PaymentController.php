<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\SubscriptionController;
use Illuminate\Http\Request;
use App\UserSubscription;
use Carbon\Carbon;
use App\FrontUser;
use App\Payment;
use Session;

class PaymentController extends Controller{

    public function process_payment(Request $request){
        /*Merchant details*/
        $merchant_id    = 10031315;
        $merchant_key   = 'sbijrnrrkonrs';

        /*Buyer details*/
        $name_first     = Session::has('frontUser') ? Session::get('frontUser')->name  : (Session::get('guestUser')['name'] ?? null);
        $name_last      = Session::has('frontUser') ? Session::get('frontUser')->name  : (Session::get('guestUser')['name']) ?? null;
        $email_address  = Session::has('frontUser') ? Session::get('frontUser')->email : (Session::get('guestUser')['email'] ?? null);
        $custom_int1    = Session::has('frontUser') ? Session::get('frontUser')->id    : (Session::get('guestUser')['user_id'] ?? null);  //user_id

        /*add user subscription*/
        $subscription           = new SubscriptionController();
        $user_subscription      = $subscription->add_user_subscription($request->all(), $custom_int1);
        $user_subscription_id   = isset($user_subscription->id) ? $user_subscription->id : null;

        /*Transaction details*/
        $amount         = isset($request->amount)    ? $request->amount     : null;
        $item_name      = isset($request->item_name) ? $request->item_name  : null;
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
            'custom_int1'   => $custom_int1,                 //user_id
            'custom_int2'   => $user_subscription_id,       //user_sunscription_id
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
        $payment                        = Payment::create($data);

        \Log::info(print_r($request->all(), true));

        if(isset($request->custom_int1) && !empty($payment)){
            $user_subscription = UserSubscription::where('user_id', $request->custom_int1)->latest()->first();
            $update_status     = !empty($user_subscription) ? $user_subscription->update(['status' => 1]) : null;
            $user              = FrontUser::find($request->custom_int1)->toArray();

            $message = '<p>Hello Admin,</p>
            <p>The below candidate has completed his payment</p>
            <p>Name: ' . $user['name']. '</p>
            <p>Email: ' . $user['email'] . '</p>';

            $data = [
                'emailTo' => 'prakash.v.php@gmail.com',
                'name'    => 'admin',  
            ];

            $this->send_mail($data, $message);
        }
    }
}
