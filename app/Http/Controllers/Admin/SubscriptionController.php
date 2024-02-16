<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\FrontUser;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller{
    
    public function get_cancellation_requests(Request $request){
        $data['menu'] = "cancel requests";
        
        if ($request->ajax()) {
            $response = UserSubscription::select('front_users.id AS front_user_id','front_users.name AS user_name', 'front_users.email', 'user_subscriptions.*', 'packages.name AS package_name')
                ->leftJoin('packages', 'packages.id', '=', 'user_subscriptions.package_id')
                ->leftJoin('front_users', 'front_users.id', '=', 'user_subscriptions.user_id')
                ->where('user_subscriptions.status', 'active')
                ->where('user_subscriptions.cancellation_request_status', 1)
                ->get();
            
            return DataTables::of($response)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Approve Request" data-trigger="hover">
                                <a href="#" class="btn btn-sm btn-primary" type="button" data-id="' . $row->id . '" onClick="approveRequest('. $row->id. ', ' .$row->front_user_id .')"><i class="fa fa-pen"></i></a>
                            </span>';
                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    $status = [
                        0 => '<span class="badge badge-warning">denied</span>',
                        1 => '<span class="badge badge-success">approved</span>',
                    ];

                    return $status[$row->cancellation_approval_status] ?? '<span class="badge badge-danger">pending</span>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.subscriptions.cancel-requests.index', $data);
    }

    public function update_cancellation_request(Request $request){
        try {
            $request->validate([
                'id'   => 'required',
                'user_id'           => 'required',
                'approval_status'   => 'required',
                'end_date'          => 'required',
            ]);
    
            $userSubscription = UserSubscription::where('id', $request->id)
                ->where('user_id', $request->user_id)
                ->first();
    
            if(empty($userSubscription)){
                return response()->json([
                    'status'  => 400,
                    'message' => 'data not found'
                ]);
            }

            $userSubscription->update([
                'cancellation_approval_status' => $request->approval_status,
                'end_date'                     => Carbon::parse($request->end_date),
            ]);

            return response()->json(['status' => 200]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
}
