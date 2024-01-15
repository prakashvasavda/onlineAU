<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\Packages;
use Carbon\Carbon;


class SubscriptionController extends Controller{
    
    public function add_user_subscription($input, $user_id){
        $user_subscription_ids = array();
        $package_ids           = array(); 

        foreach($input as $key => $value) {
            $data = array();
            $data = [
                'user_id'       => $user_id,
                'package_id'    => isset($value['id']) ? $value['id'] : null,
                'package_name'  => isset($value['item_name']) ? $value['item_name'] : null,
                'start_date'    => date("Y-m-d"),
                'end_date'      => isset($value['duration']) ? Carbon::now()->addDays($value['duration'])->format('Y-m-d') : null,
                'status'        => 'pending',
                'created_at'    => Carbon::now(),
            ];

            $user_subscription_ids[]  = UserSubscription::insertGetId($data);
            $package_ids[]            = isset($value['id']) ? $value['id'] : null;
            $item_names[]             = isset($value['item_name']) ? $value['item_name'] : null;

        }

        $response = [
            'user_subscription_ids' => isset($user_subscription_ids) ? implode(',', $user_subscription_ids) : null,
            'amount'                => isset($package_ids) ? Packages::whereIn('id', $package_ids)->sum('price') : null,
            'item_name'             => isset($item_names) ? implode(',', $item_names) : null,
        ];

        return $response;
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
        $user_subscription = UserSubscription::where('user_id', $user_id)
            ->where('status', 'active')
            ->orderBy('end_date', 'desc')
            ->first();
        
        /*inactive*/
        if(empty($user_subscription)){
            return "inactive";
        }

        /*pending*/
        if($user_subscription->status == "pending" && Carbon::now() < Carbon::parse($user_subscription->end_date)){
            return "pending";
        }

        /*update pending status*/
        if($user_subscription->status == "pending" && Carbon::now() > Carbon::parse($user_subscription->end_date)){
            $user_subscription->update(['status' => 'expired']);
            return "expired";
        }

        /*update active status*/
        if($user_subscription->status == "active" && Carbon::now() > Carbon::parse($user_subscription->end_date)){
            $user_subscription->update(['status' => 'expired']);
            return "expired";
        }

        /*payment expired*/
        if($user_subscription->status == "expired"){
            return "expired";
        }
        
        /*active*/
        return "active";
    }  
}
