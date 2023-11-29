<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Carbon\Carbon;


class SubscriptionController extends Controller{
    
    public function add_user_subscription($input, $user_id){
        $UserSubscriptionIds = array(); 

        foreach($input as $key => $value) {
            $data = array();
            $data = [
                'user_id'       => $user_id,
                'package_id'    => $value['id'],
                'package_name'  => $value['item_name'],
                'start_date'    => date("Y-m-d"),
                'end_date'      => Carbon::now()->addDays($value['duration'])->format('Y-m-d'),
                'status'        => 'inactive',
            ];

            $userSubscriptionIds[] = UserSubscription::insertGetId($data);
        }

        return $userSubscriptionIds;
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
