<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\CandidateFavoriteFamily;
use App\FamilyFavoriteCandidate;
use App\FamilyReview;
use App\CandidateReview;
use App\FrontUser;
use App\NeedsBabysitter;
use App\PreviousExperience;
use Validator;
use Session;
use DB;

class FrontCandidateController extends Controller{

    public function store_candidate_reviews(Request $request){
        $request->validate([
            'review_rating_count'       => 'required',
            'review_note'               => 'required',
        ]);

        $input              = $request->all();
        $input['date']      = date('Y-m-d');
        $review = CandidateReview::updateOrCreate(['candidate_id' => $request->candidate_id, 'family_id' => $request->family_id], $input);
        return redirect()->back()->with('success', 'Your review have been recorded successfully.');
    }

    public function store_candidate_favorite_family(Request $request){
        $request->validate([
            'candidate_id'  => 'required',
            'family_id'     => 'required',
        ]);

        $data                       = $request->all();
        $data['date']               = date('Y-m-d');
        $candidate_favorite_family  = CandidateFavoriteFamily::where('candidate_id', Session::get('frontUser')->id)->where('family_id', $request->family_id)->first();
        
        if(!empty($candidate_favorite_family)){
            $status = $candidate_favorite_family->delete();
            return response()->json(['message' => 'deleted'], 200);
        }
        
        $status = CandidateFavoriteFamily::create($data);
        return response()->json(['message' => 'success'], 200);
    }

    public function edit_candidate($candidateId){
        $data['menu']                           = "manage profile";
        $data['candidate']                      = FrontUser::findOrFail($candidateId);
        $data['candidate']['other_services']    = !empty($data['candidate']->other_services) ? json_decode($data['candidate']->other_services) : array();
        $data['availability']                   = NeedsBabysitter::where('family_id', $candidateId)->first();
        $data['previous_experience']            = PreviousExperience::where('candidate_id', $candidateId)->get();
        $data['morning_availability']           = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']         = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']           = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']             = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        return view('user.candidate_manage_profile', $data);
    }

    public function update_candidate(Request $request, $candidateId){
        $request->validate([
            'name'                  => 'required',
            'age'                   => 'required',
            'id_number'             => "required",
            'salary_expectation'    => "required",
        ]);

        $candidate              = FrontUser::findorFail($candidateId);
        $input                  = $request->all();
        $input['password']      = !empty($request->password) ? Hash::make($request->password) : $candidate->password;
        $input['email']         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']          = $candidate->role;
        $input['profile']       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $candidate->profile;
        $input['other_services']= !empty($request->other_services) ? json_encode($request->other_services) : null;
        $experiance             = !empty($input['daterange']) ? $this->store_previous_experience($input, $candidateId) : 0;
        $availability           = isset($request->morning) || isset($request->afternoon) || isset($request->evening) ? $this->store_candidate_calender($input, $candidateId) : 0;
        $update_status          = $candidate->update($input);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function store_previous_experience($input, $candidateId){
        $previous_experiance =  PreviousExperience::where('candidate_id', $candidateId)->get()->toArray();
        if(isset($previous_experiance) && !empty($previous_experiance)){
            $delete_status = PreviousExperience::where('candidate_id', $candidateId)->delete(); 
        }
            
        foreach ($input['daterange'] as $key => $value) {
            $data = array();
            $data['candidate_id']   = isset($candidateId) ? $candidateId : null;
            $data['daterange']      = isset($input['daterange'][$key]) ? $input['daterange'][$key] : null;
            $data['heading']        = isset($input['heading'][$key]) ? $input['heading'][$key] : null; 
            $data['description']    = isset($input['description'][$key]) ? $input['description'][$key] : null;             
            $data['reference']      = isset($input['reference'][$key]) ? $input['reference'][$key] : null; 
            $data['tel_number']     = isset($input['tel_number'][$key]) ? $input['tel_number'][$key] : null;  
            $data['created_at']     = date("Y-m-d H:i:s");
            $data['updated_at']     = date("Y-m-d H:i:s");
            $status = PreviousExperience::create($data);
        }
        return $status;
    }

    public function store_image($data, $path=null){
        $randomName = Str::random(20);
        $extension  = $data->getClientOriginalExtension();
        $imageName  = date('d-m-y') . '_' . $randomName . '.' . $extension;
        $path       = $data->storeAs('uploads', $imageName, 'public');
        return      $imageName;
    }

    public function edit_candidate_calender(Request $request){
        $data['menu']                   = "manage calender";
        $data['candidate']              = FrontUser::findOrFail(Session::get('frontUser')->id);
        $data['availability']           = NeedsBabysitter::where('family_id', Session::get('frontUser')->id)->first();
        $data['morning_availability']   = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability'] = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']   = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']     = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        return view('user.candidate.candidate_manage_calender', $data);
    }

    public function update_candidate_calender(Request $request, $candidateId){
        $input      = $request->all();
        $status     = $this->store_candidate_calender($input, $candidateId);
        return redirect()->back()->with($status > 0 ? 'success' : 'error', $status > 0 ? 'Candidate calendar has been updated successfully.' : 'Failed to update candidate\'s calendar.');
    }

    public function store_candidate_calender($input, $candidateId){
        $candidate = FrontUser::find($candidateId);
        if(isset($candidate) && empty($candidate)){
            return 0;
        }

        $data['morning']        = !empty($input['morning']) ? json_encode($input['morning']) : null;
        $data['afternoon']      = !empty($input['afternoon']) ? json_encode($input['afternoon']) : null;
        $data['evening']        = !empty($input['evening']) ? json_encode($input['evening']) : null;
        $data['night']          = !empty($input['night']) ? json_encode($input['night']) : null;
        $data['updated_at']     =  date("Y-m-d H:i:s");
        $availability           =  $candidate->needs_babysitter()->updateOrCreate(['family_id' => $candidateId], $data);
        return $availability->id;        
    }

    public function view_families(){
        $data['menu']       = "view families";
        $data['families'] = FrontUser::leftJoin('candidate_favorite_families', 'front_users.id', '=', 'candidate_favorite_families.family_id')
            ->leftJoin('family_reviews', 'front_users.id', '=', 'family_reviews.family_id')
            ->select(
                'front_users.*',
                'candidate_favorite_families.candidate_id AS candidate_favourite_family',
                'family_reviews.review_note',
                'family_reviews.review_rating_count'
            )
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('family_reviews')
                    ->whereColumn('family_reviews.family_id', 'front_users.id');
            }, 'total_reviews')
            ->where('front_users.role', 'family')->where('front_users.status', '1')
            ->get();

        return view('user.family.view_families', $data);
    }

    public function family_detail($familyId){
        $data['menu']                       = 'family detail';
        $data['family']                     = FrontUser::where('id', $familyId)->where('role', 'family')->where('status', '1')->first();
        $data['availability']               = NeedsBabysitter::where('family_id', $familyId)->first(); //candidate availablity records
        $data['morning_availability']       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        
        $data['reviews'] = FamilyReview::select(['review_note', 'review_rating_count'])
            ->selectSub(function ($query) use ($familyId) {
                $query->selectRaw('COUNT(*)')
                    ->from('family_reviews')
                    ->where('family_id', $familyId);
            }, 'total_reviews')
            ->where('candidate_id', Session::get('frontUser')->id)
            ->where('family_id', $familyId)
            ->latest('created_at')
            ->first();

        $data['loginUser'] = Session::has('frontUser') ? Session::get('frontUser') : null;
        $data['favourite'] = Session::has('frontUser') ? CandidateFavoriteFamily::where('candidate_id', Session::get('frontUser')->id)->where('family_id', $familyId)->first() : null;
        return view('user.family.family_detail', $data);
    }
}
