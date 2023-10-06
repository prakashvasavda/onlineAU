<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\CandidateReview;
use App\CandidateFavourite;
use App\FrontUser;
use App\NeedsBabysitter;
use App\PreviousExperience;
use Session;
use DB;

class FrontFamilyController extends Controller{

    public function family_detail($familyId){
        $data['menu']                       = 'family detail';
        $data['family']                     = FrontUser::where('id', $familyId)->where('role', 'family')->where('status', '1')->first();
        $data['availability']               = NeedsBabysitter::where('family_id', $familyId)->first(); //candidate availablity records
        $data['morning_availability']       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        
        $data['reviews'] = CandidateReview::select(['review_note', 'review_rating_count'])
            ->selectSub(function ($query) use ($familyId) {
                $query->selectRaw('COUNT(*)')
                    ->from('candidate_reviews')
                    ->where('candidate_id', $familyId);
            }, 'total_reviews')
            ->where('candidate_id', $familyId)
            ->where('candidate_role', 'family')
            ->latest('created_at')
            ->first();

        $data['loginUser'] = Session::has('frontUser') ? Session::get('frontUser') : null;
        $data['favourite'] = Session::has('frontUser') ? CandidateFavourite::where('candidate_id', $familyId)->where('saved_by_id',  $data['loginUser']->id)->first() : null;
        return view('user.family_detail', $data);
    }

    public function store_family_reviews(Request $request){
        if (!Session::has('frontUser')) {
            return redirect()->back()->with('error', 'You must be logged in to submit a review.');
        } 
         
        $request->validate([
            'review_rating_count'       => 'required',
            'review_note'               => 'required',
            'reviewer_id'               => 'required',
            'reviewer_role'             => 'required|not_in:family',
            'candidate_role'            => 'required',
        ]);

        $data              = $request->all();
        $data['date']      = date('Y-m-d');
        $review = CandidateReview::create($data);
        return redirect()->back()->with('success', 'Your review have been recorded successfully.');
    }

    public function store_family_favourite(Request $request){
        $request->validate([
            'candidate_id'          => 'required',
            'candidate_role'        => 'required',
            'saved_by_id'           => 'required',
            'saved_by_role'         => 'required|not_in:family',
        ]);

        $data           = $request->all();
        $data['date']   = date('Y-m-d');
        $favourite = CandidateFavourite::where('saved_by_id', $data['saved_by_id'])->where('saved_by_role', $data['saved_by_role'])->where('candidate_id', $data['candidate_id'])->where('candidate_role', $data['candidate_role'])->first();
        if(!empty($favourite)){
            return response()->json(['message' => 'error'], 404);
        }
        
        $favourite = CandidateFavourite::create($data);
        return response()->json(['message' => 'success', 'favourite' => $favourite], 200);
    }

    public function edit_family($familyId){
        $data['menu']                   = "manage profile";
        $data['family']                 = FrontUser::findOrFail($familyId);
        $data['availability']           = NeedsBabysitter::where('family_id', $familyId)->first();
        $data['previous_experience']    = PreviousExperience::where('candidate_id', $familyId)->get();
        $data['morning_availability']   = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability'] = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']   = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']     = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        return view('user.family_manage_profile', $data);
    }

    public function update_family(Request $request, $familyId){
        return "true";
    }

}
