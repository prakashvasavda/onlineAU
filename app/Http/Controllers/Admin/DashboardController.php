<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\FrontUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;



class DashboardController extends Controller{
    
    public function index(){
        $data['menu']           = 'Dashboard';
        $front_users = FrontUser::selectRaw("
            SUM(CASE WHEN role = 'au-pairs' THEN 1 ELSE 0 END) as total_aupairs,
            SUM(CASE WHEN role = 'nannies' THEN 1 ELSE 0 END) as total_nannies,
            SUM(CASE WHEN role = 'family' THEN 1 ELSE 0 END) as total_families,
            SUM(CASE WHEN role = 'babysitters' THEN 1 ELSE 0 END) as total_babysitters,
            SUM(CASE WHEN role = 'nannies' THEN 1 ELSE 0 END) as total_nannies,
            SUM(CASE WHEN role = 'family-petsitting' THEN 1 ELSE 0 END) as total_family_petsittings,
            SUM(CASE WHEN role = 'petsitters' THEN 1 ELSE 0 END) as total_petsitters

        ")->first();

        $data['candidates'] = FrontUser::latest('created_at')->take(5)->get();
        $data['payment']    = Payment::latest('created_at')->take(5)->get();

        $data['front_users']    = $front_users;
        return view('admin.dashboard',$data);
    }
}
