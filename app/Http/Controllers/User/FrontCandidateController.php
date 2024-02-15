<?php

namespace App\Http\Controllers\User;

use App\Models\Payment;
use App\Models\FrontUser;
use Illuminate\Support\Str;
use App\Models\FamilyReview;
use Illuminate\Http\Request;
use App\Models\CandidateReview;
use App\Models\NeedsBabysitter;
use App\Models\PreviousExperience;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\CandidateFavoriteFamily;
use App\Models\FamilyFavoriteCandidate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CalendarController;


class FrontCandidateController extends Controller{
    
    protected $calendarController;

    public function __construct(CalendarController $calendarController){
        $this->calendarController = $calendarController;
    }
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
        $data['candidate']                                      = FrontUser::with('calendars')->find($candidateId);
        $data['candidate']['other_services']                    = !empty($data['candidate']->other_services) ? json_decode($data['candidate']->other_services) : array();
        $data['previous_experience']                            = PreviousExperience::where('candidate_id', $candidateId)->get();   
        $data['candidate']['ages_of_children_you_worked_with']  = !empty($data['candidate']->ages_of_children_you_worked_with) ? json_decode($data['candidate']->ages_of_children_you_worked_with) : array();
        $data['candidate']['animals_comfortable_with']          = !empty($data['candidate']->animals_comfortable_with) ? json_decode($data['candidate']->animals_comfortable_with) : array();

        /* decode calender data */
        $calender           = $data['candidate']['calendars'];
        $data['calendars']  = $this->calendarController->decode_calender($calender);

        /* get candidate role profile page */
        $role               = strtolower(Session::get('frontUser')->role);
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
        $data       = $request->all();
        $candidate  = FrontUser::findorFail($candidateId);

        $rules = [
            'name'                         => "required|max:50",
            'age'                          => 'required|gt:18|lt:70',
            'email'                        => 'required|email', //required|email|unique:front_users,email
            'surname'                      => 'required|max:50',
            'contact_number'               => 'required|min:10|max:10|regex:/[0-9]{9}/',
            'area'                         => 'required|max:100',
            'id_number'                    => 'required' . ($request->type_of_id_number == 'south_african' ? '|numeric|digits:13' : ''),
            'type_of_id_number'            => "required",
            'profile'                      => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'ethnicity'                    => "required|regex:/^[\pL\s\-]+$/u|max:50",
            'gender'                       => "required",
            'home_language'                => "required",
            'disabilities'                 => "required|max:100",
            // 'heading.*'                    => 'required|max:255', 
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

        if(isset($candidate->role) && $candidate->role == "au-pairs"){
            $rules['marital_status']                    = 'required';
            $rules['dependants']                        = 'required';
            $rules['chronical_medication']              = "required";
            $rules['drivers_license']                   = "required";
            $rules['car_accident']                      = "required";
            $rules['vehicle']                           = "required";
            $rules['smoker_or_non_smoker']              = "required";
            $rules['live_in_or_live_out']               = "required";
            $rules['first_aid']                         = "required";
            $rules['experience_special_needs']          = "required";
            $rules['special_needs_specifications']      = "required_if:experience_special_needs,==,yes|max:500";
            $rules['about_yourself']                    = "required|max:500";
            $rules['ages_of_children_you_worked_with']  = "required";
            $rules['childcare_experience']              = "required";
            $rules['available_date']                    = "required";
            $rules['additional_language']               = "required";
            $rules['salary_expectation']                = "required|numeric|digits_between:2,10";
            $rules['hourly_rate_pay']                   = "required|numeric|digits_between:2,5";
            $rules['religion']                          = "required";
        }

        if(isset($candidate->role) && $candidate->role == "nannies"){
            $rules['additional_language']               = "required";
            $rules['south_african_citizen']             = "required";
            $rules['working_permit']                    = "required_if:south_african_citizen,==,no";
            $rules['first_aid']                         = "required";
            $rules['smoker_or_non_smoker']              = "required";
            $rules['comfortable_with_light_housework']  = "required";
            $rules['live_in_or_live_out']               = "required";
            $rules['marital_status']                    = 'required';
            $rules['dependants']                        = 'required';
            $rules['drivers_license']                   = "required";
            $rules['car_accident']                      = "required";
            $rules['vehicle']                           = "required";
            $rules['childcare_experience']              = "required";
            $rules['experience_special_needs']          = "required";
            $rules['special_needs_specifications']      = "required_if:experience_special_needs,==,yes|max:500";
            $rules['about_yourself']                    = "required|max:500";
            $rules['ages_of_children_you_worked_with']  = "required";
            $rules['available_date']                    = "required";
            $rules['salary_expectation']                = "required|numeric|digits_between:2,10";  
            $rules['chronical_medication']              = "required";
            $rules['hourly_rate_pay']                   = "required|numeric|digits_between:2,5";
            $rules['religion']                          = "required";
        }

        if(isset($candidate->role) && $candidate->role == "babysitters"){
            $rules['additional_language']               = "required";
            // $rules['south_african_citizen']             = "required";
            $rules['working_permit']                    = "required_if:south_african_citizen,==,no";
            $rules['first_aid']                         = "required";
            $rules['smoker_or_non_smoker']              = "required";
            // $rules['comfortable_with_light_housework']  = "required";
            // $rules['live_in_or_live_out']               = "required";
            $rules['marital_status']                    = 'required';
            $rules['dependants']                        = 'required';
            $rules['drivers_license']                   = "required";
            $rules['car_accident']                      = "required";
            $rules['vehicle']                           = "required";
            $rules['childcare_experience']              = "required";
            $rules['experience_special_needs']          = "required";
            // $rules['special_needs_specifications']      = "required_if:experience_special_needs,==,yes|max:500";
            $rules['about_yourself']                    = "required|max:500";
            $rules['ages_of_children_you_worked_with']  = "required";
            // $rules['available_date']                    = "required";
            $rules['chronical_medication']              = "required";
            $rules['hourly_rate_pay']                   = "required|numeric|digits_between:2,5";
            $rules['religion']                          = "required";
        }

        if(isset($candidate->role) && $candidate->role == "petsitters"){
            $rules['working_permit']                    = "required_if:south_african_citizen,==,no";
            $rules['smoker_or_non_smoker']              = "required";
            $rules['special_needs_specifications']      = "required_if:experience_special_needs,==,yes|max:500";
            $rules['about_yourself']                    = "required|max:500";
            $rules['salary_expectation']                = "required|numeric|digits_between:2,10";  
            $rules['situated']                          = "required|max:50";
            $rules['animals_comfortable_with']          = "required";
            $rules['experience_with_animals']           = "required";
            $rules['do_you_like_animals']               = "required";
            $rules['childcare_experience']              = "required";
        }

        $message = [
            'experience_with_animals'               => 'Please specify whether you have experience with animals',
            'heading.*.required'                    => 'The heading field is required.',
            'first_aid.required'                    => "Please specify whether you have first aid training.",
            'experience_special_needs.required'     => "Please indicate whether you have experience with special needs.",
            'live_in_or_live_out.required'          => "Please specify whether you prefer to live in or live out.",
            'smoker_or_non_smoker.required'         => "Please indicate whether you are a smoker or non-smoker",
            'drivers_license.required'              => "Please indicate whether you have a driver's license",
            'marital_status.required'               => "Please select your marital status",
            'dependants.required'                   => "Please indicate whether you have any dependants.",
            'chronical_medication.required'         => "Please specify whether you are currently on any chronic medication.",
            'car_accident.required'                 => "Please indicate whether you have ever been in a car accident",
            'vehicle.required'                      => "Please select whether you have your own vehicle.",
            'ethnicity.regex'                       => "The ethnicity field can only contain letters",
            'salary_expectation.required'           => 'The salary expectation field is required',
            'hourly_rate_pay.required'              => 'The hourly rate amount field is required',
            'password.required'                     => 'The password field is required.',
            'password.string'                       => 'The password must be a string.',
            'password.min'                          => 'The password must be at least 8 characters in length.',
            'password.regex'                        => 'The password must meet the following requirements: at least one lowercase letter, one uppercase letter, one digit, and one special character.',
        ];

        if(isset($candidate->role) && $candidate->role == "petsitters"){
            $message['childcare_experience.required'] = "The petsitting experience field is required";
        }

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }
        
        $candidate              = FrontUser::findorFail($candidateId);
        $input                  = $request->all();
        $input['password']      = !empty($request->password) ? Hash::make($request->password) : $candidate->password;
        $input['email']         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']          = $candidate->role;
        $input['profile']       = $request->hasFile('profile') ? $this->store_image($request->file('profile')) : $candidate->profile;
        $input['other_services']= !empty($request->other_services) ? json_encode($request->other_services) : null;
        $experiance             = !empty($input['daterange']) ? $this->store_previous_experience($input, $candidateId) : 0;
        $update_status          = $candidate->update($input);
        
        /* store calender data */
        $calender           = $request->only(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
        $this->calendarController->store_calender($calender, $candidateId);

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
        $data['candidate'] = FrontUser::with('calendars')->find(Session::get('frontUser')->id);
        $calender          = $data['candidate']['calendars'];
        $data['calendars'] = $this->calendarController->decode_calender($calender);
        return view('user.candidate.manage_calender', $data);
    }

    public function update_candidate_calender(Request $request, $candidateId){
        $input  = $request->all();
        $status = $this->calendarController->store_calender($input, $candidateId);
        return redirect()->back()->with($status > 0 ? 'success' : 'error', $status > 0 ? 'Candidate calendar has been updated successfully.' : 'Failed to update candidate\'s calendar.');
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
