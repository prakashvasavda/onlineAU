<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Features;
use App\Packages;
use App\Payment;
use Session;
use Validator;

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
        $features   = Features::get()->toArray();
        $packages   = Packages::get()->toArray();
        $payment    = Payment::where('user_id', Session::get('frontUser')->id)->first();
        return view('user.pricing', compact('packages', 'features', 'payment'));
    }

    public function store_contact(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'name'    => "required",
            'email'   => "required|email",
            'number'  => "required",
            'message' => "required",
        ];
        $message = [
            'name'    => "The Name must be required",
            'number'  => "The Number must be required",
            'message' => "The Mesasge must be required",
            'email'   => "The Email must be required",

        ];
        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        Contact::insert([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'number'     => $data['number'],
            'message'    => $data['message'],
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

        return redirect()->back()->with('success', 'Thank you for your enquiry. We will be in touch as soon as possible.');
    }

    public function user_logout()
    {
        Session::forget('frontUser');
        return redirect()->route('home');
    }
}
