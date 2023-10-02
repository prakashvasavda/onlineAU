<?php

namespace App\Http\Controllers;

use App\FrontUser;
use App\NeedsBabysitter;
use App\PreviousExperience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;

class FrontRegisterController extends Controller
{
    public function index($type)
    {
        if (session()->has('frontUser')) {
            return redirect()->route('home');
        }
        return view('user.register');
    }

    public function candidates()
    {
        return view('user.candidates');
    }

    public function store_candidate(Request $request)
    {
        $data  = $request->all();
        $rules = [
            'name'            => "required",
            'age'             => "required",
            'profile'         => "required",
            'id_number'       => "required",
            'contact_number'  => "required",
            'email'           => "required|email|unique:front_users,email",
            'password'        => "required",
            'gender'          => "required",
            'marital_status'  => "required",
            'drivers_license' => "required",
        ];
        $message = [
            'name'            => 'The Name must be required',
            'age'             => 'The Age must be required',
            'profile'         => 'The Profile must be required',
            'id_number'       => 'The Id Number must be required',
            'contact_number'  => 'The Contact Number must be required',
            'email'           => 'The Email must be required',
            'password'        => 'The Password must be required',
            'gender'          => 'The Gender must be required',
            'marital_status'  => 'The Marital Status must be required',
            'drivers_license' => 'The Drivers License must be required',
        ];
        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        $randomName = Str::random(20);
        $extension  = $request->file('profile')->getClientOriginalExtension();
        $imageName  = date('d-m-y') . '_' . $randomName . '.' . $extension;
        $path       = $request->file('profile')->storeAs('uploads', $imageName, 'public');

        $candidateId = FrontUser::insertGetId([
            'name'                     => $request->name,
            'age'                      => $request->age,
            'profile'                  => $imageName,
            'id_number'                => $request->id_number,
            'contact_number'           => $request->contact_number,
            'email'                    => $request->email,
            'password'                 => Hash::make($request->password),
            'situated'                 => $request->situated,
            'area'                     => $request->area,
            'gender'                   => $request->gender,
            'ethnicity'                => $request->ethnicity,
            'religion'                 => $request->religion,
            'home_language'            => $request->home_language,
            'additional_language'      => $request->additional_language,
            'disabilities'             => $request->disabilities,
            'marital_status'           => $request->marital_status,
            'dependants'               => $request->dependants,
            'chronical_medication'     => $request->chronical_medication,
            'drivers_license'          => $request->drivers_license,
            'vehicle'                  => $request->vehicle,
            'car_accident'             => $request->car_accident,
            'childcare_experience'     => $request->childcare_experience,
            'experience_special_needs' => $request->experience_special_needs,
            'salary_expectation'       => $request->salary_expectation,
            'available_day'            => $request->available_day,
            'status'                   => 0,
            'role'                     => $request->role,
            "created_at"               => date("Y-m-d H:i:s"),
            "updated_at"               => date("Y-m-d H:i:s"),
        ]);

        foreach ($data['daterange'] as $key => $value) {
            PreviousExperience::insertGetId([
                'candidate_id' => $candidateId,
                'daterange'    => $value,
                'heading'      => $data['heading'][$key],
                'description'  => $data['description'][$key],
                'reference'    => $data['reference'][$key],
                'tel_number'   => $data['tel_number'][$key],
                "created_at"   => date("Y-m-d H:i:s"),
                "updated_at"   => date("Y-m-d H:i:s"),
            ]);
        }
        return redirect()->back()->with('success', 'Registration create successfully.');
    }

    public function families()
    {
        $candidates = FrontUser::where('role', '!=', 'family')->where('status', '1')->get()->toArray();
        return view('user.families', compact('candidates'));
    }

    public function family_register()
    {
        return view('user.family_register');
    }

    public function store_family(Request $request)
    {
        $data = $request->all();

        $rules = [
            'name'                          => "required",
            'age'                           => "required",
            'profile'                       => "required",
            'email'                         => "required|email|unique:front_users,email",
            'password'                      => "required",
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
        ];
        $message = [
            'name'                          => "The Name must be required",
            'age'                           => "The Age must be required",
            'profile'                       => "The Profile must be required",
            'email'                         => "The Email must be required",
            'password'                      => "The Password must be required",
            'family_address'                => "The Family address must be required",
            'family_city'                   => "The Family city must be required",
            'home_language'                 => "The Home language must be required",
            'no_children'                   => "The No children must be required",
            'describe_kids'                 => "The Describe kids must be required",
            'family_types_babysitter'       => "The Family types babysitter must be required",
            'family_location'               => "The Family location must be required",
            'family_babysitter_comfortable' => "The Family babysitter comfortable must be required",
            'family_profile_see'            => "The Family profile see must be required",
            'family_notifications'          => "The Family notifications must be required",
            'family_description'            => "The Family description must be required",
        ];
        $validator = Validator::make($data, $rules, $message);
        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator)
                ->with('message_type', 'danger')
                ->with('message', 'There were some error try again');
        }

        $randomName = Str::random(20);
        $extension  = $request->file('profile')->getClientOriginalExtension();
        $imageName  = date('d-m-y') . '_' . $randomName . '.' . $extension;
        $path       = $request->file('profile')->storeAs('uploads', $imageName, 'public');

        $familyId = FrontUser::insertGetId([
            'name'                          => $request->name,
            'age'                           => serialize($request->family_special_need_value),
            'profile'                       => $imageName,
            'email'                         => $request->email,
            'password'                      => Hash::make($request->password),
            'family_address'                => $request->family_address,
            'family_city'                   => $request->family_city,
            'home_language'                 => $request->home_language,
            'no_children'                   => $request->no_children,
            'describe_kids'                 => $request->describe_kids,
            'family_types_babysitter'       => $request->family_types_babysitter,
            'family_location'               => $request->family_location,
            'family_babysitter_comfortable' => $request->family_babysitter_comfortable,
            'family_profile_see'            => $request->family_profile_see,
            'family_notifications'          => $request->family_notifications,
            'salary_expectation'            => $request->salary_expectation,
            'family_description'            => $request->family_description,
            'family_special_need_option'    => isset($request->family_special_need_option) ? 1 : 0,
            'family_special_need_value'     => serialize($request->family_special_need_value),
            'status'                        => 1,
            'role'                          => 'family',
            "created_at"                    => date("Y-m-d H:i:s"),
            "updated_at"                    => date("Y-m-d H:i:s"),
        ]);

        $needs = NeedsBabysitter::insertGetId([
            'family_id'  => $familyId,
            'morning'    => serialize($request->morning),
            'afternoon'  => serialize($request->afternoon),
            'evening'    => serialize($request->evening),
            'night'      => serialize($request->night),
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        ]);

        return redirect()->back()->with('success', 'Registration create successfully.');
    }
}
