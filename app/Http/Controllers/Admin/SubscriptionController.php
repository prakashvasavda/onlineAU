<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use App\Models\FrontUser;

class SubscriptionController extends Controller{
    
    public function get_cancellation_requests(Request $request){
        $data['menu'] = "cancel requests";
      
        if ($request->ajax()) {
            $response = UserSubscription::select('front_users.name AS user_name', 'user_subscriptions.*', 'packages.name AS package_name')
                ->leftJoin('packages', 'packages.id', '=', 'user_subscriptions.package_id')
                ->leftJoin('front_users', 'front_users.id', '=', 'user_subscriptions.user_id')
                ->where('user_subscriptions.status', 'active')
                ->where('user_subscriptions.cancellation_request_status', 1)
                ->whereNotNull('user_subscriptions.cancellation_approval_status')
                ->get();
            
            return DataTables::of($response)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Edit Candidate" data-trigger="hover">
                                <a href="'.url('admin/candidates/edit-nannies/'.$row->id).'" class="btn btn-sm btn-primary edit-candidate" type="button" data-id="' . $row->id . '"><i class="fa fa-pen"></i></a>
                            </span>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.subscriptions.cancel-requests.index', $data);
    }
}
