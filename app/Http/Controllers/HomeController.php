<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Features;
use App\Packages;
use App\Payment;
use Session;
use Validator;
use App\FrontUser;
use DB;


class HomeController extends Controller
{

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

    public function candidates($service=null){
        $data['menu']       = "candidates";

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
        ->simplePaginate(3);
    
       
        return view('user.candidate.candidates', $data);
    }

    public function families(){
        $data['menu']       = 'families';
        $data['candidates'] = FrontUser::leftJoin('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')
        ->select(
            'front_users.*',
            'reviews.review_note',
            'reviews.review_rating_count',
            'reviews.total_reviews'
        )
        ->leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM candidate_reviews GROUP BY candidate_id) as reviews'), 'front_users.id', '=', 'reviews.candidate_id')
        ->where('front_users.role', '!=', 'family')
        ->where('front_users.status', '1')
        ->distinct()
        ->get();

        return view('user.families', $data);
    }

    public function sign_up(){
        return view('user.sign_up');
    }

    public function user_logout(){
        Session::forget('frontUser');
        return redirect()->route('home');
    }

    public function terms_and_conditions($service){
        if($service == "candidate"){
            return view('user.candidate_terms_and_conditions');
        }else{
            return view('user.family_terms_and_conditions');
        }
    }
}
