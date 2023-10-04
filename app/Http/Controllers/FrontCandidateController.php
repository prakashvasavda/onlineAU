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

class FrontCandidateController extends Controller{

    public function store_candidate_reviews(Request $request){
        if (!Session::has('frontUser')) {
            return redirect()->back()->with('error', 'You must be logged in to submit a review.');
        } 
        $this->validate($request, [
            'review_rating_count' => 'required',
            'review_note' => 'required',
            'reviewer_id' => 'required',
        ]);

        $data = $request->all();
        $data['date'] = date('Y-m-d');
        $review = CandidateReview::create($data);
        return redirect()->back()->with('success', 'Your review have been recorded successfully.');
    }

    public function store_candidate_favourite(Request $request){
        $this->validate($request, [
            'candidate_id' => 'required',
            'candidate_role' => 'required',
            'family_id' => 'required',
        ]);

        $data = $request->all();
        $favourite = CandidateFavourite::where('family_id', $request->family_id)->where('candidate_id', $request->candidate_id)->first();
        if(!empty($favourite)){
            return response()->json(['message' => 'error'], 404);
        }
        
        $favourite = CandidateFavourite::create($data);
        return response()->json(['message' => 'success', 'favourite' => $favourite], 200);
    }

     public function candidate_detail($candidateId){
        $data['menu'] = 'candidate detail';
        $data['candidate'] = FrontUser::where('id', $candidateId)->where('status', '1')->first();
        $data['availability'] = NeedsBabysitter::where('family_id', $candidateId)->first();
        $data['morning_availability']   = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability'] = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']   = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']     = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        
        $data['reviews'] = CandidateReview::select(['review_note', 'review_rating_count'])
            ->selectSub(function ($query) use ($candidateId) {
                $query->selectRaw('COUNT(*)')
                    ->from('candidate_reviews')
                    ->where('candidate_id', $candidateId);
            }, 'total_reviews')
            ->where('candidate_id', $candidateId)
            ->latest('created_at')
            ->first();

        $data['loginUser'] = Session::has('frontUser') ? Session::get('frontUser') : null;
        $data['favourite'] = Session::has('frontUser') ? CandidateFavourite::where('candidate_id', $candidateId)->where('family_id',  $data['loginUser']->id)->first() : null;
        return view('user.candidate_detail', $data);
    }
}
