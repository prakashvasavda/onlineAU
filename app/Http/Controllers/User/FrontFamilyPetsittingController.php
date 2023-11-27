<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class FrontFamilyPetsittingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

        $input                  = $request->except('_method', '_token');
        $input['profile']       = $request->hasFile('profile') ? $this->store_image($request->file('profile')) : null;
        $input['type_of_pet']   = isset($request->type_of_pet) ? json_encode($request->type_of_pet) : null;
        $input['how_many_pets'] = isset($request->how_many_pets) ? json_encode($request->how_many_pets) : null;
        $input['password']      = Hash::make($request->password);
        $input['status']        = 0;
        $input['role']          = 'family-petsitting';

        unset($input['morning']);
        unset($input['afternoon']);
        unset($input['evening']);
        unset($input['night']);


        $familyId   = FrontUser::insertGetId($input);
        $calender   = isset($request->morning) || isset($request->afternoon) || isset($request->evening) || isset($request->night) ? $this->store_family_calender($input, $familyId) : 0;

        $input['user_id']        = $familyId;
        $input['profile']        = null;

        /*redirect to payment packages*/
        Session::put('guestUser', $input);
        return redirect()->to('packages');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
