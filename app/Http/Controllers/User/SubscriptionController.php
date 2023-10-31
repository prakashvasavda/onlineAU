<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\UserSubscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller{
    public function store_user_subscription($user, $user_id){
        $data['user_id']        = $user_id;
        $data['package_id']     = $user['package'];
        $data['start_date']     = date("Y-m-d H:i:s");
        $data['end_date']       = date('Y-m-d', strtotime("+1 months", strtotime(now())));
        return UserSubscription::create($data);
    }
}
