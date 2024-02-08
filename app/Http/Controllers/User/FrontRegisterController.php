<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\SubscriptionController;
use App\Models\FrontUser;
use App\Models\NeedsBabysitter;
use App\Models\PreviousExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Packages;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\CandidateRegistration;


class FrontRegisterController extends Controller{
    
    public function index($type){
        $data['type'] = $type == 'nannies' ? 'a nanny' : ($type == 'babysitters' ? 'a babysitter' : ($type == 'petsitters' ? 'A Petsitter' : 'an au-pair'));
        $registration_forms = [
            'au-pairs'              => 'user.registration_forms.au_pairs_form',
            'petsitters'            => 'user.registration_forms.petsitters_form',
            'nannies'               => 'user.registration_forms.nannies_form',
            'babysitters'           => 'user.registration_forms.babysitters_form'
        ];

        $service = strtolower($type);
        $view    = isset($registration_forms[$service]) ? $registration_forms[$service] : 'user.home';
        return view($view, $data);
    }

    public function store_candidate(Request $request){
        $data  = $request->all();
        
        $rules = [
            'name'                         => "required|max:50",
            'age'                          => 'required|gt:18|lt:70',
            'email'                        => 'required|email', //required|email|unique:front_users,email
            // 'hourly_rate_pay'              => 'required|numeric|digits_between:2,5',
            'terms_and_conditions'         => 'required',
            'surname'                      => 'required|max:50',
            'contact_number'               => 'required|min:10|max:10|regex:/[0-9]{9}/',
            'area'                         => 'required|max:100',
            'id_number'                    => 'required' . ($request->type_of_id_number == 'south_african' ? '|numeric|digits:13' : ''),
            'type_of_id_number'            => "required",
            'profile'                      => 'required|image|mimes:jpeg,jpg,png,gif',
            'ethnicity'                    => "required|regex:/^[\pL\s\-]+$/u|max:50",
            'gender'                       => "required",
            // 'religion'                     => "required", 
            'home_language'                => "required",
            'disabilities'                 => "required|max:100",
            // 'heading.*'                    => 'required|max:255', 
            'password' => [
                'required',
                'string',
                'min:8',                    // must be at least 10 characters in length
                'regex:/[a-z]/',            // must contain at least one lowercase letter
                'regex:/[A-Z]/',            // must contain at least one uppercase letter
                'regex:/[0-9]/',            // must contain at least one digit
                'regex:/[@$!%*#?&]/',       // must contain a special character
            ],
        ];

        if(isset($request->role) && $request->role == "au-pairs"){
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

        if(isset($request->role) && $request->role == "nannies"){
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

        if(isset($request->role) && $request->role == "babysitters"){
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

        if(isset($request->role) && $request->role == "petsitters"){
            $rules['working_permit']                    = "required_if:south_african_citizen,==,no";
            $rules['smoker_or_non_smoker']              = "required";
            $rules['special_needs_specifications']      = "required_if:experience_special_needs,==,yes|max:500";
            $rules['about_yourself']                    = "required|max:500";
            $rules['salary_expectation']                = "required|numeric|digits_between:2,10";  
            $rules['situated']                          = "required|max:50";
            $rules['animals_comfortable_with']          = "required";
            $rules['experience_with_animals']           = "required";
            $rules['do_you_like_animals']               = "required";
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

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        $candidateId = FrontUser::insertGetId([
            'name'                              => $request->name,
            'age'                               => $request->age,
            'profile'                           => $request->hasFile('profile') ? $this->store_image($request->file('profile')) : null,
            'id_number'                         => $request->id_number,
            'contact_number'                    => $request->contact_number,
            'email'                             => $request->email,
            'password'                          => Hash::make($request->password),
            'area'                              => $request->area,
            'gender'                            => $request->gender,
            'ethnicity'                         => $request->ethnicity,
            'religion'                          => $request->religion,
            'home_language'                     => $request->home_language,
            'additional_language'               => $request->additional_language,
            'disabilities'                      => $request->disabilities,
            'marital_status'                    => $request->marital_status,
            'dependants'                        => $request->dependants,
            'chronical_medication'              => $request->chronical_medication,
            'drivers_license'                   => $request->drivers_license,
            'vehicle'                           => $request->vehicle,
            'car_accident'                      => $request->car_accident,
            'childcare_experience'              => $request->childcare_experience,
            'experience_special_needs'          => $request->experience_special_needs,
            'salary_expectation'                => $request->salary_expectation,
            'available_day'                     => $request->available_day,
            'status'                            => 0,
            'role'                              => $request->role,
            "created_at"                        => date("Y-m-d H:i:s"),
            "updated_at"                        => date("Y-m-d H:i:s"),
            "south_african_citizen"             => isset($request->south_african_citizen) ? $request->south_african_citizen : null,
            "working_permit"                    => isset($request->working_permit) ? $request->working_permit : null,
            "first_aid"                         => isset($request->first_aid) ? $request->first_aid : null,
            "smoker_or_non_smoker"              => isset($request->smoker_or_non_smoker) ? $request->smoker_or_non_smoker : null,
            "available_date"                    => isset($request->available_date) ? $request->available_date : null,
            "about_yourself"                    => isset($request->about_yourself) ? $request->about_yourself : null,
            "comfortable_with_light_housework"  => isset($request->comfortable_with_light_housework) ? $request->comfortable_with_light_housework : null,
            "petrol_reimbursement"              => isset($request->petrol_reimbursement) ? $request->petrol_reimbursement : null,
            "experience_with_animals"           => isset($request->experience_with_animals) ? $request->experience_with_animals : null,
            "do_you_like_animals"               => isset($request->do_you_like_animals) ? $request->do_you_like_animals : null,
            "surname"                           => isset($request->surname) ? $request->surname : null,
            "terms_and_conditions"              => isset($request->terms_and_conditions) ? 1 : 0,
            "animals_comfortable_with"          => isset($request->animals_comfortable_with) ? json_encode($request->animals_comfortable_with) : null,
            "ages_of_children_you_worked_with"  => isset($request->ages_of_children_you_worked_with) ? json_encode($request->ages_of_children_you_worked_with) : null,
            "hourly_rate_pay"                   => isset($request->hourly_rate_pay) ? $request->hourly_rate_pay : null,
            "other_services"                    => isset($request->other_services) ? json_encode($request->other_services) : null,
            'situated'                          => isset($request->situated) ? $request->situated : null,
            'type_of_id_number'                 => $request->type_of_id_number,
        ]);

        foreach ($data['daterange'] as $key => $value) {
            PreviousExperience::insertGetId([
                'candidate_id' => $candidateId,
                'daterange'    => isset($value) ? $value : null,
                'heading'      => isset($data['heading'][$key]) ? $data['heading'][$key] : null,
                'description'  => isset($data['description'][$key]) ? $data['description'][$key] : null,
                'reference'    => isset($data['reference'][$key]) ? $data['reference'][$key] : null,
                'tel_number'   => isset($data['tel_number'][$key]) ? $data['tel_number'][$key] : null,
                "created_at"   => date("Y-m-d H:i:s"),
                "updated_at"   => date("Y-m-d H:i:s"),
            ]);
        }

        $status = $this->store_need_babysitter($data, $candidateId);
        Mail::to('info@onlineaupairs.co.za')->send(new CandidateRegistration($data));
        return redirect()->route('sign-up', ['service' => 'family']);
    }

    public function store_need_babysitter($input, $candidateId){
        $data['family_id'] = $candidateId;
        $data['morning']   = !empty($input['morning']) ? json_encode($input['morning']) : null;
        $data['afternoon'] = !empty($input['afternoon']) ? json_encode($input['afternoon']) : null;
        $data['evening']   = !empty($input['evening']) ? json_encode($input['evening']) : null;
        $data['night']     = !empty($input['night']) ? json_encode($input['night']) : null;
        return NeedsBabysitter::create($data);
    }

    public function family_register($service){
        $data['menu']       = "family registration";
        $data['packages']   = packages::all();
        return $service == "family" ? view('user.registration_forms.family_form', $data) : view('user.registration_forms.family_petsitting_form', $data); 
    }

    public function store_family(Request $request){
        $data  = $request->all();
        
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
            'duration_needed'               => "required|numeric|gt:1|lt:24",
            'petrol_reimbursement'          => "required",
            'candidate_duties'              => "required|max:500",
            'terms_and_conditions'          => "required",
            'surname'                       => "required|max:50",
            'live_in_or_live_out'           => "required",
            'type_of_id_number'             => "required",
            'profile'                       => "nullable|image|mimes:jpeg,jpg,png,gif",
            'gender_of_children'            => "required|array",
            'gender_of_children.*'          => "required|in:male,female",
            'what_do_you_need'              => ['required', 'array'],
            'family_description'            => "required|max:500",
            'hourly_rate_pay'               => "required|numeric|digits_between:2,5",
            'salary_expectation'            => "required|numeric|digits_between:2,10",
            'age'                           => "required|array",
            'age.*'                         => "required|in:0-12 months,1-3 years,4-7 years,8-13 years,13-16 years",
            'password' => [
                'required',
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
            'no_children'                   => 'The number of children field is required.',
            'password.required'             => 'The password field is required.',
            'password.string'               => 'The password must be a string.',
            'password.min'                  => 'The password must be at least 8 characters in length.',
            'password.regex'                => 'The password must meet the following requirements: at least one lowercase letter, one uppercase letter, one digit, and one special character.',
        ];

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }
        
        $familyId = FrontUser::insertGetId([
            'name'                          => $request->name,
            'age'                           => isset($request->age) ? json_encode($request->age) : null,
            'profile'                       => $request->hasFile('profile') ? $this->store_image($request->file('profile')) : null,
            'email'                         => $request->email,
            'password'                      => Hash::make($request->password),
            'family_address'                => $request->family_address,
            'family_city'                   => $request->family_city,
            'home_language'                 => $request->home_language,
            'no_children'                   => $request->no_children,
            'family_location'               => $request->family_location,
            'family_profile_see'            => $request->family_profile_see,
            'family_notifications'          => $request->family_notifications,
            'salary_expectation'            => $request->salary_expectation,
            'family_description'            => isset($request->family_description) ? $request->family_description : null,
            'family_special_need_option'    => isset($request->family_special_need_option) ? 1 : 0,
            'family_special_need_value'     => isset($request->family_special_need_option) ? json_encode($request->family_special_need_value) : null,
            'status'                        => 1,
            'role'                          => 'family',
            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
            "cell_number"                   => $request->cell_number,
            "start_date"                    => $request->start_date,
            "duration_needed"               => $request->duration_needed,
            "candidate_duties"              => $request->candidate_duties,
            "surname"                       => $request->surname,
            "what_do_you_need"              => json_encode($request->what_do_you_need),
            'petrol_reimbursement'          => $request->petrol_reimbursement,
            'id_number'                     => $request->id_number,
            'live_in_or_live_out'           => $request->live_in_or_live_out,
            'hourly_rate_pay'               => isset($request->hourly_rate_pay) ? $request->hourly_rate_pay : null,
            'type_of_id_number'             => $request->type_of_id_number,
        ]);

        $status              = $this->store_need_babysitter($data, $familyId);
        $package             = Packages::find($request->package);

        /*redirect to payment packages*/
        $data['user_id']        = $familyId;
        $data['profile']        = null;

        Session::put('guestUser', $data);
        return redirect()->to('packages');
    }
}
