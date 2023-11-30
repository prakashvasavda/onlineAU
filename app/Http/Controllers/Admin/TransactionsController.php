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
        if(isset($user_subscription) && !empty($user_subscription)){
            foreach($user_subscription as $key => $value) {
                $row .= '<tr>';
                $row .= '<td>'.$value['name'].'</td>';
                $row .= '<td>'.$value['price'].'</td>';
                $row .= '<td><span class="badge badge-pill ' . ($value['status'] == 'active' ? 'badge-success' : ($value['status'] == 'inactive' ? 'badge-secondary' : 'badge-warning')) . '">' . ($value['status'] == 'active' ? 'paid' : ($value['status'] == 'inactive' ? 'pending' : 'expired')) . '</span></td>';
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

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
