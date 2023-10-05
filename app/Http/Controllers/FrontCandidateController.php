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
            'review_rating_count'       => 'required',
            'review_note'               => 'required',
            'reviewer_id'               => 'required',
            'candidate_role'            => 'required',
        ]);

        $data              = $request->all();
        $data['date']      = date('Y-m-d');
        $review = CandidateReview::create($data);
        return redirect()->back()->with('success', 'Your review have been recorded successfully.');
    }

    public function store_candidate_favourite(Request $request){
        $this->validate($request, [
            'candidate_id'          => 'required',
            'candidate_role'        => 'required',
            'saved_by_id'           => 'required',
            'saved_by_role'         => 'required',
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
        $data['favourite'] = Session::has('frontUser') ? CandidateFavourite::where('candidate_id', $candidateId)->where('saved_by_id',  $data['loginUser']->id)->first() : null;
        return view('user.candidate_detail', $data);
    }

    /*return all candidates except family candidates*/
    public function all_candidates(){
        $data['menu'] = "all candidates";
        $data['candidates'] = FrontUser::leftJoin('candidate_favourites', 'front_users.id', '=', 'candidate_favourites.candidate_id')
            ->leftJoin('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')
            ->select(
                'front_users.*',
                'candidate_favourites.candidate_id AS candidate_favourites_id',
                'candidate_reviews.review_note',
                'candidate_reviews.review_rating_count'
            )
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('candidate_reviews')
                    ->whereColumn('candidate_reviews.candidate_id', 'front_users.id');
            }, 'total_reviews')
            ->where('front_users.role', '!=', 'family')->where('front_users.status', '1')
            ->get();

        return view('user.all_candidates', $data);
    }
}
