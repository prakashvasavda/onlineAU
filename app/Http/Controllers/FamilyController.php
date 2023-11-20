<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\CandidateFavoriteFamily;
use App\FamilyFavoriteCandidate;
use App\CandidateFavourite;
use App\PreviousExperience;
use App\NeedsBabysitter;
use App\CandidateReview;
use App\FamilyReview;
use App\FrontUser;
use Validator;
use Session;
use DB;

class FamilyController extends Controller
{
    
    public function index(){
        return view('family.index');
    }

    public function get_families(Request $request){
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list        = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'contact_number',
            4 => 'gender',
            5 => 'age',
            6 => 'area',
            7 => 'id',
        ];

        $totalDataRecord = FrontUser::where('role', '=', 'family')->count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $post_data = FrontUser::where('role', '=', 'family')->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = FrontUser::where('role', '=', 'family')->orWhere('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->orWhere('surname', 'LIKE', "%{$search_text}%")
                ->orWhere('id_number', 'LIKE', "%{$search_text}%")
                ->orWhere('contact_number', 'LIKE', "%{$search_text}%")
                ->orWhere('email', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
            $totalFilteredRecord = FrontUser::where('role', '=', 'family')->orWhere('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->count();
        }

        $data_val = [];
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['DT_RowId']       = $post_val->id;
                $postnestedData['id']             = $key + 1;
                $postnestedData['name']           = $post_val->name;
                $postnestedData['email']          = $post_val->email;
                $postnestedData['cell_number']    = $post_val->cell_number;
                $postnestedData['gender']         = $post_val->gender;
                $postnestedData['age']            = $post_val->age;
                $postnestedData['area']           = $post_val->area;
                $url                              = url('admin/view_families/' . $post_val->id);
                $edit_url                         = url('admin/edit-family/' . $post_val->id);
                $postnestedData['options']        = "   <a href='" . $url . "' title='View' class='btn btn-info btn-sm d-none'><i class='fas fa-eye'></i></a> 
                                                        <a title='Delete' href='javascript:void(0)' class='btn btn-danger btn-sm' onClick='removeFamilies(" . $post_val->id . ")'><i class='fas fa-trash'></i></a>
                                                        <a href='" . $edit_url . "' title='Edit' class='btn btn-primary btn-sm'><i class='fa fa-edit'></i></a> 
                                                    ";
                $data_val[]                       = $postnestedData;

            }
        }
        $draw_val      = $request->input('draw');
        $get_json_data = [
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val,
        ];

        echo json_encode($get_json_data);
    }

    
    public function create(){
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($familyId){
        $data['menu']                                       = "edit family";
        $data['family']                                     = FrontUser::findOrFail($familyId);
        $data['family']['family_babysitter_comfortable']    = !empty($data['family']->family_babysitter_comfortable) ? json_decode($data['family']->family_babysitter_comfortable, true) : array();
        $data['family']['family_special_need_value']        = !empty($data['family']->family_special_need_value) ? json_decode($data['family']->family_special_need_value, true) : array();
        $data['family']['describe_kids']                    = !empty($data['family']->describe_kids) ? json_decode($data['family']->describe_kids): array();
        $data['family']['gender_of_children']               = !empty($data['family']->gender_of_children) ? json_decode($data['family']->gender_of_children, true) : array();
        $data['family']['what_do_you_need']                 = !empty($data['family']->what_do_you_need) ? json_decode($data['family']->what_do_you_need, true) : array();
        $data['availability']                               = NeedsBabysitter::where('family_id', $familyId)->first();
        $data['previous_experience']                        = PreviousExperience::where('candidate_id', $familyId)->get();
        $data['morning_availability']                       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']                     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']                       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']                         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        $data['family']['age']                              = !empty($data['family']->age) ? json_decode($data['family']->age, true) : array();
        return view('family.edit', $data);
    }

   
    public function update(Request $request, $familyId){
        $request->validate([
            'name'                          => "required",
            'age'                           => "required",
            'profile'                       => "required_if:hidden_profile,false",
            'family_address'                => "required",
            'family_city'                   => "required",
            'home_language'                 => "required",
            'no_children'                   => "required",
            // 'family_types_babysitter'       => "required",
            'family_location'               => "required",
            'family_profile_see'            => "required",
            'family_notifications'          => "required",
            'family_description'            => "required",

            'surname'                       => "required",
            'id_number'                     => "required",
            'cell_number'                   => "required",
            'what_do_you_need'              => "required",
            'start_date'                    => "required",
            'duration_needed'               => "required",
            'petrol_reimbursement'          => "required",
            'live_in_or_live_out'           => "required",
            'candidate_duties'              => "required",
            // 'describe_kids'                 => "required",
            // 'family_babysitter_comfortable' => "required",
        ],[
            'profile.required_if'   => 'The profile field is required',
            'describe_kids.array'   =>  'Invalid selected value',   
        ]);

        $family                                 = FrontUser::findorFail($familyId);
        $input                                  = $request->all();
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']                         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']                          = $family->role;
        $input['family_special_need_option']    = isset($request->family_special_need_option) && isset($request->family_special_need_value) ? 1 : 0;
        $input['family_babysitter_comfortable'] = isset($request->family_babysitter_comfortable)  ? json_encode($request->family_babysitter_comfortable) : null;
        $input['family_special_need_value']     = isset($request->family_special_need_value) && isset($request->family_special_need_option) ? json_encode($request->family_special_need_value) : null;
        $input['profile']                       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $family->profile;
        $input['no_children']                   = isset($request->age) && is_array($request->age) ? count($request->age) : $request->no_children;
        $input['describe_kids']                 = isset($request->describe_kids) ? json_encode($request->describe_kids) : null;
        $availability                           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_family_calender($input, $familyId) : 0;
        $update_status                          = $family->update($input);

        return redirect()->back()->with('success', 'family profile updated successfully.');
    }

    
    public function destroy($id)
    {
        //
    }
}
