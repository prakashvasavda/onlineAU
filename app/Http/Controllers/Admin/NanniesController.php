<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\PreviousExperience;
use App\Models\NeedsBabysitter;
use App\Models\FrontUser;
use Illuminate\Support\Facades\Session;
use DataTables;
use Mail;


class NanniesController extends Controller{
    
    public function view_nannies_candidates(Request $request){
        $data['menu']   = "nannies";
        $candidate      = FrontUser::where('role', 'nannies')->get();
        
        if($request->ajax()){
            return DataTables::of($candidate)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Edit Candidate" data-trigger="hover">
                                <a href="'.url('admin/candidates/edit-nannies/'.$row->id).'" class="btn btn-sm btn-primary edit-candidate" type="button" data-id="' . $row->id . '"><i class="fa fa-pen"></i></a>
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

        return view('admin.nannies.index', $data);
    }

    public function edit_nannies_candidate($id){
        $data['menu']                                           = "nannies";
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
        return view('admin.nannies.edit', $data);
    }

    public function update_nannies_candidate(Request $request, $id){
        $request->validate([
            'name'                  => 'required',
            'age'                   => 'required',
            'salary_expectation'    => "required",
            'surname'               => "required",
            'id_number'             => 'required' . ($request->type_of_id_number == 'south_african' ? ' |numeric|digits:13' : ''),
            'type_of_id_number'     => "required",
            'email'                 => "required|email|unique:front_users,email," . $id,
            'profile'               => 'nullable|image|mimes:jpeg,jpg,png,gif',
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

    public function delete_nannies_candidate($id){
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
