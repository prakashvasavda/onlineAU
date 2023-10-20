<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CandidateReview;
use App\FamilyReview;
use App\FrontUser;
use DataTables;


class ReviewController extends Controller{
    
    public function index(Request $request){
        $data['menu']       = "review";
        $candidate_reviews  = FrontUser::Join('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')->select('front_users.*', 'candidate_reviews.review_note', 'candidate_reviews.id AS review_id');
        $family_reviews     = FrontUser::Join('family_reviews', 'front_users.id', '=', 'family_reviews.family_id')->select('front_users.*', 'family_reviews.review_note', 'family_reviews.id AS review_id');
        $data               = $candidate_reviews->union($family_reviews)->get();

        
        if($request->ajax()){
            
            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Delete Review" data-trigger="hover">
                                <button class="btn btn-sm btn-danger delete-review" type="button" data-id="' . $row->id . '" onclick="deleteReview(' . $row->review_id . ', \'' . $row->role . '\')"><i class="fa fa-trash"></i></button>
                            </span>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('reviews.index', $data);
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $id){
       if($request->role != "family"){
            $delete_status = CandidateReview::where('id', $request->review_id)->delete();
            return response()->json('success', 200);
       }
        $delete_status = FrontUser::where('id', $request->review_id)->delete();
        return response()->json('success', 200);
    }
}
