<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\CandidateReview;
use App\CandidateFavourite;

class FrontCandidateController extends Controller{

    public function store_candidate_reviews(Request $request){
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
            return response()->json(['message' => 'candidate already liked'], 404);
        }
        
        $favourite = CandidateFavourite::create($data);
        return response()->json(['message' => 'success', 'favourite' => $favourite], 200);
    }
}
