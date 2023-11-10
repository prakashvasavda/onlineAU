<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserSubscription;
use Carbon\Carbon;


class SubscriptionController extends Controller{
    public function add_user_subscription($input, $user_id){
        $data['user_id']        = $user_id;
        $data['package_id']     = 0;
        $data['package_name']   = isset($input['item_name']) ? $input['item_name'] : null;
        $data['status']         = "inactive";
        $data['start_date']     = date("Y-m-d");
        $data['end_date']       = isset($input['end_date']) ? Carbon::now()->addDays($input['end_date'])->format('Y-m-d') : null;
        return UserSubscription::create($data);
    }

    public function cancel_user_subscription(Request $request){
        $user_subscription = UserSubscription::find($request->id);
        if(!empty($user_subscription)){
            $user_subscription->update(['status' => $request->status]);
            return response()->json('success');
        }
        return response()->json('error');
    } 

    public function check_subscription_status($user_id){
        $user_subscription = UserSubscription::where('user_id', $user_id)->latest()->first();
        
        /*inactive*/
        if(!isset($user_subscription) || empty($user_subscription) || $user_subscription->status == "inactive"){
            return "inactive";
        }

        /*expired*/
        if(Carbon::now() > Carbon::parse($user_subscription->end_date)){
            $user_subscription->update(['status' => 0]);
            return "expired";
        }
        
        /*active*/
        return "active";
    }  
}
