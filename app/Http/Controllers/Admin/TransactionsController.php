<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use App\Models\Payment;
use App\Models\FrontUser;
use DataTables;

class TransactionsController extends Controller{
    
    public function index(Request $request){
        $data['menu'] = "transactions";
        if ($request->ajax()) {
           return DataTables::of(Payment::get())
            ->addColumn('action', function ($item) {
                // Add custom actions here
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.transactions.index', $data);
    }

    public function get_user_subsctiptions($id){
        $user_subscription = UserSubscription::leftJoin('packages', 'user_subscriptions.package_id', '=', 'packages.id')
                ->select('user_subscriptions.*', 'packages.name', 'packages.price')
                ->where('user_id', $id)
                ->get()
                ->toArray();
        $row  = '';

        $subscriptions_status = [
            'inactive'  => '<td><span class="badge badge-dark">inactive</span></td>',
            'pending'   => '<td><span class="badge badge-danger">pending</span></td>',
            'expired'   => '<td><span class="badge badge-warning">expired</span></td>',
            'active'    => '<td><span class="badge badge-success">paid</span></td>',
        ];

        if(isset($user_subscription) && !empty($user_subscription)){
            foreach($user_subscription as $key => $value) {
                $row .= '<tr>';
                $row .= '<td>'.$value['name'].'</td>';
                $row .= '<td>'.$value['price'].'</td>';
                $row .= isset($subscriptions_status[$value['status']]) ? $subscriptions_status[$value['status']] : "<td></td>";
                $row .= '</td>';
                $row .= '</tr>';
            }
        }else{
            $row .= '<tr>';
            $row .= '<td class="text-center" colspan="3"> No data available</td>';
            $row .= '</tr>';
        }

        return response()->json($row, 200);
    }
}
