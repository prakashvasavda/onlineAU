<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\CandidateFavoriteFamily;
use App\Models\FamilyFavoriteCandidate;
use App\Models\FamilyReview;
use App\Models\CandidateReview;
use App\Models\FrontUser;
use App\Models\NeedsBabysitter;
use App\Models\PreviousExperience;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;


class FrontCandidateController extends Controller{
    
    public function store_candidate_reviews(Request $request){
        $request->validate([
            'review_rating_count'       => 'required',
            'review_note'               => 'required',
        ]);

        $input              = $request->all();
        $input['date']      = date('Y-m-d');
        $review = CandidateReview::updateOrCreate(['candidate_id' => $request->candidate_id, 'family_id' => $request->family_id], $input);
        return redirect()->back()->with('success', 'Your review have been recorded successfully.');
    }

    public function store_candidate_favorite_family(Request $request){
        $request->validate([
            'candidate_id'  => 'required',
            'family_id'     => 'required',
        ]);

        $data                       = $request->all();
        $data['date']               = date('Y-m-d');
        $candidate_favorite_family  = CandidateFavoriteFamily::where('candidate_id', Session::get('frontUser')->id)->where('family_id', $request->family_id)->first();
        
        if(!empty($candidate_favorite_family)){
            $status = $candidate_favorite_family->delete();
            return response()->json(['message' => 'deleted'], 200);
        }
        
        $status = CandidateFavoriteFamily::create($data);
        return response()->json(['message' => 'success'], 200);
    }

    public function manage_profile(){
        $candidateId                                            = Session::get('frontUser')->id;
        $data['menu']                                           = "manage profile";
        $data['candidate']                                      = FrontUser::findOrFail($candidateId);
        $data['candidate']['other_services']                    = !empty($data['candidate']->other_services) ? json_decode($data['candidate']->other_services) : array();
        $data['candidate']['ages_of_children_you_worked_with']  = !empty($data['candidate']->ages_of_children_you_worked_with) ? json_decode($data['candidate']->ages_of_children_you_worked_with) : array();
        $data['candidate']['animals_comfortable_with']          = !empty($data['candidate']->animals_comfortable_with) ? json_decode($data['candidate']->animals_comfortable_with) : array();
        $data['availability']                                   = NeedsBabysitter::where('family_id', $candidateId)->first();
        $data['previous_experience']                            = PreviousExperience::where('candidate_id', $candidateId)->get();
        $data['morning_availability']                           = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']                         = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']                           = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']                             = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        

        $role = strtolower(Session::get('frontUser')->role);
        
        $candidate_profile_forms = [
            'au-pairs'      => 'user.manage_profile.aupairs',
            'nannies'       => 'user.manage_profile.nannies',
            'petsitters'    => 'user.manage_profile.petsitters',
            'babysitters'   => 'user.manage_profile.babysitters',
        ];

        $view = $candidate_profile_forms[$role] ?? 'user.home';
        return view($view, $data);
    }

    public function update_candidate(Request $request, $candidateId){
        $request->validate([
            'name'                  => 'required',
            'age'                   => 'required|gt:18|lt:40',
            'id_number'             => 'required|min:10|max:10',
            'salary_expectation'    => "sometimes|required",
            'surname'               => "required",
            'hourly_rate_pay'       => 'sometimes|required',
            'contact_number'        => 'nullable|min:10|max:10|regex:/[0-9]{9}/',
            'area'                  => 'required',
        ],[
            'hourly_rate_pay'       => 'The hourly rate amount field is required',
        ]);

        $candidate              = FrontUser::findorFail($candidateId);
        $input                  = $request->all();
        $input['password']      = !empty($request->password) ? Hash::make($request->password) : $candidate->password;
        $input['email']         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']          = $candidate->role;
        $input['profile']       = $request->hasFile('profile') ? $this->store_image($request->file('profile')) : $candidate->profile;
        $input['other_services']= !empty($request->other_services) ? json_encode($request->other_services) : null;
        $experiance             = !empty($input['daterange']) ? $this->store_previous_experience($input, $candidateId) : 0;
        $availability           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_candidate_calender($input, $candidateId) : 0;
        $update_status          = $candidate->update($input);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function store_previous_experience($input, $candidateId){
        $previous_experiance =  PreviousExperience::where('candidate_id', $candidateId)->get()->toArray();
        if(isset($previous_experiance) && !empty($previous_experiance)){
            $delete_status = PreviousExperience::where('candidate_id', $candidateId)->delete(); 
        }
            
        foreach ($input['daterange'] as $key => $value) {
            $data = array();
            $data['candidate_id']   = isset($candidateId) ? $candidateId : null;
            $data['daterange']      = isset($input['daterange'][$key]) ? $input['daterange'][$key] : null;
            $data['heading']        = isset($input['heading'][$key]) ? $input['heading'][$key] : null; 
            $data['description']    = isset($input['description'][$key]) ? $input['description'][$key] : null;             
            $data['reference']      = isset($input['reference'][$key]) ? $input['reference'][$key] : null; 
            $data['tel_number']     = isset($input['tel_number'][$key]) ? $input['tel_number'][$key] : null;  
            $data['created_at']     = date("Y-m-d H:i:s");
            $data['updated_at']     = date("Y-m-d H:i:s");
            $status = PreviousExperience::create($data);
        }
        return $status;
    }

    public function manage_calender(Request $request){
        $data['menu']                   = "manage calender";
        $data['candidate']              = FrontUser::findOrFail(Session::get('frontUser')->id);
        $data['availability']           = NeedsBabysitter::where('family_id', Session::get('frontUser')->id)->first();
        $data['morning_availability']   = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability'] = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']   = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']     = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        return view('user.candidate.manage_calender', $data);
    }

    public function update_candidate_calender(Request $request, $candidateId){
        $input      = $request->all();
        $status     = $this->store_candidate_calender($input, $candidateId);
        return redirect()->back()->with($status > 0 ? 'success' : 'error', $status > 0 ? 'Candidate calendar has been updated successfully.' : 'Failed to update candidate\'s calendar.');
    }

    public function store_candidate_calender($input, $candidateId){
        $candidate = FrontUser::find($candidateId);
        if(isset($candidate) && empty($candidate)){
            return 0;
        }

        $data['morning']        = !empty($input['morning']) ? json_encode($input['morning']) : null;
        $data['afternoon']      = !empty($input['afternoon']) ? json_encode($input['afternoon']) : null;
        $data['evening']        = !empty($input['evening']) ? json_encode($input['evening']) : null;
        $data['night']          = !empty($input['night']) ? json_encode($input['night']) : null;
        $data['updated_at']     =  date("Y-m-d H:i:s");
        $availability           =  $candidate->needs_babysitter()->updateOrCreate(['family_id' => $candidateId], $data);
        return $availability->id;        
    }

    public function view_families(){
        $data['menu']     = "view families";
        $data['user']     = Session::get('frontUser');
        $data['families'] = FrontUser::leftJoin(DB::raw('(SELECT family_id, GROUP_CONCAT(DISTINCT candidate_id) as candidate_favorite_families FROM candidate_favorite_families GROUP BY family_id) as candidate_favorites'), 'front_users.id', '=', 'candidate_favorites.family_id')
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
        // ->where('family_favorite_candidates.candidate_id', Session::get('frontUser')->id) //families who have liked this camdidate
        ->where('front_users.role', 'family')
        ->where('front_users.status', '1')
        ->distinct()
        ->simplePaginate(9);

        return view('user.family.view_families', $data);
    }

    public function candidate_detail($candidateId){
        $data['menu']                           = 'candidate detail';
        $data['candidate']                      = FrontUser::where('id', $candidateId)->where('status', '1')->first();
        $data['availability']                   = NeedsBabysitter::where('family_id', $candidateId)->first();
        $data['payments']                       = Session::has('frontUser') ? Payment::where('user_id', Session::get('frontUser')->id)->first() : null;
        $data['candidate']['other_services']    = isset($data['candidate']->other_services) ? implode(", ", json_decode($data['candidate']->other_services, true)) : null;
        $data['morning_availability']           = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']         = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']           = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']             = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
    
        $data['reviews'] = CandidateReview::select(['review_note', 'review_rating_count'])
            ->selectSub(function ($query) use ($candidateId) {
                $query->selectRaw('COUNT(*)')
                    ->from('candidate_reviews')
                    ->where('candidate_id', $candidateId);
            }, 'total_reviews')
            ->where('candidate_id', $candidateId)
            ->latest('updated_at')
            ->first();

        $data['loginUser'] = Session::has('frontUser') ? Session::get('frontUser') : null;
        $data['favourite'] = Session::has('frontUser') ? FamilyFavoriteCandidate::where('candidate_id', $candidateId)->where('family_id', Session::get('frontUser')->id)->first() : null;
        return view('user.candidate.candidate_detail', $data);
    }

    public function reviews(){
        $data['menu']       = "review";
        $data['families'] = FrontUser::leftJoin('candidate_favorite_families', 'front_users.id', '=', 'candidate_favorite_families.family_id')
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
        ->distinct()
        ->get();

        return view('user.candidate.reviews', $data);
    }
}
