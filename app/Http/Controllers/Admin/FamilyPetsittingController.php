<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\User\SubscriptionController;
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
       

        
        if($request->ajax()){
            $response  = FrontUser::select('*')->selectRaw("DATE_FORMAT(created_at, '%Y-%m-%d') as formatted_created_at")
                        ->where('front_users.role', 'family-petsitting')
                        ->get();

            return DataTables::of($response)
                ->addColumn('action', function ($row) {
                    $btn = '<span data-toggle="tooltip" title="Edit Family" data-trigger="hover">
                                <a href="'.url('admin/family-petsitting/'.$row->id.'/edit').'" class="btn btn-sm btn-primary edit-family" type="button" data-id="' . $row->id . '"><i class="fa fa-pen"></i></a>
                            </span>';

                    $btn .= '<span data-toggle="tooltip" title="view subscriptions" data-trigger="hover">
                                <button class="btn btn-sm btn-info view subscriptions" type="button" data-id="' . $row->id . '" onclick="viewSubscriptions(' . $row->id . ', \'' . $row->role . '\')"><i class="fa fa-eye"></i></button>
                            </span>';


                    $btn .= '<span data-toggle="tooltip" title="Delete Family" data-trigger="hover">
                                <button class="btn btn-sm btn-danger delete-review" type="button" data-id="' . $row->id . '" onclick="deleteFamily(' . $row->id . ', \'' . $row->role . '\')"><i class="fa fa-trash"></i></button>
                            </span>';

                    return $btn;
                })

                ->addColumn('payment_status', function ($row) {
                    $subscription   = new SubscriptionController();
                    $payment_status = $subscription->check_subscription_status($row->id);
                    if($payment_status == 'inactive'){
                        return '<span class="badge badge-dark">inactive</span>';
                    }elseif($payment_status == 'pending'){
                        return '<span class="badge badge-danger">pending</span>';
                    }elseif($payment_status == 'expired'){
                        return '<span class="badge badge-warning">expired</span>';
                    }else{
                        return '<span class="badge badge-success">active</span>';
                    }
                })

                ->addColumn('user_status', function ($row) {
                    if($row->status == 1){
                        return '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" checked onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }else{
                        return '<label class="switch status_switch"><input type="checkbox" id="status_checkbox'.$row->id.'" onchange="changeUserStatus(' . $row->id . ')"><span class="status_slider round"></span></label>';
                    }
                })
                ->rawColumns(['action', 'user_status', 'payment_status'])
                ->make(true);
        }

        return view('admin.family_petsitting.index', $data);   
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
            'cell_number'                   => "required",
            'start_date'                    => "required",
            'duration_needed'               => "required",
            'candidate_duties'              => "required",
            'id_number'                     => 'required' . ($request->type_of_id_number == 'south_african' ? ' |numeric|digits:13' : ''),
            'type_of_id_number'             => "required",
            'email'                         => "required|email|unique:front_users,email," . $id,
            'profile'                       => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ],[
            'profile.required_if'           => 'The profile field is required',
        ]);

        $family                                 = FrontUser::find($id);
        $input                                  = $request->all();
        $input['password']                      = !empty($request->password) ? Hash::make($request->password) : $family->password;
        $input['email']                         = !empty($request->email) ? $request->email : $family->email;
        $input['role']                          = $family->role;
        $input['profile']                       = $request->file('profile') !== null ? $this->store_image($request->file('profile')) : $family->profile;
        $input['type_of_pet']                   = isset($request->type_of_pet) ? json_encode($request->type_of_pet) : null;
        $input['how_many_pets']                 = isset($request->how_many_pets) ? json_encode($request->how_many_pets) : null;
        $calender                               = $this->store_family_calender($input, $id);
        $update_status                          = $family->update($input);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function destroy(string $id){
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
