<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\SubscriptionController;
use App\FrontUser;
use App\NeedsBabysitter;
use App\PreviousExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\FrontUserSubscription;
use App\Packages;
use Mail;
use Session;
use Validator;

class FrontRegisterController extends Controller
{
    public function index($type){
        $data['type'] = $type == 'nannies' ? 'a nanny' : ($type == 'babysitters' ? 'a babysitter' : ($type == 'petsitters' ? 'A Petsitter' : 'an au-pair'));

        if (session()->has('frontUser')) {
            return redirect()->route('home');
        }
        return view('user.candidate_register', $data);
    }

    public function store_candidate(Request $request){
        $data  = $request->all();
        $rules = [
            'name'               => "required",
            'age'                => "required",
            // 'profile'         => "required",
            'id_number'          => "required",
            // 'contact_number'  => "required",
            'email'              => "required|email|unique:front_users,email",
            'password'           => "required",
            // 'gender'          => "required",
            // 'marital_status'  => "required",
            // 'drivers_license' => "required",
            'salary_expectation' => "required",
            'morning.*'          => "required_without_all",
            'afternoon.*'        => "required",
            'evening.*'          => "required",
            'night.*'            => "required",
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
            'name'                     => $request->name,
            'age'                      => $request->age,
            'profile'                  => isset($imageName) ? $imageName : null,
            'id_number'                => $request->id_number,
            'contact_number'           => $request->contact_number,
            'email'                    => $request->email,
            'password'                 => Hash::make($request->password),
            'situated'                 => $request->situated,
            'area'                     => $request->area,
            'gender'                   => $request->gender,
            'ethnicity'                => $request->ethnicity,
            'religion'                 => $request->religion,
            'home_language'            => $request->home_language,
            'additional_language'      => $request->additional_language,
            'disabilities'             => $request->disabilities,
            'marital_status'           => $request->marital_status,
            'dependants'               => $request->dependants,
            'chronical_medication'     => $request->chronical_medication,
            'drivers_license'          => $request->drivers_license,
            'vehicle'                  => $request->vehicle,
            'car_accident'             => $request->car_accident,
            'childcare_experience'     => $request->childcare_experience,
            'experience_special_needs' => $request->experience_special_needs,
            'salary_expectation'       => $request->salary_expectation,
            'available_day'            => $request->available_day,
            'status'                   => 0,
            'role'                     => $request->role,
            "created_at"               => date("Y-m-d H:i:s"),
            "updated_at"               => date("Y-m-d H:i:s"),
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
        $message = '<p>Hello Admin,</p>
            <p>New Candidate Registration, Please check below detail and then make status action on the admin side. .</p>
            <p>Name: ' . $request->name . '</p>
            <p>Email: ' . $request->email . '</p>';
        $emailTo = 'prakash.v.php@gmail.com';
        $name    = 'Admin';
        Mail::send([], [], function ($mail) use ($message, $emailTo, $name) {
            $mail->to($emailTo, $name)->subject('New Candidate Registration')->setBody($message, 'text/html');
            $mail->from('info@onlineaupair.Co.Za', 'Onlineaupair');
        });

        return redirect()->route('families');
    }

    public function store_need_babysitter($input, $candidateId){
        $data['family_id'] = $candidateId;
        $data['morning']   = !empty($input['morning']) ? json_encode($input['morning']) : null;
        $data['afternoon'] = !empty($input['afternoon']) ? json_encode($input['afternoon']) : null;
        $data['evening']   = !empty($input['evening']) ? json_encode($input['evening']) : null;
        $data['night']     = !empty($input['night']) ? json_encode($input['night']) : null;
        return NeedsBabysitter::create($data);
    }

    public function family_register(){
        $data['menu']       = "family registration";
        $data['packages']   = packages::all();
        return view('user.family_register', $data);
    }

    public function store_family(Request $request){
        $data  = $request->all();
        $rules = [
            'name'                          => "required",
            'age'                           => "required",
            'profile'                       => "required",
            'email'                         => "required|email|unique:front_users,email",
            'password'                      => "required",
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
            'package'                       => "required",
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
            'describe_kids.required'        => "The Describe kids must be required",
            'describe_kids.array'           => 'Invalid selected value.',
            'family_types_babysitter'       => "The Family types babysitter must be required",
            'family_location'               => "The Family location must be required",
            'family_babysitter_comfortable' => "The Family babysitter comfortable must be required",
            'family_profile_see'            => "The Family profile see must be required",
            'family_notifications'          => "The Family notifications must be required",
            'family_description'            => "The Family description must be required",
            'package'                       => "The payment plan is required",
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
            'describe_kids'                 => isset($request->describe_kids) ? json_encode($request->describe_kids) : null,
            'family_types_babysitter'       => $request->family_types_babysitter,
            'family_location'               => $request->family_location,
            'family_babysitter_comfortable' => isset($request->family_babysitter_comfortable) ? json_encode($request->family_babysitter_comfortable) : null,
            'family_profile_see'            => $request->family_profile_see,
            'family_notifications'          => $request->family_notifications,
            'salary_expectation'            => $request->salary_expectation,
            'family_description'            => $request->family_description,
            'family_special_need_option'    => isset($request->family_special_need_option) ? 1 : 0,
            'family_special_need_value'     => json_encode($request->family_special_need_value),
            'status'                        => 1,
            'role'                          => 'family',
            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);

        $status              = $this->store_need_babysitter($data, $familyId);
        $package             = Packages::find($request->package);
        $mail_sent_status    = $this->send_notification_email($request->all(), 'family');

        /*User subscription*/
        $subscription              = new SubscriptionController();
        return $user_subscription  = $subscription->store_user_subscription($data, $familyId);
        
        /*payment details*/
        $data['amount']         = $package->price;
        $data['item_name']      = $package->name;
        $data['custom_int1']    = $familyId;
        $data['custom_int2']    = $user_subscription->id;
        $data['profile']        = null;

        /*redirect to payment api*/
        return redirect()->route('payment-process')->with(['guestUser' => $data]);
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
