<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PreviousExperience;
use App\NeedsBabysitter;
use App\FrontUser;


class CandidateController extends Controller{
    
    public function index(){
        //
    }

    public function create()
    {
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

    public function edit($id){
        $data['menu']                           = "edit candidate";
        $data['candidate']                      = FrontUser::findOrFail($id);
        $data['calender']                       = NeedsBabysitter::where('family_id', $id)->first();
        $data['previous_experience']            = PreviousExperience::where('candidate_id', $id)->get();
        $data['candidate']['other_services']    = !empty($data['candidate']->other_services) ? json_decode($data['candidate']->other_services) : array();
        $data['morning']                        = !empty($data['calender']->morning) ? json_decode($data['calender']->morning, true) : array();
        $data['afternoon']                      = !empty($data['calender']->afternoon) ? json_decode($data['calender']->afternoon, true) : array();
        $data['evening']                        = !empty($data['calender']->evening) ? json_decode($data['calender']->evening, true) : array();
        $data['night']                          = !empty($data['calender']->night) ? json_decode($data['calender']->night, true) : array();
        
        return view('candidate.edit', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'                  => 'required',
            'age'                   => 'required',
            'id_number'             => "required",
            'salary_expectation'    => "required",
        ]);


        $candidate              = FrontUser::findorFail($id);
        $input                  = $request->all();
        $input['password']      = !empty($request->password) ? Hash::make($request->password) : $candidate->password;
        $input['email']         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']          = $candidate->role;
        $input['profile']       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $candidate->profile;
        $input['other_services']= !empty($request->other_services) ? json_encode($request->other_services) : null;
        $experiance             = !empty($input['daterange']) ? $this->store_previous_experience($input, $id) : 0;
        $availability           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_candidate_calender($input, $id) : 0;
        $update_status          = $candidate->update($input);
        return redirect()->back()->with('success', 'candidate profile updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
