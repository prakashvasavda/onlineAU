<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\SubscriptionController;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Carbon\Carbon;
use App\Models\FrontUser;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller{

    protected $subscriptionController;

    public function __construct(SubscriptionController $subscriptionController){
        $this->subscriptionController = $subscriptionController;
    }

    public function process_payment(Request $request){
        if((!Session::has('frontUser') && !Session::has('guestUser')) || empty(Session::get('cart'))){
            return redirect()->route('sign-up', ['service' => 'family']);
        }

        /*Merchant details*/
        $merchant_id    = env('PAYFAST_MERCHANT_ID');
        $merchant_key   = env('PAYFAST_MERCHANT_KEY');

        /*for testing purpose*/
        // $merchant_id    = 10031315;
        // $merchant_key   = 'sbijrnrrkonrs';

        /*user details*/
        $name_first     = Session::has('frontUser') ? Session::get('frontUser')->name  : (Session::get('guestUser')['name'] ?? null);
        $name_last      = Session::has('frontUser') ? Session::get('frontUser')->name  : (Session::get('guestUser')['name']) ?? null;
        $email_address  = Session::has('frontUser') ? Session::get('frontUser')->email : (Session::get('guestUser')['email'] ?? null);
        $custom_int1    = Session::has('frontUser') ? Session::get('frontUser')->id    : (Session::get('guestUser')['user_id'] ?? null);  //user_id

        /*add user subscription*/
        $subscription           = new SubscriptionController();
        $response               = $subscription->add_user_subscription(Session::get('cart'), $custom_int1);

        /*if user subsctiption failed try again with registration*/
        if(empty($response['user_subscription_ids']) || empty($response['amount']) || empty($response['item_name'])){
            return redirect()->route('sign-up', ['service' => 'family']);
        }

        /*Merchant detail urls*/
        $return_url     = 'https://onlineaupairs.co.za/public/api/payment/success';
        $cancel_url     = 'https://onlineaupairs.co.za/public/api/payment/cancel';
        $notify_url     = 'https://onlineaupairs.co.za/public/api/payment/notify';

        $testingMode = false;
        $payfast_url = $testingMode ? 'https://sandbox.payfast.co.za/eng/process' : 'https://www.payfast.co.za/eng/process';

        $data = array(
            'merchant_id'   => $merchant_id,
            'merchant_key'  => $merchant_key,
            'amount'        => $response['amount'],
            'item_name'     => $response['item_name'],
            'return_url'    => $return_url,
            'cancel_url'    => $cancel_url,
            'notify_url'    => $notify_url,
            'name_first'    => $name_first,
            'name_last'     => $name_last,
            'email_address' => $email_address,
            'm_payment_id'  => time().uniqid(),
            'custom_int1'   => $custom_int1,                              //user_id
            'custom_str1'   => $response['user_subscription_ids'],       //user_sunscription_id
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $payfast_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $api_response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
        }

        curl_close($ch);

        $this->clear_sessions();
        return $api_response;
    }

    public function payment_success(Request $request){
        //return redirect()->route('transactions');
        if(!Session::has('frontUser')){
            return redirect()->route('user-login');
        }

        $frontUser                              = Session::get('frontUser');
        $frontUser['user_subscription_status']  = $this->subscriptionController->check_subscription_status(Session::get('frontUser')->id);
        $frontUser['purchased_candidates']      = $this->get_purchased_candidates(Session::get('frontUser')->id);
        Session::put('frontUser', $frontUser);
        $this->subscriptionController->get_candidate_subscriptions();
    }

    public function payment_cancel(Request $request){
       return redirect()->back()->with('error', 'Payment canceled, please try again.');
    }

    public function payment_notify(Request $request){
        header( 'HTTP/1.0 200 OK' );
        flush();

        $validatedData = $request->validate([
            'custom_int1'   => 'required', //for user id
            'custom_str1'   => 'required', //for user subscription id
        ]);


        $data                           = $request->all();
        $data['user_id']                = $request->custom_int1;
        $data['user_subscription_id']   = 0; //$request->custom_int2;
        $payment                        = Payment::create($data);

        \Log::info(print_r($request->all(), true));

        if (!empty($payment)) {
            $userSubscriptionIds = is_string($request->custom_str1) ? explode(",", $request->custom_str1) : null;

            if (!empty($userSubscriptionIds) && is_array($userSubscriptionIds)) {
                UserSubscription::whereIn('id', $userSubscriptionIds)
                    ->update([
                        'payment_id' => $payment->id,
                        'status' => 'active'
                    ]);
            }
        }
    }

    private function clear_sessions(){
        if(Session::has('guestUser')){
            Session::forget('guestUser');
        }

        if (session::has('cart')) {
            Session::forget('cart');
        }
    }
}
