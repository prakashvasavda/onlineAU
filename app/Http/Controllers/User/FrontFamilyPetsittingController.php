<?php

namespace App\Http\Controllers\User;

use App\Models\FrontUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CalendarController;


class FrontFamilyPetsittingController extends Controller{

    protected $calendarController;

    public function __construct(CalendarController $calendarController){
        $this->calendarController = $calendarController;
    }
 
    public function store(Request $request){
        $input                              = $request->all();

        $rules = [
            'name'                          => "required|max:50",
            'email'                         => 'required|email', //required|email|unique:front_users,email
            'family_address'                => "required|max:100",
            'cell_number'                   => "required|min:10|max:10|regex:/[0-9]{9}/",
            'start_date'                    => "required",
            'duration_needed'               => "required|numeric|gt:1|lt:24",
            'candidate_duties'              => "required|max:500",
            'surname'                       => "required|max:50",
            'id_number'                     => 'required' . ($request->type_of_id_number == 'south_african' ? '|numeric|digits:13' : ''),
            'type_of_id_number'             => "required",
            'number_of_pets'                => "required|lte:10",
            'pet_medication_or_disabilities'=> "required",
            'pet_medication_specify'        => "required_if:pet_medication_or_disabilities,==,yes|max:500",

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
            'password.required'                  => 'The password field is required.',
            'password.string'                    => 'The password must be a string.',
            'password.min'                       => 'The password must be at least 8 characters in length.',
            'password.regex'                     => 'The password must meet the following requirements: at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'pet_medication_specify.required_if' => "Specification field is required when you have selected yes on the above field.",
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
        }

        $validator = Validator::make($input, $rules, $message);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        $input                  = $request->except('_method', '_token', 'morning', 'afternoon', 'evening', 'night');
        $input['profile']       = $request->hasFile('profile') ? $this->store_image($request->file('profile')) : null;
        $input['type_of_pet']   = isset($request->type_of_pet) ? json_encode($request->type_of_pet) : null;
        $input['how_many_pets'] = isset($request->how_many_pets) ? json_encode($request->how_many_pets) : null;
        $input['password']      = Hash::make($request->password);
        
        $input['status']        = 1;
        $input['role']          = 'family-petsitting';
        $input['created_at']    = date("Y-m-d H:i:s");
        $input['updated_at']    = date("Y-m-d H:i:s");

        $family   = FrontUser::create($input);

        $calender           = $request->only(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
        $this->calendarController->store_calender($calender, $family->id);

        /*redirect to payment packages*/
        $input['user_id']        = $family->id;
        $input['profile']        = null;

        Session::put('guestUser', $input);
        return redirect()->to('packages');
    }

    public function update(Request $request, string $id){
        $family                  = FrontUser::find($id);
        $input                   = $request->all();
        $input['password']       = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']          = !empty($request->email) ? $request->email : $family->email;
        $input['role']           = $family->role;
        $input['profile']        = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $family->profile;
        $input['type_of_pet']    = isset($request->type_of_pet) ? json_encode($request->type_of_pet) : null;
        $input['how_many_pets']  = isset($request->how_many_pets) ? json_encode($request->how_many_pets) : null;
        $input['updated_at']     = date("Y-m-d H:i:s");

        /* store calender data */
        $calender           = $request->only(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
        $this->calendarController->store_calender($calender, $id);

        $update_status           = $family->update($input);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
