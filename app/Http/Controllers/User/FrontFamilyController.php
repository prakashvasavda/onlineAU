<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Features;
use App\Models\Packages;
use App\Models\FrontUser;
use Illuminate\Support\Str;
use App\Models\FamilyReview;
use Illuminate\Http\Request;
use App\Models\CandidateReview;
use App\Models\NeedsBabysitter;
use App\Models\UserSubscription;
use App\Models\CandidateFavourite;
use App\Models\PreviousExperience;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\CandidateFavoriteFamily;
use App\Models\FamilyFavoriteCandidate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\User\SubscriptionController;


class FrontFamilyController extends Controller{

    protected $calendarController;

    public function __construct(CalendarController $calendarController){
        $this->calendarController = $calendarController;
    }

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
        $data['family']                                     = FrontUser::with('calendars')->find($familyId);
        $data['family']['family_babysitter_comfortable']    = !empty($data['family']->family_babysitter_comfortable) ? json_decode($data['family']->family_babysitter_comfortable, true) : array();
        $data['family']['family_special_need_value']        = !empty($data['family']->family_special_need_value) ? json_decode($data['family']->family_special_need_value, true) : array();
        $data['family']['describe_kids']                    = !empty($data['family']->describe_kids) ? json_decode($data['family']->describe_kids): array();
        $data['family']['gender_of_children']               = !empty($data['family']->gender_of_children) ? json_decode($data['family']->gender_of_children, true) : array();
        $data['family']['what_do_you_need']                 = !empty($data['family']->what_do_you_need) ? json_decode($data['family']->what_do_you_need, true) : array();
        $data['availability']                               = NeedsBabysitter::where('family_id', $familyId)->first();
        $data['previous_experience']                        = PreviousExperience::where('candidate_id', $familyId)->get();  
        $data['family']['age']                              = !empty($data['family']->age) ? json_decode($data['family']->age, true) : array();
        
        /*family pettisittimg*/ 
        $data['family']['type_of_pet']                      = !empty($data['family']->type_of_pet) ? json_decode($data['family']->type_of_pet, true) : array();
        $data['family']['how_many_pets']                    = !empty($data['family']->how_many_pets) ? json_decode($data['family']->how_many_pets, true) : array();

        /* decode calender data */
        $calender           = $data['family']['calendars'];
        $data['calendars']  = $this->calendarController->decode_calender($calender);

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
            /* monday */
            'monday.start_time.*'          => 'present|required_if:day_0,==,1|date_format:H:i|before:monday.end_time.*',
            'monday.end_time.*'            => 'present|required_if:day_0,==,1|date_format:H:i',
            /* tuesday */
            'tuesday.start_time.*'         => 'present|required_if:day_1,==,1|date_format:H:i|before:tuesday.end_time.*',
            'tuesday.end_time.*'           => 'present|required_if:day_1,==,1|date_format:H:i',
            /* wednesday */
            'wednesday.start_time.*'       => 'present|required_if:day_2,==,1|date_format:H:i|before:wednesday.end_time.*',
            'wednesday.end_time.*'         => 'present|required_if:day_2,==,1|date_format:H:i',
            /* thursday */
            'thursday.start_time.*'        => 'present|required_if:day_3,==,1|date_format:H:i|before:thursday.end_time.*',
            'thursday.end_time.*'          => 'present|required_if:day_3,==,1|date_format:H:i',
            /* friday */
            'friday.start_time.*'          => 'present|required_if:day_4,==,1|date_format:H:i|before:friday.end_time.*',
            'friday.end_time.*'            => 'present|required_if:day_4,==,1|date_format:H:i',
            /* saturday */
            'saturday.start_time.*'        => 'present|required_if:day_5,==,1|date_format:H:i|before:saturday.end_time.*',
            'saturday.end_time.*'          => 'present|required_if:day_5,==,1|date_format:H:i',
            /* sunday */
            'sunday.start_time.*'          => 'present|required_if:day_6,==,1|date_format:H:i|before:sunday.end_time.*',
            'sunday.end_time.*'            => 'present|required_if:day_6,==,1|date_format:H:i',

            /* one day from the calender is required */
            'day_0'                        => 'required_without_all:day_1,day_2,day_3,day_4,day_5,day_6', 
            'day_1'                        => 'required_without_all:day_0,day_2,day_3,day_4,day_5,day_6', 
            'day_2'                        => 'required_without_all:day_0,day_1,day_3,day_4,day_5,day_6',
            'day_3'                        => 'required_without_all:day_0,day_1,day_2,day_4,day_5,day_6',
            'day_4'                        => 'required_without_all:day_0,day_1,day_2,day_3,day_5,day_6',
            'day_5'                        => 'required_without_all:day_0,day_1,day_2,day_3,day_4,day_6',
            'day_6'                        => 'required_without_all:day_0,day_1,day_2,day_3,day_4,day_5',

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

        foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $key => $day){
            /* start times */
            $message[$day . '.start_time.*.present']       = 'Required field.';
            $message[$day . '.start_time.*.required_if']   = 'Required field.';
            $message[$day . '.start_time.*.date_format']   = 'Incorrect format.';
            $message[$day . '.start_time.*.before']        = 'Invalid time';
            /* end time */
            $message[$day . '.end_time.*.present']       = 'Required field.';
            $message[$day . '.end_time.*.required_if']   = 'Required field.';
            $message[$day . '.end_time.*.date_format']   = 'Incorrect format.';

            /* day validation */
            $message['day_' . $key .'.required_without_all']   = 'At least one day of the week in the calendar must be selected.';
        }

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

         /* store calender data */
         $calender           = $request->only(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
         $this->calendarController->store_calender($calender, $familyId);

        $update_status                          = $family->update($input);
        return redirect()->back()->with('success', 'profile updated successfully.');
    }

   
    public function manage_calender(Request $request){
        $data['candidate'] = FrontUser::with('calendars')->find(Session::get('frontUser')->id);
        $calender          = $data['candidate']['calendars'];
        $data['calendars'] = $this->calendarController->decode_calender($calender);
        return view('user.family.manage_calender', $data);
    }

    public function update_family_calender(Request $request, $familyId){
        $input  = $request->all();
        $status = $this->calendarController->store_calender($input, $familyId);
        return redirect()->back()->with($status > 0 ? 'success' : 'error', $status > 0 ? 'Family calendar has been updated successfully.' : 'Failed to update Family\'s calendar.');
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
        $data['menu']    = 'family detail';
        $data['family']  = FrontUser::with('calendars')
            ->where('id', $familyId)
            ->where('role', 'family')
            ->where('status', '1')
            ->first();
        
        /* decode calender data */
        $calender           = $data['family']['calendars'];
        $data['calendars']  = $this->calendarController->decode_calender($calender);

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
