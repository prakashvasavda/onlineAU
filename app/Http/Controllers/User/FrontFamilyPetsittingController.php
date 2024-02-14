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
        $request->validate([
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
            'password' => [
                'required',
                'string',
                'min:8',                    // must be at least 10 characters in length
                'regex:/[a-z]/',            // must contain at least one lowercase letter
                'regex:/[A-Z]/',            // must contain at least one uppercase letter
                'regex:/[0-9]/',            // must contain at least one digit
                'regex:/[@$!%*#?&]/',       // must contain a special character
            ],
        ],[
            'password.required'                  => 'The password field is required.',
            'password.string'                    => 'The password must be a string.',
            'password.min'                       => 'The password must be at least 8 characters in length.',
            'password.regex'                     => 'The password must meet the following requirements: at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'pet_medication_specify.required_if' => "Specification field is required when you have selected yes on the above field.",
        ]);

        $input                  = $request->except('_method', '_token', 'morning', 'afternoon', 'evening', 'night');
        $input['profile']       = $request->hasFile('profile') ? $this->store_image($request->file('profile')) : null;
        $input['type_of_pet']   = isset($request->type_of_pet) ? json_encode($request->type_of_pet) : null;
        $input['how_many_pets'] = isset($request->how_many_pets) ? json_encode($request->how_many_pets) : null;
        $input['password']      = Hash::make($request->password);
        
        $input['status']        = 1;
        $input['role']          = 'family-petsitting';
        $input['created_at']    = date("Y-m-d H:i:s");
        $input['updated_at']    = date("Y-m-d H:i:s");

        $familyId   = FrontUser::insertGetId($input);

        $calender           = $request->only(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
        $this->calendarController->store_calender($calender, $familyId);

        /*redirect to payment packages*/
        $input['user_id']        = $familyId;
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
