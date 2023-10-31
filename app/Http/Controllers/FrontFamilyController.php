<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\CandidateFavoriteFamily;
use App\FamilyFavoriteCandidate;
use App\UserSubscription;
use App\CandidateFavourite;
use App\PreviousExperience;
use App\NeedsBabysitter;
use App\CandidateReview;
use App\FamilyReview;
use App\FrontUser;
use App\Features;
use App\Packages;
use App\Payment;
use Validator;
use Session;
use DB;
use Carbon\Carbon;


class FrontFamilyController extends Controller{

    public function store_family_review(Request $request){ 
        $request->validate([
            'review_rating_count'       => 'required',
            'review_note'               => 'required',
        ]);

        $input              = $request->all();
        $input['date']      = date('Y-m-d');
        $review = FamilyReview::updateOrCreate(['family_id' => $request->family_id, 'candidate_id' => $request->candidate_id], $input);
        return redirect()->back()->with('success', 'Your review have been recorded successfully.');
    }

    public function store_family_favourite_candidate(Request $request){
        $request->validate([
            'candidate_id'     => 'required',
            'family_id'        => 'required',
        ]);

        $input           = $request->all();
        $input['date']   = date('Y-m-d');
        $familyFavourite = FamilyFavoriteCandidate::where('family_id', Session::get('frontUser')->id)->where('candidate_id', $request->candidate_id)->first();
        
        if(!empty($familyFavourite)){
            $familyFavourite->delete();
            return response()->json(['message' => 'deleted'], 200);
        }

        $status = FamilyFavoriteCandidate::create($input);
        return response()->json(['message' => 'success'], 200);
    }
    
    public function manage_profile(){
        $familyId                                           = Session::get('frontUser')->id;
        $data['menu']                                       = "manage profile";
        $data['family']                                     = FrontUser::findOrFail($familyId);
        $data['family']['family_babysitter_comfortable']    = !empty($data['family']->family_babysitter_comfortable) ? json_decode($data['family']->family_babysitter_comfortable, true) : array();
        $data['family']['family_special_need_value']        = !empty($data['family']->family_special_need_value) ? json_decode($data['family']->family_special_need_value, true) : array();
        $data['family']['describe_kids']                    = !empty($data['family']->describe_kids) ? json_decode($data['family']->describe_kids): array();
        $data['availability']                               = NeedsBabysitter::where('family_id', $familyId)->first();
        $data['previous_experience']                        = PreviousExperience::where('candidate_id', $familyId)->get();
        $data['morning_availability']                       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']                     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']                       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']                         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        $data['family']['age']                              = !empty($data['family']->age) ? json_decode($data['family']->age, true) : array();
        return view('user.family.manage_profile', $data);
    }

    public function update_family(Request $request, $familyId){
        $request->validate([
            'name'                          => "required",
            'age'                           => "required",
            'profile'                       => "required_if:hidden_profile,false",
            'family_address'                => "required",
            'family_city'                   => "required",
            'home_language'                 => "required",
            'no_children'                   => "required",
            'describe_kids'                 => "required|array",
            'family_types_babysitter'       => "required",
            'family_location'               => "required",
            'family_babysitter_comfortable' => "required",
            'family_profile_see'            => "required",
            'family_notifications'          => "required",
            'family_description'            => "required",
        ],[
            'profile.required_if'   => 'The profile field is required',
            'describe_kids.array'   =>  'Invalid selected value',   
        ]);

        $family                                 = FrontUser::findorFail($familyId);
        $input                                  = $request->all();
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']                         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']                          = $family->role;
        $input['family_special_need_option']    = isset($request->family_special_need_option) ? 1 : 0;
        $input['family_babysitter_comfortable'] = isset($request->family_babysitter_comfortable) ? json_encode($request->family_babysitter_comfortable) : null;
        $input['family_special_need_value']     = isset($request->family_special_need_value) ? json_encode($request->family_special_need_value) : null;
        $input['profile']                       = $request->hasFile('profile') ? $this->store_image($request->file('profile')) : $family->profile;
        $input['no_children']                   = isset($request->age) && is_array($request->age) ? count($request->age) : $request->no_children;
        $input['describe_kids']                 = isset($request->describe_kids) ? json_encode($request->describe_kids) : null;
        $availability                           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_family_calender($input, $familyId) : 0;
        $update_status                          = $family->update($input);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

   
    public function edit_family_calender(Request $request){
        $data['menu']                   = "manage calender";
        $data['candidate']              = FrontUser::findOrFail(Session::get('frontUser')->id);
        $data['availability']           = NeedsBabysitter::where('family_id', Session::get('frontUser')->id)->first();
        $data['morning_availability']   = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability'] = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']   = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']     = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        return view('user.family.family_manage_calender', $data);
    }

    public function update_family_calender(Request $request, $familyId){
        $input      = $request->all();
        $status     = $this->store_family_calender($input, $familyId);
        return redirect()->back()->with($status > 0 ? 'success' : 'error', $status > 0 ? 'Family calendar has been updated successfully.' : 'Failed to update Family\'s calendar.');
    }

    public function store_family_calender($input, $candidateId){
        $candidate = FrontUser::findOrFail($candidateId);
        if(isset($candidate) && !empty($candidate)){
            $data['morning']        = !empty($input['morning']) ? json_encode($input['morning']) : null;
            $data['afternoon']      = !empty($input['afternoon']) ? json_encode($input['afternoon']) : null;
            $data['evening']        = !empty($input['evening']) ? json_encode($input['evening']) : null;
            $data['night']          = !empty($input['night']) ? json_encode($input['night']) : null;
            $data['updated_at']     =  date("Y-m-d H:i:s");
            $availability           =  $candidate->needs_babysitter()->updateOrCreate(['family_id' => $candidateId], $data);
            return $availability->id;
        }        
    }

    
    public function view_candidates(){
        $data['menu']       = "view candidates";
        $data['user']       = Session::get('frontUser');
        $data['candidates'] = FrontUser::leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT family_id) as family_favorite_candidate FROM family_favorite_candidates GROUP BY candidate_id) as family_favorites'), 'front_users.id', '=', 'family_favorites.candidate_id')
        ->leftJoin('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')
        ->select(
            'front_users.*',
            'family_favorites.family_favorite_candidate AS candidate_favorited_by', //return the ids of the families who liked this candidate
            'reviews.review_note',
            'reviews.review_rating_count',
            'reviews.total_reviews'
        )
        ->leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM candidate_reviews GROUP BY candidate_id) as reviews'), 'front_users.id', '=', 'reviews.candidate_id')
        ->where('front_users.role', '!=', 'family')
        ->where('front_users.status', '1')
        ->orderByRaw('LOCATE(?, family_favorite_candidate) DESC, family_favorite_candidate ASC', [$data['user']->id])
        ->distinct()
        ->get();

        return view('user.candidate.view_candidates', $data);
    }

    public function view_all_candidates(){
        $data['menu']        = "all candidates";
        $data['candidates']  = FrontUser::where('role', '!=', 'family')->where('status', 1)->get();
        return view('user.candidate.all_candidates', $data);
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
        $data['candidates'] = FrontUser::leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT family_id) as family_favorite_candidate FROM family_favorite_candidates GROUP BY candidate_id) as family_favorites'), 'front_users.id', '=', 'family_favorites.candidate_id')
        ->leftJoin('candidate_reviews', 'front_users.id', '=', 'candidate_reviews.candidate_id')
        ->select(
            'front_users.*',
            'family_favorites.family_favorite_candidate', //return the ids of the families who liked this candidate
            'reviews.review_note',
            'reviews.review_rating_count',
            'reviews.total_reviews'
        )
        ->leftJoin(DB::raw('(SELECT candidate_id, GROUP_CONCAT(DISTINCT review_note) as review_note, GROUP_CONCAT(DISTINCT review_rating_count) as review_rating_count, COUNT(DISTINCT id) as total_reviews FROM candidate_reviews GROUP BY candidate_id) as reviews'), 'front_users.id', '=', 'reviews.candidate_id')
        ->where('front_users.role', '!=', 'family')
        ->where('front_users.status', '1')
        ->distinct()
        ->get();

        return view('user.family.reviews', $data);
    }

    public function transactions(){
        $data['menu']                = "transactions";
        $data['features']            = Features::get()->toArray();
        $data['packages']            = Packages::get()->toArray();
        $data['user_subscription']   = UserSubscription::where('user_id', Session::get('frontUser')->id)->where('status', 1)->latest()->first();
        $data['end_date']            = isset($data['user_subscription']) ? Carbon::parse($data['user_subscription']['end_date']) : null;
        $data['payment']             = Payment::where('user_id', Session::get('frontUser')->id)->latest()->first();
        return view('user.family.pricing', $data);
    }
}
