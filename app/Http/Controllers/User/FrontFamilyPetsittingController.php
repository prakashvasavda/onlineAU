<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class FrontFamilyPetsittingController extends Controller{
 
    public function index()
    {
        //
    }

    public function create(){
        //
    }

    public function store(Request $request){
        $request->validate([
            'name'                          => "required",
            'email'                         => "required|email|unique:front_users,email",
            'password'                      => "required",
            'family_address'                => "required",
            'cell_number'                   => "required",
            'id_number'                     => "required",
            'start_date'                    => "required",
            'duration_needed'               => "required",
            'candidate_duties'              => "required",
            'surname'                       => "required",
        ]);

        $input                  = $request->except('_method', '_token', 'morning', 'afternoon', 'evening', 'night');
        $input['profile']       = $request->hasFile('profile') ? $this->store_image($request->file('profile')) : null;
        $input['type_of_pet']   = isset($request->type_of_pet) ? json_encode($request->type_of_pet) : null;
        $input['how_many_pets'] = isset($request->how_many_pets) ? json_encode($request->how_many_pets) : null;
        $input['password']      = Hash::make($request->password);
        
        $input['status']        = 0;
        $input['role']          = 'family-petsitting';

        $familyId   = FrontUser::insertGetId($input);
        $calender   = $this->store_family_calender($request->all(), $familyId);

        $input['user_id']        = $familyId;
        $input['profile']        = null;

        /*redirect to payment packages*/
        Session::put('guestUser', $input);
        return redirect()->to('packages');
    }


    public function show(string $id){
        //
    }

    public function edit(string $id){
        //
    }

    public function update(Request $request, string $id){
        $request->validate([
            'name'                          => "required",
            'family_address'                => "required",
            'surname'                       => "required",
            'id_number'                     => "required",
            'cell_number'                   => "required",
            'start_date'                    => "required",
            'duration_needed'               => "required",
            'candidate_duties'              => "required",
        ],[
            'profile.required_if'   => 'The profile field is required',
        ]);

        $family                                 = FrontUser::find($id);
        $input                                  = $request->all();
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']                         = !empty($request->email) ? $request->email : $candidate->email;
        $input['role']                          = $family->role;
        $input['profile']                       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $family->profile;
        $input['type_of_pet']                   = isset($request->type_of_pet) ? json_encode($request->type_of_pet) : null;
        $input['how_many_pets']                 = isset($request->how_many_pets) ? json_encode($request->how_many_pets) : null;
        $calender                               = $this->store_family_calender($input, $id);
        $update_status                          = $family->update($input);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function destroy(string $id)
    {
        //
    }
}
