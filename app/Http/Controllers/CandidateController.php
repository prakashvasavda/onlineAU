<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\PreviousExperience;
use App\NeedsBabysitter;
use App\FrontUser;
use Session;
use Mail;



class CandidateController extends Controller{
    
    public function index(){
        $data['menu'] = "candidates";
        return view('candidate.index', $data);
    }

    public function get_candidates(Request $request){
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list        = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'contact_number',
            4 => 'gender',
            5 => 'age',
            6 => 'area',
            7 => 'role',
            8 => 'status',
            9 => 'id',
        ];

        $totalDataRecord = FrontUser::where('role', '!=', 'family')->count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $post_data = FrontUser::where('role', '!=', 'family')->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = FrontUser::where('role', '!=', 'family')->orWhere('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->orWhere('surname', 'LIKE', "%{$search_text}%")
                ->orWhere('id_number', 'LIKE', "%{$search_text}%")
                ->orWhere('contact_number', 'LIKE', "%{$search_text}%")
                ->orWhere('email', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
            $totalFilteredRecord = FrontUser::where('role', '!=', 'family')->orWhere('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->count();
        }

        $data_val = [];
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                if ($post_val->status == 0) {
                    $status = '<input type="checkbox" class="statusChanged" name="status" value="' . $post_val->id . '" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                } else {
                    $status = '<input type="checkbox" class="statusChanged" name="status" value="' . $post_val->id . '" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                }

                $postnestedData['DT_RowId']       = $post_val->id;
                $postnestedData['id']             = $key + 1;
                $postnestedData['name']           = $post_val->name;
                $postnestedData['email']          = $post_val->email;
                $postnestedData['contact_number'] = $post_val->contact_number;
                $postnestedData['gender']         = $post_val->gender;
                $postnestedData['age']            = $post_val->age;
                $postnestedData['area']           = $post_val->area;
                $postnestedData['role']           = $post_val->role;
                $postnestedData['status']         = $status;
                $url                              = url('admin/view_candidates/' . $post_val->id);
                $edit_url                         = url('admin/edit-candidate/' . $post_val->id);
                $postnestedData['options']        = "   <a href='" . $url . "' title='View' class='btn btn-info btn-sm d-none'><i class='fas fa-eye'></i></a> 
                                                        <a title='Delete' href='javascript:void(0)' class='btn btn-danger btn-sm' onClick='removeCandidates(" . $post_val->id . ")'><i class='fas fa-trash'></i></a>
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
        
    }

    public function store(Request $request){
        
    }

   
    public function show($id){
        
    }

    public function edit($id){
        $data['menu']                                           = "edit candidate";
        $data['candidate']                                      = FrontUser::find($id);
        $data['calender']                                       = NeedsBabysitter::where('family_id', $id)->first();
        $data['candidate']['ages_of_children_you_worked_with']  = !empty($data['candidate']->ages_of_children_you_worked_with) ? json_decode($data['candidate']->ages_of_children_you_worked_with) : array();
        $data['candidate']['animals_comfortable_with']          = !empty($data['candidate']->animals_comfortable_with) ? json_decode($data['candidate']->animals_comfortable_with) : array();
        $data['previous_experience']                            = PreviousExperience::where('candidate_id', $id)->get();
        $data['candidate']['other_services']                    = !empty($data['candidate']->other_services) ? json_decode($data['candidate']->other_services) : array();
        $data['morning']                                        = !empty($data['calender']->morning) ? json_decode($data['calender']->morning, true) : array();
        $data['afternoon']                                      = !empty($data['calender']->afternoon) ? json_decode($data['calender']->afternoon, true) : array();
        $data['evening']                                        = !empty($data['calender']->evening) ? json_decode($data['calender']->evening, true) : array();
        $data['night']                                          = !empty($data['calender']->night) ? json_decode($data['calender']->night, true) : array();
        

        $role = strtolower($data['candidate']->role);
        
        $candidate_forms = [
            'au-pairs'      => 'candidate.aupairs_edit_form',
            'nannies'       => 'candidate.nannies_edit_form',
            'petsitters'    => 'candidate.petsitters_edit_form',
            'babysitters'   => 'candidate.babysitters_edit_form',
        ];

        $view = $candidate_forms[$role] ?? 'candidate.index';
        return view($view, $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'                  => 'required',
            'age'                   => 'required',
            'id_number'             => "required",
            'salary_expectation'    => "required",
            'surname'               => "required",
        ]);


        $candidate                              = FrontUser::findorFail($id);
        $input                                  = $request->all();
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $candidate->password;
        $input['email']                         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']                          = $candidate->role;
        $input['profile']                       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $candidate->profile;
        $input['other_services']                = !empty($request->other_services) ? json_encode($request->other_services) : null;
        $input['animals_comfortable_with']      = !empty($request->animals_comfortable_with) ? json_encode($request->animals_comfortable_with) : null;
        $experiance             = !empty($input['daterange']) ? $this->store_previous_experience($input, $id) : 0;
        $availability           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_candidate_calender($input, $id) : 0;
        $update_status          = $candidate->update($input);
        return redirect()->back()->with('success', 'candidate profile updated successfully.');
    }

    public function destroy($id){
        
    }
}
