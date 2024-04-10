<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontUser;
use Illuminate\Support\Facades\DB;



class SearchController extends Controller{
    
    public function index(Request $request){

        if(!$request->has('search_query') || !$request->has('type')){
            return redirect()->route('home');
        }

        $splited_string = is_string($request->search_query) ? preg_split('/[\s,]+/', $request->search_query)  : null;
        $search_query   = isset($splited_string) && is_array($splited_string) ? array_filter($splited_string) : array($request->search_query);

        if($request->type == "family") {
            $search = FrontUser::leftJoin(DB::raw('(SELECT family_id, GROUP_CONCAT(DISTINCT candidate_id) as candidate_favorite_families FROM candidate_favorite_families GROUP BY family_id) as candidate_favorites'), 'front_users.id', '=', 'candidate_favorites.family_id')
            ->leftJoin('family_reviews', 'front_users.id', '=', 'family_reviews.family_id')
            ->leftJoin('family_favorite_candidates', 'front_users.id', '=', 'family_favorite_candidates.family_id')
            ->select(
                'front_users.*',
                'candidate_favorites.candidate_favorite_families AS family_favorited_by', //holds the ids of candidate who have liked this family from result set
                'reviews.review_note',
                'reviews.review_rating_count',
                'reviews.total_reviews'
            )
            ->leftJoin(DB::raw('(SELECT family_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM family_reviews GROUP BY family_id) as reviews'), 'front_users.id', '=', 'reviews.family_id')
            ->where(function ($query) use ($search_query) {
                foreach ($search_query as $keyword) {
                    $query->orWhere('front_users.family_address', 'like', '%' . $keyword . '%');
                }
            })
            ->where('front_users.role', 'family')
            ->where('front_users.status', '1')
            ->distinct();
            //->simplePaginate(9);

        }else{
            $search = FrontUser::leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT family_id) as family_favorite_candidate FROM family_favorite_candidates GROUP BY candidate_id) as family_favorites'), 'front_users.id', '=', 'family_favorites.candidate_id')
            ->leftJoin('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')
            ->select(
                'front_users.*',
                'family_favorites.family_favorite_candidate AS candidate_favorited_by', //return the ids of the families who liked this candidate
                'reviews.review_note',
                'reviews.review_rating_count',
                'reviews.total_reviews'
            )
            ->leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM candidate_reviews GROUP BY candidate_id) as reviews'), 'front_users.id', '=', 'reviews.candidate_id')
            ->where(function ($query) use ($search_query) {
                foreach ($search_query as $keyword) {
                    $query->orWhere('front_users.area', 'like', '%' . $keyword . '%');
                }
            })
            ->where('front_users.role', '!=', 'family')
            ->where('front_users.status', '1')
            ->when($request->service, function ($query, $service) {
                return $query->where('front_users.role', $service);
            })
            ->distinct();
            //->simplePaginate(9);
        }

        $data['total_results']  = isset($search) ? $search->count() : 0;
        $data['search']         = isset($search) && !empty($search) ? $search->simplePaginate(9) : array();
        $data['type']           = $request->has('type') ? $request->type : null;
        $data['search_query']   = $request->has('search_query') ? $request->search_query : null;

        return view('user.search',$data);
    }
}
