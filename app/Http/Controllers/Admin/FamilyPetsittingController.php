<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\CandidateFavoriteFamily;
use App\Models\FamilyFavoriteCandidate;
use App\Models\CandidateFavourite;
use App\Models\PreviousExperience;
use App\Models\NeedsBabysitter;
use App\Models\CandidateReview;
use App\Models\FamilyReview;
use App\Models\FrontUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use DataTables;

class FamilyPetsittingController extends Controller
{
    
    public function index(Request $request){
        $data['menu']   = "family petsitting";
        $families       = FrontUser::leftJoin('user_subscriptions', 'front_users.id', '=', 'user_subscriptions.user_id')
                        ->select('front_users.*', 'user_subscriptions.package_name', 'user_subscriptions.status AS user_payment_status')
                        ->where('front_users.role', 'family-petsitting')
                        ->distinct()
                        ->get();

        
        if($request->ajax()){
            return DataTables::of($families)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Edit Family" data-trigger="hover">
                                <a href="'.url('admin/family-petsitting/'.$row->id.'/edit').'" class="btn btn-sm btn-primary edit-family" type="button" data-id="' . $row->id . '"><i class="fa fa-pen"></i></a>
                            </span>';

                    $btn .= '<span data-toggle="tooltip" title="Delete Family" data-trigger="hover">
                                <button class="btn btn-sm btn-danger delete-review" type="button" data-id="' . $row->id . '" onclick="deleteFamily(' . $row->id . ', \'' . $row->role . '\')"><i class="fa fa-trash"></i></button>
                            </span>';
                    return $btn;
                })

                ->addColumn('payment_status', function ($row) {
                    if($row->user_payment_status == 1){
                        return $payment_btn = '<span class="badge badge-success">paid</span>';
                    }else{
                        return $payment_btn = '<span class="badge badge-danger">pending</span>';
                    }
                })

                ->addColumn('user_status', function ($row) {
                    if($row->status == 1){
                        return $status_btn = '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" checked onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }else{
                        return $status_btn = '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }
                })
                ->rawColumns(['action', 'payment_status', 'user_status'])
                ->make(true);
        }

        return view('admin.family_petsitting.index', $data);   
    }

   
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id){
        $data['menu']                                       = "family petsitting";
        $data['family']                                     = FrontUser::findOrFail($id);
        $data['availability']                               = NeedsBabysitter::where('family_id', $id)->first();
        $data['morning_availability']                       = !empty($data['availability']->morning) ? json_decode($data['availability']->morning, true) : array();
        $data['afternoon_availability']                     = !empty($data['availability']->afternoon) ? json_decode($data['availability']->afternoon, true) : array();
        $data['evening_availability']                       = !empty($data['availability']->evening) ? json_decode($data['availability']->evening, true) : array();
        $data['night_availability']                         = !empty($data['availability']->night) ? json_decode($data['availability']->night, true) : array();
        $data['family']['type_of_pet']                      = !empty($data['family']->type_of_pet) ? json_decode($data['family']->type_of_pet, true) : array();
        $data['family']['how_many_pets']                    = !empty($data['family']->how_many_pets) ? json_decode($data['family']->how_many_pets, true) : array();
        return view('admin.family_petsitting.edit', $data);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
