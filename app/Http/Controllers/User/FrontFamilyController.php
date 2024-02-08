<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\SubscriptionController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CandidateFavoriteFamily;
use App\Models\FamilyFavoriteCandidate;
use App\Models\UserSubscription;
use App\Models\CandidateFavourite;
use App\Models\PreviousExperience;
use App\Models\NeedsBabysitter;
use App\Models\CandidateReview;
use App\Models\FamilyReview;
use App\Models\FrontUser;
use App\Models\Features;
use App\Models\Packages;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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
        $data['family']['gender_of_children']               = !empty($data['family']->gender_of_children) ? json_decode($data['family']->gender_of_children, true) : array();
        $data['family']['what_do_you_need']                 = !empty($data['family']->what_do_you_need) ? json_decode($data['family']->what_do_you_need, true) : array();
        $data['availability']                               = NeedsBabysitter::where('family_id', $familyId)->first();
        $data['previous_experience']                        = PreviousExperience::where('candidate_id', $familyId)->get();
        $data['morning_availability']                       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']                     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']                       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']                         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        $data['family']['age']                              = !empty($data['family']->age) ? json_decode($data['family']->age, true) : array();
        
        /*family pettisittimg*/ 
        $data['family']['type_of_pet']                      = !empty($data['family']->type_of_pet) ? json_decode($data['family']->type_of_pet, true) : array();
        $data['family']['how_many_pets']                    = !empty($data['family']->how_many_pets) ? json_decode($data['family']->how_many_pets, true) : array();

        $role = strtolower(Session::get('frontUser')->role);
        $family_profile_forms = [
            'family'                => 'user.manage_profile.family',
            'family-petsitting'     => 'user.manage_profile.family_petsitting',
        ];

        $view = $family_profile_forms[$role] ?? 'user.home';
        return view($view, $data);
    }

    public function update_family(Request $request, $familyId){
        $input                              = $request->all();

        $rules = [
            'name'                          => "required|max:50",
            'email'                         => 'required|email', //required|email|unique:front_users,email
            'family_address'                => "required|max:100",
            'family_city'                   => "required|max:100",
            'home_language'                 => "required",
            'no_children'                   => "required|lte:5",
            'family_notifications'          => "required",
            'cell_number'                   => "required|min:10|max:10|regex:/[0-9]{9}/",
            'id_number'                     => 'required' . ($request->type_of_id_number == 'south_african' ? '|numeric|digits:13' : ''),
            'start_date'                    => "required",
            'duration_needed'               => "required|numeric|gte:1|lt:24",
            'petrol_reimbursement'          => "required",
            'candidate_duties'              => "required|max:500",
            'surname'                       => "required|max:50",
            'live_in_or_live_out'           => "required",
            'type_of_id_number'             => "required",
            'profile'                       => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'gender_of_children'            => "required|array",
            'gender_of_children.*'          => "required|in:male,female",
            'what_do_you_need'              => ['required', 'array'],
            'family_description'            => "required|max:500",
            'hourly_rate_pay'               => "required|numeric|digits_between:2,5",
            'salary_expectation'            => "required|numeric|digits_between:2,10",
            // 'age'                           => "required|array",
            // 'age.*'                         => "nullable|in:0-12 months,1-3 years,4-7 years,8-13 years,13-16 years",
            'password' => [
                'nullable',
                'string',
                'min:8',                    // must be at least 10 characters in length
                'regex:/[a-z]/',            // must contain at least one lowercase letter
                'regex:/[A-Z]/',            // must contain at least one uppercase letter
                'regex:/[0-9]/',            // must contain at least one digit
                'regex:/[@$!%*#?&]/',       // must contain a special character
            ],
        ];

        $message = [
            'age.*.in'                      => 'Invalid selected age.',
            'age.*.required'                => 'The age field is required.',
            'gender_of_children.*.in'       => 'Invalid gender selected for a child.',
            'gender_of_children.*.required' => 'The gender field is required.',
            'no_children.required'          => 'The number of children field is required.',
            'password.string'               => 'The password must be a string.',
            'password.min'                  => 'The password must be at least 8 characters in length.',
            'password.regex'                => 'The password must meet the following requirements: at least one lowercase letter, one uppercase letter, one digit, and one special character.',
        ];

        $validator = Validator::make($input, $rules, $message);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        $family                                 = FrontUser::findorFail($familyId);
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']                         = !empty($request->email) ? $request->email : $family->email;
        $input['role']                          = $family->role;
        $input['family_special_need_option']    = isset($request->family_special_need_option) && isset($request->family_special_need_value) ? 1 : 0;
        $input['family_babysitter_comfortable'] = isset($request->family_babysitter_comfortable) ? json_encode($request->family_babysitter_comfortable) : null;
        $input['family_special_need_value']     = isset($request->family_special_need_value) && isset($request->family_special_need_option) ? json_encode($request->family_special_need_value) : null;
        $input['profile']                       = $request->hasFile('profile') ? $this->store_image($request->file('profile')) : $family->profile;
        $input['no_children']                   = isset($request->age) && is_array($request->age) ? count($request->age) : $request->no_children;
        $input['describe_kids']                 = isset($request->describe_kids) ? json_encode($request->describe_kids) : null;
        $input['gender_of_children']            = isset($request->gender_of_children) ? json_encode($request->gender_of_children) : null;
        $input['what_do_you_need']              = isset($request->what_do_you_need) ? json_encode($request->what_do_you_need) : null;

        $availability                           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_family_calender($input, $familyId) : 0;
        $update_status                          = $family->update($input);

        return redirect()->back()->with('success', 'profile updated successfully.');
    }

   
    public function manage_calender(Request $request){
        $data['menu']                   = "manage calender";
        $data['candidate']              = FrontUser::findOrFail(Session::get('frontUser')->id);
        $data['availability']           = NeedsBabysitter::where('family_id', Session::get('frontUser')->id)->first();
        $data['morning_availability']   = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability'] = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']   = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']     = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        return view('user.family.manage_calender', $data);
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
    
    public function view_candidates($service = null){
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
        ->when($service, function ($query, $service) {
            return $query->where('front_users.role', $service);
        })
        ->distinct()
        ->simplePaginate(9);

        return view('user.candidate.view_candidates', $data);
    }

    public function view_all_candidates(){
        $data['menu']        = "all candidates";
        $data['candidates']  = FrontUser::where('role', '!=', 'family')->where('status', 1)->get();
        return view('user.candidate.all_candidates', $data);
    }

    public function family_detail($familyId){
        $data['menu']                           = 'family detail';
        $data['family']                         = FrontUser::where('id', $familyId)->where('role', 'family')->where('status', '1')->first();
        $data['availability']                   = NeedsBabysitter::where('family_id', $familyId)->first(); 
        $data['morning_availability']           = isset($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']         = isset($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']           = isset($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']             = isset($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
       

        $data['reviews'] = FamilyReview::select(['review_note', 'review_rating_count'])
            ->selectSub(function ($query) use ($familyId) {
                $query->selectRaw('COUNT(*)')
                    ->from('family_reviews')
                    ->where('family_id', $familyId);
            }, 'total_reviews')
            ->where('family_id', $familyId)
            ->latest('updated_at')
            ->first();
        
        $what_do_you_need   = isset($data['family']->what_do_you_need) && is_string($data['family']->what_do_you_need) ? json_decode($data['family']->what_do_you_need, true) : null;
        $age_of_children    = isset($data['family']->age) && is_string($data['family']->age) ? json_decode($data['family']->age, true) : null;
        $gender_of_children = isset($data['family']->gender_of_children) && is_string($data['family']->gender_of_children) ? json_decode($data['family']->gender_of_children, true) : null;

        $data['family']['gender_of_children'] = !empty($gender_of_children) && is_array($gender_of_children) ? implode(", ", $gender_of_children) : null;
        $data['family']['what_do_you_need']   = !empty($what_do_you_need) && is_array($what_do_you_need) ? implode(", ", $what_do_you_need) : null;
        $data['family']['age']                = !empty($age_of_children) && is_array($age_of_children) ? implode(", ", $age_of_children) : null;
        
        $data['loginUser'] = Session::has('frontUser') ? Session::get('frontUser') : null;
        $data['favourite'] = Session::has('frontUser') ? CandidateFavoriteFamily::where('candidate_id', Session::get('frontUser')->id)->where('family_id', $familyId)->first() : null;
        
        return view('user.family.family_detail', $data);
    }

    public function reviews($service = null){
        $data['menu']       = "review";
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
        ->where('candidate_reviews.family_id', Session::get('frontUser')->id)
        ->when($service, function ($query, $service) {
            return $query->where('front_users.role', $service);
        })
        ->distinct()
        ->get();

        return view('user.family.reviews', $data);
    }

    public function transactions(){
        /*check user subscription status*/
        $subscription                           = new SubscriptionController();
        
        $frontUser                              = Session::get('frontUser');
        $frontUser['user_subscription_status']  = $subscription->check_subscription_status(Session::get('frontUser')->id);
        $frontUser['purchased_candidates']      = $this->get_purchased_candidates(Session::get('frontUser')->id);
        
        Session::put('frontUser', $frontUser);

        $data['payments'] = UserSubscription::leftJoin('packages', 'user_subscriptions.package_id', '=', 'packages.id')
        ->select('user_subscriptions.*', 'packages.name', 'packages.price')
        ->where('user_subscriptions.status', 'active')
        ->where('user_id', Session::get('frontUser')->id)
        ->get()
        ->toArray();

        return view('user.family.transactions', $data);
    }
}
