<?php

namespace App\Http\Controllers;

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
        //
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
            'describe_kids'                 => "required|array",
            'family_types_babysitter'       => "required",
            'family_location'               => "required",
            'family_babysitter_comfortable' => "required",
            'family_profile_see'            => "required",
            'family_notifications'          => "required",
            'family_description'            => "required",
        ],[
            'profile.required_if'   => 'The profile field is required',
            'describe_kids.array'   =>  'Invalid selected value',   
        ]);

        $family                                 = FrontUser::findorFail($familyId);
        $input                                  = $request->all();
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']                         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']                          = $family->role;
        $input['family_special_need_option']    = isset($request->family_special_need_option) ? 1 : 0;
        $input['family_babysitter_comfortable'] = isset($request->family_babysitter_comfortable) ? json_encode($request->family_babysitter_comfortable) : null;
        $input['family_special_need_value']     = isset($request->family_special_need_value) ? json_encode($request->family_special_need_value) : null;
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
