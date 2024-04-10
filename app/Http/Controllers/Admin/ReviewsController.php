<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CandidateReview;
use App\Models\FamilyReview;
use App\Models\FrontUser;
use Yajra\DataTables\DataTables;

class ReviewsController extends Controller{
    
   public function index(Request $request){
        $data['menu']       = "reviews";
        
        if($request->ajax()){
            $reviews = CandidateReview::with(['front_user'])
                ->leftJoin('front_users', 'front_users.id', '=', 'candidate_reviews.family_id')
                ->select('candidate_reviews.*', 'front_users.name as family_name')
                ->get();

            return DataTables::of($reviews)
                ->addColumn('action', function ($row) {
                    return '<span data-toggle="tooltip" title="Delete Review" data-trigger="hover"><button class="btn btn-sm btn-danger delete-review" type="button" data-id="' . ($row->front_user->id ?? null) . '" onclick="deleteReview(' . ($row->id ?? null) . ', \'' . ($row->front_user->role ?? null) . '\')"><i class="fa fa-trash"></i></button></span>';

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reviews.index', $data);
    }


    public function destroy(Request $request, $id) {
        $reviewModel = ($request->role != "family") ? CandidateReview::class : FamilyReview::class;
        $delete_status = $reviewModel::where('id', $request->review_id)->delete();
        return response()->json($delete_status ? 'success' : 'error', $delete_status ? 200 : 404);
    }
}
