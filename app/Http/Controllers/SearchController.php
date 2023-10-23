<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\FrontUser;
use DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        if (empty($data['search'])) {
            return redirect()->route('home');
        }
        
        if ($data['type'] == "family") {
            $search = FrontUser::leftJoin('candidate_favorite_families', 'front_users.id', '=', 'candidate_favorite_families.family_id')
            ->leftJoin('family_reviews', 'front_users.id', '=', 'family_reviews.family_id')
            ->select(
                'front_users.*',
                'candidate_favorite_families.candidate_id AS candidate_favourite_family',
                'reviews.review_note',
                'reviews.review_rating_count',
                'reviews.total_reviews'
            )
            ->leftJoin(DB::raw('(SELECT family_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM family_reviews GROUP BY family_id) as reviews'), 'front_users.id', '=', 'reviews.family_id')
            ->where('front_users.role', 'family')
            ->where('front_users.status', '1')
            ->whereRaw("family_address LIKE ?", ['%' . $data['search'] . '%'])
            ->distinct()
            ->get();
        } else {
            $search = FrontUser::leftJoin('family_favorite_candidates', 'front_users.id', '=', 'family_favorite_candidates.candidate_id')
            ->leftJoin('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')
            ->select(
                'front_users.*',
                'family_favorite_candidates.candidate_id AS family_favorite_candidate',
                'reviews.review_note',
                'reviews.review_rating_count',
                'reviews.total_reviews'
            )
            ->leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM candidate_reviews GROUP BY candidate_id) as reviews'), 'front_users.id', '=', 'reviews.candidate_id')
            ->where('front_users.role', '!=', 'family')
            ->where('front_users.status', '1')
            ->whereRaw("front_users.area LIKE ?", ['%' . $data['search'] . '%'])
            ->distinct()
            ->get();
        }
        $type = $data['type'];
        return view('user.search', compact('search', 'type'));
    }
}
