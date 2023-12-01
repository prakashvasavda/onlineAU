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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class FrontRegisterController extends Controller{
    
    public function index($type){
        $data['type'] = $type == 'nannies' ? 'a nanny' : ($type == 'babysitters' ? 'a babysitter' : ($type == 'petsitters' ? 'A Petsitter' : 'an au-pair'));

        if (session()->has('frontUser')) {
            return redirect()->route('home');
        }

        switch ($type) {
            case "au-pairs":
                return view('user.registration_forms.au_pairs_form', $data);
            case "petsitters":
                return view('user.registration_forms.petsitters_form', $data);
            case "nannies":
                return view('user.registration_forms.nannies_form', $data);
            default:
                return view('user.registration_forms.babysitters_form', $data);
        }
    }

    public function store_candidate(Request $request){
        $data  = $request->all();
        $rules = [
            'name'                                  => 'required',
            'age'                                   => 'required',
            'password'                              => "required",
            'id_number'                             => 'required',
            // 'contact_number'                        => 'required',
            'email'                                 => 'required|email|unique:front_users,email',
            // 'area'                                  => 'required',
            // 'gender'                                => 'required',
            // 'ethnicity'                             => 'required',
            // 'religion'                              => 'required',
            // 'additional_language'                   => 'required',
            // 'disabilities'                          => 'required',
            // 'marital_status'                        => 'required',
            // 'dependants'                            => 'required',
            // 'chronical_medication'                  => 'required',
            // 'drivers_license'                       => 'required',
            // 'vehicle'                               => 'required',
            // 'car_accident'                          => 'required',
            // 'childcare_experience'                  => 'required',
            // 'special_needs_specifications'          => 'required',
            // 'ages_of_children_you_worked_with.*'    => 'required',
            // 'first_aid'                             => 'required',
            // 'smoker_or_non_smoker'                  => 'required',
            // 'available_date'                        => 'required',
            // 'about_yourself'                        => 'required',
            // 'daterange.*'                           => 'required',
            // 'heading.*'                             => 'required',
            // 'description.*'                         => 'required',
            // 'reference.*'                           => 'required',
            // 'tel_number.*'                          => 'required',
            'salary_expectation'                    => 'required',
            // 'morning.*'                             => 'required_without_all:afternoon.*,evening.*,night.*',
            // 'afternoon.*'                           => 'required',
            // 'evening.*'                             => 'required',
            // 'night.*'                               => 'required',
            

            'terms_and_conditions'                      => 'required',
            'surname'                                   => 'required',


            // 'south_african_citizen'                  => 'required',
            // 'working_permit'                         => 'required',
            // 'ages_of_children_you_worked_with.*'     => 'required',
            // 'first_aid'                              => 'required',
            // 'smoker_or_non_smoker'                   => 'required',
            // 'available_date'                         => 'required',
            // 'about_yourself'                         => 'required',
            // 'comfortable_with_light_housework'       => 'required',
            // 'dependants'                             => 'required',
            // 'experience_special_needs'               => 'required',

           
            // 'home_language'                             => 'required',
            // 'petrol_reimbursement'                      => 'required',
            // 'experience_with_animals'                   => 'required',
            // 'do_you_like_animals'                       => 'required',
        ];


        $message = [
            'name'               => 'The Name field isrequired',
            'age'                => 'The Age field is required',
            // 'profile'            => 'The Profile must be required',
            'id_number'          => 'The Id Number field is required',
            // 'contact_number'  => 'The Contact Number must be required',
            'email'              => 'The Email field is required',
            'password'           => 'The Password field is required',
            // 'gender'          => 'The Gender must be required',
            // 'marital_status'  => 'The Marital Status must be required',
            // 'drivers_license' => 'The Drivers License must be required',
            'salary_expectation' => 'The salary expectation is required',
            'morning.*'          => 'The morning hours are required',
            'afternoon.*'        => 'The afternoon hours are required',
            'evening.*'          => 'The evening hours are required',
            'night.*'            => 'The night hours are required',
        ];
        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        if($request->hasFile('profile') && !empty($request->file('profile'))){
            $randomName = Str::random(20);
            $extension  = $request->file('profile')->getClientOriginalExtension();
            $imageName  = date('d-m-y') . '_' . $randomName . '.' . $extension;
            $path       = $request->file('profile')->storeAs('uploads', $imageName, 'public');
        }

       
        $candidateId = FrontUser::insertGetId([
            'name'                              => $request->name,
            'age'                               => $request->age,
            'profile'                           => isset($imageName) ? $imageName : null,
            'id_number'                         => $request->id_number,
            'contact_number'                    => $request->contact_number,
            'email'                             => $request->email,
            'password'                          => Hash::make($request->password),
            // 'situated'                       => $request->situated,
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

        ]);

        foreach ($data['daterange'] as $key => $value) {
            PreviousExperience::insertGetId([
                'candidate_id' => $candidateId,
                'daterange'    => $value,
                'heading'      => $data['heading'][$key],
                'description'  => $data['description'][$key],
                'reference'    => $data['reference'][$key],
                'tel_number'   => $data['tel_number'][$key],
                "created_at"   => date("Y-m-d H:i:s"),
                "updated_at"   => date("Y-m-d H:i:s"),
            ]);
        }

        $status = $this->store_need_babysitter($data, $candidateId);

        config(['mail.mailers.smtp.host' => 'smtp.gmail.com']);
        config(['mail.mailers.smtp.port' => '587']);
        config(['mail.mailers.smtp.username' => 'prakash.v.php@gmail.com']);
        config(['mail.mailers.smtp.password' => 'rqjmelerlcsuycnp']);
        config(['mail.mailers.smtp.encryption' => 'tls']);
        // $message = '<p>Hello Admin,</p>
        //     <p>New Candidate Registration, Please check below detail and then make status action on the admin side. .</p>
        //     <p>Name: ' . $request->name . '</p>
        //     <p>Email: ' . $request->email . '</p>';
        // $emailTo = 'prakash.v.php@gmail.com';
        // $name    = 'Admin';
        // Mail::send([], [], function ($mail) use ($message, $emailTo, $name) {
        //     $mail->to($emailTo, $name)->subject('New Candidate Registration')->setBody($message, 'text/html');
        //     $mail->from('info@onlineaupair.Co.Za', 'Onlineaupair');
        // });

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
            'name'                          => "required",
            'age'                           => "required",
            'email'                         => "required|email|unique:front_users,email",
            'password'                      => "required",
            'family_address'                => "required",
            'family_city'                   => "required",
            'home_language'                 => "required",
            'no_children'                   => "required",
            'family_notifications'          => "required",
            'cell_number'                   => "required",
            'id_number'                     => "required",
            'start_date'                    => "required",
            'duration_needed'               => "required",
            'petrol_reimbursement'          => "required",
            'candidate_duties'              => "required",
            'terms_and_conditions'          => "required",
            'surname'                       => "required",
        ];
        $message = [
            'name'                          => "The Name must be required",
            'age'                           => "The Age must be required",
            'profile'                       => "The Profile must be required",
            'email'                         => "The Email must be required",
            'password'                      => "The Password must be required",
            'family_address'                => "The Family address must be required",
            'family_city'                   => "The Family city must be required",
            'home_language'                 => "The Home language must be required",
            'no_children'                   => "The No children must be required",
            'family_types_babysitter'       => "The Family types babysitter must be required",
            'family_notifications'          => "The Family notifications must be required",
        ];

        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        if($request->hasFile('profile') && !empty($request->file('profile'))){
            $randomName = Str::random(20);
            $extension  = $request->file('profile')->getClientOriginalExtension();
            $imageName  = date('d-m-y') . '_' . $randomName . '.' . $extension;
            $path       = $request->file('profile')->storeAs('uploads', $imageName, 'public');
        }

        
        $familyId = FrontUser::insertGetId([
            'name'                          => $request->name,
            'age'                           => isset($request->age) ? json_encode($request->age) : null,
            'profile'                       => isset($imageName) ? $imageName : null,
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
        ]);

        $status              = $this->store_need_babysitter($data, $familyId);
        $package             = Packages::find($request->package);
        //$mail_sent_status  = $this->send_notification_email($request->all(), 'family');

        $data['user_id']        = $familyId;
        $data['profile']        = null;

         /*redirect to payment packages*/
        Session::put('guestUser', $data);
        return redirect()->to('packages');
    }

    public function send_notification_email($data, $role){
        config(['mail.mailers.smtp.host' => 'smtp.gmail.com']);
        config(['mail.mailers.smtp.port' => '587']);
        config(['mail.mailers.smtp.username' => 'prakash.v.php@gmail.com']);
        config(['mail.mailers.smtp.password' => 'rqjmelerlcsuycnp']);
        config(['mail.mailers.smtp.encryption' => 'tls']);
        $message = '<p>Hello Admin,</p>
            <p>New'.$role.'Registration, Please check below detail and then make status action on the admin side. .</p>
            <p>Name: ' . $data['name']. '</p>
            <p>Email: ' . $data['email'] . '</p>';
        $emailTo = 'prakash.v.php@gmail.com';
        $name    = 'Admin';
        Mail::send([], [], function ($mail) use ($message, $emailTo, $name) {
            $mail->to($emailTo, $name)->subject('New Candidate Registration')->setBody($message, 'text/html');
            $mail->from('info@onlineaupair.Co.Za', 'Onlineaupair');
        });
    }
}
