<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Features;
use App\Models\Packages;
use App\Models\Payment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\FrontUser;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\ContactUs;


class HomeController extends Controller{
     public function index(){
        return view('user.home');
    }

    public function contact_us(){
        return view('user.contact_us');
    }

    public function store_contact(Request $request){
        $data  = $request->all();

        $rules = [
            'name'    => "required",
            'email'   => "required|email",
            'number'  => "required",
            'message' => "required",
        ];

        $message = [];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        Mail::to('info@onlineaupairs.co.za')->send(new ContactUs($data));

        return redirect()->back()->with('success', 'Thank you for your enquiry. We will be in touch as soon as possible.');
    }

    public function candidates($service=null){
        $data['menu']       = "candidates";
        $data['service']    = $service ?? null;
        $data['user']       = Session::has('frontUser') ? Session::get('frontUser') : null;
        $data['candidates'] = FrontUser::leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT family_id) as family_favorite_candidate FROM family_favorite_candidates GROUP BY candidate_id) as family_favorites'), 'front_users.id', '=', 'family_favorites.candidate_id')
        ->leftJoin('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')
        ->select(
            'front_users.*',
            'family_favorites.family_favorite_candidate AS candidate_favorited_by', //return the ids of the families who liked this candidate
            'reviews.review_note',
            'reviews.review_rating_count',
            'reviews.total_reviews'
        )
        ->leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM candidate_reviews GROUP BY candidate_id) as reviews'), 'front_users.id', '=', 'reviews.candidate_id')
        ->where('front_users.role', '!=', 'family')
        ->where('front_users.status', '1')
        ->when($service, function ($query, $status) {
            return $query->where('front_users.role', $status);
        })
        ->distinct()
        ->simplePaginate(9);
    
       
        return view('user.candidate.candidates', $data);
    }

    public function sign_up($service){
        $data['service'] = $service;
        $data['candidates'] = FrontUser::leftJoin('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')
        ->select(
            'front_users.*',
            'reviews.review_note',
            'reviews.review_rating_count',
            'reviews.total_reviews'
        )
        ->leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM candidate_reviews GROUP BY candidate_id) as reviews'), 'front_users.id', '=', 'reviews.candidate_id')
        ->where('front_users.role', '!=', 'family')
        ->where('front_users.role', '!=', 'family-petsitting')
        ->where('front_users.status', '1')
        ->distinct()
        ->get();

        return $service == 'family' || $service == 'family-petsitting' ? view('user.sign_up.family', $data) : view('user.sign_up.candidate');
    }

    public function user_logout(){
        Session::flush();
        return redirect()->route('home');
    }

    public function terms_and_conditions($service){
        $terms_page = [
            'candidate' => 'user.terms-and-conditions.candidate',
            'family'    => 'user.terms-and-conditions.family',
        ];

        $service = strtolower($service);
        $view    = isset($terms_page[$service]) ? $terms_page[$service] : 'user.home';
        return view($view);
    }

    public function packages(){
        $data['menu'] =  "packages";
        return view('user.packages');
    }

    public function checkout(){
        return view('user.home.checkout');
    }
}
