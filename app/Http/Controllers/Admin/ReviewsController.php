<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CandidateReview;
use App\Models\FamilyReview;
use App\Models\FrontUser;
use DataTables;

class ReviewsController extends Controller{
    
   public function index(Request $request){
        $data['menu']       = "reviews";
        $candidate_reviews  = FrontUser::Join('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')->select('front_users.*', 'candidate_reviews.review_note', 'candidate_reviews.id AS review_id');
        $family_reviews     = FrontUser::Join('family_reviews', 'front_users.id', '=', 'family_reviews.family_id')->select('front_users.*', 'family_reviews.review_note', 'family_reviews.id AS review_id');
        $reviews             = $candidate_reviews->union($family_reviews)->get();
        
        if($request->ajax()){
            
            return DataTables::of($reviews)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Delete Review" data-trigger="hover">
                                <button class="btn btn-sm btn-danger delete-review" type="button" data-id="' . $row->id . '" onclick="deleteReview(' . $row->review_id . ', \'' . $row->role . '\')"><i class="fa fa-trash"></i></button>
                            </span>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reviews.index', $data);
    }

   
    public function create(){
        //
    }

   
    public function store(Request $request){
        //
    }


    public function show(string $id){
        //
    }

   
    public function edit(string $id){
        //
    }

    public function update(Request $request, string $id){
        //
    }

    public function destroy(Request $request, $id) {
        $reviewModel = ($request->role != "family") ? CandidateReview::class : FamilyReview::class;
        $delete_status = $reviewModel::where('id', $request->review_id)->delete();
        return response()->json($delete_status ? 'success' : 'error', $delete_status ? 200 : 404);
    }
}
