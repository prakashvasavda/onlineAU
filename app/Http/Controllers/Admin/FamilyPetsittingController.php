<?php

namespace App\Http\Controllers\Admin;

use App\Models\FrontUser;
use App\Models\FamilyReview;
use Illuminate\Http\Request;
use App\Models\CandidateReview;
use App\Models\NeedsBabysitter;
use Yajra\DataTables\DataTables;
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

class FamilyPetsittingController extends Controller{

    protected $calendarController;

    public function __construct(CalendarController $calendarController){
        $this->calendarController = $calendarController;
    }
    public function index(Request $request){
        $data['menu']   = "family petsitting";
       

        
        if($request->ajax()){
            $response  = FrontUser::select('*')->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_created_at")
                        ->where('front_users.role', 'family-petsitting')
                        ->get();

            return DataTables::of($response)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Edit Family" data-trigger="hover">
                                <a href="'.url('admin/family-petsitting/'.$row->id.'/edit').'" class="btn btn-sm btn-primary edit-family" type="button" data-id="' . $row->id . '"><i class="fa fa-pen"></i></a>
                            </span>';

                    $btn .= '<span data-toggle="tooltip" title="view subscriptions" data-trigger="hover">
                                <button class="btn btn-sm btn-info view subscriptions" type="button" data-id="' . $row->id . '" onclick="viewSubscriptions(' . $row->id . ', \'' . $row->role . '\')"><i class="fa fa-eye"></i></button>
                            </span>';


                    $btn .= '<span data-toggle="tooltip" title="Delete Family" data-trigger="hover">
                                <button class="btn btn-sm btn-danger delete-review" type="button" data-id="' . $row->id . '" onclick="deleteFamily(' . $row->id . ', \'' . $row->role . '\')"><i class="fa fa-trash"></i></button>
                            </span>';

                    return $btn;
                })

                ->addColumn('payment_status', function ($row) {
                    $subscription   = new SubscriptionController();
                    $payment_status = $subscription->check_subscription_status($row->id);
                    if($payment_status == 'inactive'){
                        return '<span class="badge badge-dark">inactive</span>';
                    }elseif($payment_status == 'pending'){
                        return '<span class="badge badge-danger">pending</span>';
                    }elseif($payment_status == 'expired'){
                        return '<span class="badge badge-warning">expired</span>';
                    }else{
                        return '<span class="badge badge-success">active</span>';
                    }
                })

                ->addColumn('user_status', function ($row) {
                    if($row->status == 1){
                        return '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" checked onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }else{
                        return '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }
                })
                ->rawColumns(['action', 'user_status', 'payment_status'])
                ->make(true);
        }

        return view('admin.family_petsitting.index', $data);   
    }

    public function edit(string $id){
        $data['menu']                                       = "family petsitting";
        $data['family']                                     = FrontUser::findOrFail($id);
        $data['availability']                               = NeedsBabysitter::where('family_id', $id)->first(); 
        $data['family']['type_of_pet']                      = !empty($data['family']->type_of_pet) ? json_decode($data['family']->type_of_pet, true) : array();
        $data['family']['how_many_pets']                    = !empty($data['family']->how_many_pets) ? json_decode($data['family']->how_many_pets, true) : array();
        
        /* decode calender data */
        $calender           = $data['family']['calendars'];
        $data['calendars']  = $this->calendarController->decode_calender($calender);

        return view('admin.family_petsitting.edit', $data);
    }

    public function update(Request $request, string $id){
        $input = $request->all();
        $rules =[
            'name'                          => "required|max:50",
            'email'                         => 'required|email', //required|email|unique:front_users,email
            'family_address'                => "required|max:100",
            'cell_number'                   => "required|min:10|max:10|regex:/[0-9]{9}/",
            'start_date'                    => "required",
            'duration_needed'               => "required|numeric|gte:1|lt:24",
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

        $message = [
            'password.string'                    => 'The password must be a string.',
            'password.min'                       => 'The password must be at least 8 characters in length.',
            'password.regex'                     => 'The password must meet the following requirements: at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'pet_medication_specify.required_if' => "Specification field is required when you have selected yes on the above field.",
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

        $validator = Validator::make($input, $rules, $message);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        $family                                 = FrontUser::find($id);
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']                         = !empty($request->email) ? $request->email : $family->email;
        $input['role']                          = $family->role;
        $input['profile']                       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $family->profile;
        $input['type_of_pet']                   = isset($request->type_of_pet) ? json_encode($request->type_of_pet) : null;
        $input['how_many_pets']                 = isset($request->how_many_pets) ? json_encode($request->how_many_pets) : null;
        
        /* store calender data */
        $calender           = $request->only(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
        $this->calendarController->store_calender($calender, $id);
        
        $update_status                          = $family->update($input);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function destroy(string $id){
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
