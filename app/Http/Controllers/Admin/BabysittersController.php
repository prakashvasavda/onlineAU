<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\Models\FrontUser;
use Illuminate\Http\Request;
use App\Models\NeedsBabysitter;
use Yajra\DataTables\DataTables;
use App\Models\PreviousExperience;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CalendarController;

class BabysittersController extends Controller{

    protected $calendarController;

    public function __construct(CalendarController $calendarController){
        $this->calendarController = $calendarController;
    }
    
    public function view_babysitters_candidates(Request $request){
        $data['menu']   = "babysitters";
        $aupairs        = FrontUser::where('role', 'babysitters')->get();
        
        if($request->ajax()){
            return DataTables::of($aupairs)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Edit Candidate" data-trigger="hover">
                                <a href="'.url('admin/candidates/edit-babysitters/'.$row->id).'" class="btn btn-sm btn-primary edit-candidate" type="button" data-id="' . $row->id . '"><i class="fa fa-pen"></i></a>
                            </span>';

                    $btn .= '<span data-toggle="tooltip" title="Delete Candidate" data-trigger="hover">
                                <button class="btn btn-sm btn-danger delete-candidate" type="button" data-id="' . $row->id . '" onclick="deleteCandidate(' . $row->id . ', \'' . $row->role . '\')"><i class="fa fa-trash"></i></button>
                            </span>';

                    return $btn;
                })
                ->addColumn('status', function ($row) {
                    if($row->status == 1){
                        return $status_btn = '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" checked onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }else{
                        return $status_btn = '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('admin.babysitters.index', $data);
    }

    public function edit_babysitters_candidate($id){
        $data['menu']                                           = "babysitters";
        $data['candidate']                                      = FrontUser::with('calendars')->find($id);
        $data['calender']                                       = NeedsBabysitter::where('family_id', $id)->first();
        $data['candidate']['ages_of_children_you_worked_with']  = !empty($data['candidate']->ages_of_children_you_worked_with) ? json_decode($data['candidate']->ages_of_children_you_worked_with) : array();
        $data['candidate']['animals_comfortable_with']          = !empty($data['candidate']->animals_comfortable_with) ? json_decode($data['candidate']->animals_comfortable_with) : array();
        $data['previous_experience']                            = PreviousExperience::where('candidate_id', $id)->get();
        $data['candidate']['other_services']                    = !empty($data['candidate']->other_services) ? json_decode($data['candidate']->other_services) : array();
       
        /* decode calender data */
        $calender           = $data['candidate']['calendars'];
        $data['calendars']  = $this->calendarController->decode_calender($calender);
        
        return view('admin.babysitters.edit', $data);
    }

    public function update_babysitters_candidate(Request $request, $id){
        $data       = $request->all();
        $candidate  = FrontUser::findorFail($id);

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
            'heading.*'                    => 'required|max:255',
            'daterange.*'                  => 'required', 
            'description.*'                => 'required|max:255',
            'reference.*'                  => 'required|max:255',
            'tel_number.*'                 => 'required|max:255',
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
            
            /* passowrd validation */
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

        $message = [
            'heading.*.required'                    => 'The heading field is required.',
            'daterange.*.required'                  => 'The daterange field is required.',
            'description.*.required'                => 'The description field is required.',
            'reference.*.required'                  => 'The reference field is required.',
            'tel_number.*.required'                 => 'The telephone number field is required.',
            'experience_with_animals'               => 'Please specify whether you have experience with animals',
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

        foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $key => $day){
            /* start times */
            $message[$day . '.start_time.*.present']       = 'The start time is required on ' . ucfirst($day) . '.';
            $message[$day . '.start_time.*.required_if']   = 'The start time is required on ' . ucfirst($day) . '.';
            $message[$day . '.start_time.*.date_format']   = 'The start time on ' . ucfirst($day) . ' should be in the correct format (H:i).';
            $message[$day . '.start_time.*.before']        = 'The start time on ' . ucfirst($day) . ' must be before the end time.';
            
            /* end time */
            $message[$day . '.end_time.*.present']         = 'The end time is required on ' . ucfirst($day) . '.';
            $message[$day . '.end_time.*.required_if']     = 'The end time is required on ' . ucfirst($day) . '.';
            $message[$day . '.end_time.*.date_format']     = 'The end time on ' . ucfirst($day) . ' should be in the correct format (H:i).';
            
            $message['day_' . $key .'.required_without_all']   = 'At least one day of the week in the calendar must be selected.';

        }

        $validator = Validator::make($data, $rules, $message);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        $input                                  = $request->all();
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $candidate->password;
        $input['email']                         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']                          = $candidate->role;
        $input['profile']                       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $candidate->profile;
        $input['other_services']                = !empty($request->other_services) ? json_encode($request->other_services) : null;
        $input['animals_comfortable_with']      = !empty($request->animals_comfortable_with) ? json_encode($request->animals_comfortable_with) : null;
        $experiance             = !empty($input['daterange']) ? $this->store_previous_experience($input, $id) : 0;
        $update_status          = $candidate->update($input);
        
        /* store calender data */
        $calender           = $request->only(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
        $this->calendarController->store_calender($calender, $id);
        
        return redirect()->back()->with('success', 'candidate profile updated successfully.');
    }

    public function delete_babysitters_candidate($id){
        $frontUser = FrontUser::find($id);

        if(empty($frontUser)){
            return response()->json(['message' => 'record not found', 'status' => 404], 404);
        }

        $frontUser->delete();
        $response = [
            'status'  => 200,
            'message' => 'record deleted successfully',
        ];

        return response()->json($response, 200);
    }
}
