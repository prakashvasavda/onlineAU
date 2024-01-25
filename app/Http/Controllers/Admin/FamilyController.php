<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\SubscriptionController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\CandidateFavoriteFamily;
use App\Models\FamilyFavoriteCandidate;
use App\Models\CandidateFavourite;
use App\Models\PreviousExperience;
use App\Models\NeedsBabysitter;
use App\Models\CandidateReview;
use App\Models\FamilyReview;
use App\Models\FrontUser;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use DataTables;



class FamilyController extends Controller{
    
    public function view_families(Request $request){
        $data['menu']   = "family";
                
        if($request->ajax()){
            $response = FrontUser::select('*')
                        ->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_created_at")
                        ->where('role', 'family')
                        ->get();

            return DataTables::of($response)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Edit Family" data-trigger="hover">
                                <a href="'.url('admin/edit-family/'.$row->id).'" class="btn btn-sm btn-primary edit-family" type="button" data-id="' . $row->id . '"><i class="fa fa-pen"></i></a>
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
                        return $payment_btn = '<span class="badge badge-dark">inactive</span>';
                    }elseif($payment_status == 'pending'){
                        return $payment_btn = '<span class="badge badge-danger">pending</span>';
                    }elseif($payment_status == 'expired'){
                        return $payment_btn = '<span class="badge badge-warning">expired</span>';
                    }else{
                        return $payment_btn = '<span class="badge badge-success">active</span>';
                    }
                })

                ->addColumn('user_status', function ($row) {
                    if($row->status == 1){
                        return $status_btn = '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" checked onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }else{
                        return $status_btn = '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }
                })
                ->rawColumns(['action','payment_status', 'user_status'])
                ->make(true);
        }

        return view('admin.family.index', $data);
    }

    public function edit_family($id){
        $data['menu']                                       = "family";
        $data['family']                                     = FrontUser::findOrFail($id);
        $data['family']['family_babysitter_comfortable']    = !empty($data['family']->family_babysitter_comfortable) ? json_decode($data['family']->family_babysitter_comfortable, true) : array();
        $data['family']['family_special_need_value']        = !empty($data['family']->family_special_need_value) ? json_decode($data['family']->family_special_need_value, true) : array();
        $data['family']['describe_kids']                    = !empty($data['family']->describe_kids) ? json_decode($data['family']->describe_kids): array();
        $data['family']['gender_of_children']               = !empty($data['family']->gender_of_children) ? json_decode($data['family']->gender_of_children, true) : array();
        $data['family']['what_do_you_need']                 = !empty($data['family']->what_do_you_need) ? json_decode($data['family']->what_do_you_need, true) : array();
        $data['availability']                               = NeedsBabysitter::where('family_id', $id)->first();
        $data['previous_experience']                        = PreviousExperience::where('candidate_id', $id)->get();
        $data['morning_availability']                       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']                     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']                       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']                         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        $data['family']['age']                              = !empty($data['family']->age) ? json_decode($data['family']->age, true) : array();
        return view('admin.family.edit', $data);
    }

    public function update_family(Request $request, $familyId){
        $request->validate([
            'name'                          => "required",
            'family_address'                => "required",
            'family_city'                   => "required",
            'home_language'                 => "required",
            'no_children'                   => "required",
            'family_notifications'          => "required",
            'surname'                       => "required",
            'cell_number'                   => 'required|min:10|max:10|regex:/[0-9]{9}/',
            'start_date'                    => "required",
            'duration_needed'               => "required|numeric|gt:1",
            'petrol_reimbursement'          => "required",
            'live_in_or_live_out'           => "required", 
            'candidate_duties'              => "required",
            'id_number'                     => 'required' . ($request->type_of_id_number == 'south_african' ? ' |numeric|digits:13' : ''),
            'type_of_id_number'             => "required",
            'email'                         => "required|email|unique:front_users,email," . $familyId,
            'profile'                       => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ],[
            'profile.required_if'           => 'The profile field is required',
            'describe_kids.array'           =>  'Invalid selected value',   
        ]);

        $family                                 = FrontUser::findorFail($familyId);
        $input                                  = $request->all();
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']                         = !empty($request->email) ? $request->email : $family->email;
        $input['role']                          = $family->role;
        $input['family_special_need_option']    = isset($request->family_special_need_option) && isset($request->family_special_need_value) ? 1 : 0;
        $input['family_babysitter_comfortable'] = isset($request->family_babysitter_comfortable)  ? json_encode($request->family_babysitter_comfortable) : null;
        $input['family_special_need_value']     = isset($request->family_special_need_value) && isset($request->family_special_need_option) ? json_encode($request->family_special_need_value) : null;
        $input['profile']                       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $family->profile;
        $input['no_children']                   = isset($request->age) && is_array($request->age) ? count($request->age) : $request->no_children;
        $input['describe_kids']                 = isset($request->describe_kids) ? json_encode($request->describe_kids) : null;
        $availability                           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_family_calender($input, $familyId) : 0;
        $input['gender_of_children']            = isset($request->gender_of_children) ? json_encode($request->gender_of_children) : null;
        $input['what_do_you_need']              = isset($request->what_do_you_need) ? json_encode($request->what_do_you_need) : null;
        $update_status                          = $family->update($input);

        return redirect()->back()->with('success', 'family profile updated successfully.');
    }


    public function delete_family(Request $request, $id){
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
