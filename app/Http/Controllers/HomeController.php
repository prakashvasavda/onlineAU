<?php

namespace App\Http\Controllers;

use App\Features;
use App\Packages;
use Session;

class HomeController extends Controller
{

    public function index()
    {
        return view('user.home');
    }

    public function contact_us()
    {
        return view('user.contact_us');
    }

    public function pricing()
    {
        $features = Features::get()->toArray();
        $packages = Packages::get()->toArray();

        return view('user.pricing', compact('packages', 'features'));
    }

    public function user_logout()
    {
        Session::forget('frontUser');
        return redirect()->route('home');
    }
}
