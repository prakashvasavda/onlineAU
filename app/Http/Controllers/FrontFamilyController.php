<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\CandidateFavourite;
use App\PreviousExperience;
use App\NeedsBabysitter;
use App\CandidateReview;
use App\FrontUser;
use Validator;
use Session;
use DB;

class FrontFamilyController extends Controller{

    public function family_detail($familyId){
        $data['menu']                       = 'family detail';
        $data['family']                     = FrontUser::where('id', $familyId)->where('role', 'family')->where('status', '1')->first();
        $data['availability']               = NeedsBabysitter::where('family_id', $familyId)->first(); //candidate availablity records
        $data['morning_availability']       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        
        $data['reviews'] = CandidateReview::select(['review_note', 'review_rating_count'])
            ->selectSub(function ($query) use ($familyId) {
                $query->selectRaw('COUNT(*)')
                    ->from('candidate_reviews')
                    ->where('candidate_id', $familyId);
            }, 'total_reviews')
            ->where('candidate_id', $familyId)
            ->where('candidate_role', 'family')
            ->latest('created_at')
            ->first();

        $data['loginUser'] = Session::has('frontUser') ? Session::get('frontUser') : null;
        $data['favourite'] = Session::has('frontUser') ? CandidateFavourite::where('candidate_id', $familyId)->where('saved_by_id',  $data['loginUser']->id)->first() : null;
        return view('user.family_detail', $data);
    }

    public function store_family_reviews(Request $request){
        if (!Session::has('frontUser')) {
            return redirect()->back()->with('error', 'You must be logged in to submit a review.');
        } 
         
        $request->validate([
            'review_rating_count'       => 'required',
            'review_note'               => 'required',
            'reviewer_id'               => 'required',
            'reviewer_role'             => 'required|not_in:family',
            'candidate_role'            => 'required',
        ]);

        $data              = $request->all();
        $data['date']      = date('Y-m-d');
        $review = CandidateReview::create($data);
        return redirect()->back()->with('success', 'Your review have been recorded successfully.');
    }

    public function store_family_favourite(Request $request){
        $request->validate([
            'candidate_id'          => 'required',
            'candidate_role'        => 'required',
            'saved_by_id'           => 'required',
            'saved_by_role'         => 'required|not_in:family',
        ]);

        $data           = $request->all();
        $data['date']   = date('Y-m-d');
        $favourite      = CandidateFavourite::where('saved_by_id', $data['saved_by_id'])->where('saved_by_role', $data['saved_by_role'])->where('candidate_id', $data['candidate_id'])->where('candidate_role', $data['candidate_role'])->first();
        if(!empty($favourite)){
            return response()->json(['message' => 'error'], 404);
        }
        
        $favourite = CandidateFavourite::create($data);
        return response()->json(['message' => 'success', 'favourite' => $favourite], 200);
    }

    public function edit_family($familyId){
        $data['menu']                                       = "manage profile";
        $data['family']                                     = FrontUser::findOrFail($familyId);
        $data['family']['family_babysitter_comfortable']    = !empty($data['family']->family_babysitter_comfortable) ? json_decode($data['family']->family_babysitter_comfortable, true) : array();
        $data['family']['family_special_need_value']        = !empty($data['family']->family_special_need_value) ? json_decode($data['family']->family_special_need_value, true) : array();
        $data['availability']                               = NeedsBabysitter::where('family_id', $familyId)->first();
        $data['previous_experience']                        = PreviousExperience::where('candidate_id', $familyId)->get();
        $data['morning_availability']                       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']                     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']                       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']                         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        return view('user.family_manage_profile', $data);
    }

    public function update_family(Request $request, $familyId){
        $request->validate([
            'name'                          => "required",
            'age'                           => "required",
            'profile'                       => "required_if:hidden_profile,false",
            'family_address'                => "required",
            'family_city'                   => "required",
            'home_language'                 => "required",
            'no_children'                   => "required",
            'describe_kids'                 => "required",
            'family_types_babysitter'       => "required",
            'family_location'               => "required",
            'family_babysitter_comfortable' => "required",
            'family_profile_see'            => "required",
            'family_notifications'          => "required",
            'family_description'            => "required",
        ],[
            'profile.required_if' => 'The profile field is required',
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
        $availability                           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_family_availability($input, $familyId) : 0;
        $update_status                          = $family->update($input);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function store_family_availability($input, $familyId){
        $family_availability = NeedsBabysitter::where('family_id', $familyId)->get()->toArray();
        if(isset($family_availability) && !empty($family_availability)){
          $delete_status = NeedsBabysitter::where('family_id', $familyId)->delete();
        }

        $data['family_id']      = $familyId;
        $data['morning']        = !empty($input['morning']) ? json_encode($input['morning']) : null;
        $data['afternoon']      = !empty($input['afternoon']) ? json_encode($input['afternoon']) : null;
        $data['evening']        = !empty($input['evening']) ? json_encode($input['evening']) : null;
        $data['night']          = !empty($input['night']) ? json_encode($input['night']) : null;
        $data['updated_at']     =  date("Y-m-d H:i:s");
        return NeedsBabysitter::create($data);
    }

    public function store_image($data, $path=null){
        $randomName = Str::random(20);
        $extension  = $data->getClientOriginalExtension();
        $imageName  = date('d-m-y') . '_' . $randomName . '.' . $extension;
        $path       = $data->storeAs('uploads', $imageName, 'public');
        return      $imageName;
    }

}
