<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;

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

    public function user_logout()
    {        
        Session::forget('frontUser');
        return redirect()->route('home');
    }
}
