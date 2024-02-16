<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Packages;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\SubscriptionsCancellationRequest;


class SubscriptionController extends Controller{
    
    public function add_user_subscription($input, $user_id){
        $user_subscription_ids = array();
        $package_ids           = array(); 

        foreach($input as $key => $value) {
            $data = array();
            $data = [
                'user_id'       => $user_id,
                'package_id'    => isset($value['id']) ? $value['id'] : null,
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
        /* track user subscription based on the longest purchased package */
        $user_subscription = UserSubscription::where('user_id', $user_id)
            ->orderBy('end_date', 'desc')
            ->first();
        
        /*inactive*/
        if(empty($user_subscription)){
            return "inactive";
        }

        /*payment pending*/
        if($user_subscription->status == "pending" && Carbon::now() < Carbon::parse($user_subscription->end_date)){
            return "pending";
        }

        /*update pending status to expired status*/
        if($user_subscription->status == "pending" && Carbon::now() > Carbon::parse($user_subscription->end_date)){
            return "expired";
        }

        /*update active status to expired status*/
        if($user_subscription->status == "active" && Carbon::now() > Carbon::parse($user_subscription->end_date)){
            return "expired";
        }

        /*subscription expired*/
        if($user_subscription->status == "expired"){
            return "expired";
        }
        
        /*subscription is active*/
        return "active";
    }
    
    public function update_subscription_status($user_id){
        $user_subscriptions = UserSubscription::where('user_id', $user_id)
            ->where('status', 'active')
            ->get();
        
        if(!isset($user_subscriptions) || $user_subscriptions->isEmpty()){
            return false;
        }

        foreach ($user_subscriptions as $user_subscription) {
            if (Carbon::now() > Carbon::parse($user_subscription->end_date)) {
                $user_subscription->update(['status' => 'expired']);
            }
        }

        return true;
    }

    public function get_candidate_subscriptions(){
        $data['subscriptions'] = UserSubscription::leftJoin('packages', 'user_subscriptions.package_id', '=', 'packages.id')
            ->select(
                'user_subscriptions.*', 
                'packages.name', 'packages.price', 
                'packages.cancellation_allowed', 
                'packages.cancellation_notice_period',
                'packages.duration'
            )
            ->where('user_subscriptions.status', 'active')
            ->where('user_id', Session::get('frontUser')->id)
            ->get()
            ->toArray();

        return view('user.family.transactions', $data);
    }

    public function request_cancellation(Request $request){
        try {
            $request->validate([
                'id'       => 'required',
                'user_id'  => 'required',
            ]);
    
            $userSubscription = UserSubscription::select('user_subscriptions.*', 'packages.name AS package_name')
                ->leftJoin('packages', 'packages.id', '=', 'user_subscriptions.package_id')
                ->where('user_subscriptions.id', $request->id)
                ->where('user_subscriptions.user_id', $request->user_id)
                ->first();
    
            if(empty($userSubscription)){
                return response()->json([
                    'status'  => 400,
                    'message' => 'data not found'
                ]);
            }

            $userSubscription->update(['cancellation_request_status' => 1]);

            Mail::to("emmanuel.k.php@gmail.com")->send(new SubscriptionsCancellationRequest($userSubscription));
            return response()->json(['status' => 200]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
}
