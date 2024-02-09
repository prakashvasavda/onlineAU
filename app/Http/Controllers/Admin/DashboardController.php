<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\FrontUser;



class DashboardController extends Controller{
    
    public function index(){

        $front_users = FrontUser::selectRaw("
            SUM(CASE WHEN role = 'au-pairs' THEN 1 ELSE 0 END) as total_aupairs,
            SUM(CASE WHEN role = 'nannies' THEN 1 ELSE 0 END) as total_nannies,
            SUM(CASE WHEN role = 'family' THEN 1 ELSE 0 END) as total_families,
            SUM(CASE WHEN role = 'babysitters' THEN 1 ELSE 0 END) as total_babysitters,
            SUM(CASE WHEN role = 'nannies' THEN 1 ELSE 0 END) as total_nannies,
            SUM(CASE WHEN role = 'family-petsitting' THEN 1 ELSE 0 END) as total_family_petsittings,
            SUM(CASE WHEN role = 'petsitters' THEN 1 ELSE 0 END) as total_petsitters

        ")->first();

        $data['menu']           = 'Dashboard';
        $data['front_users']    = $front_users;
        return view('admin.dashboard',$data);
    }
}
